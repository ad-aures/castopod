<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\Episode;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Database\BaseResult;
use CodeIgniter\I18n\Time;
use Michalsn\Uuid\UuidModel;
use Ramsey\Uuid\Lazy\LazyUuidFromString;

class EpisodeModel extends UuidModel
{
    /**
     * TODO: remove, shouldn't be here
     *
     * @var array<string, array<string, string>>
     */
    public static $themes = [
        'light-transparent' => [
            'style'      => 'background-color: #fff; background-image: linear-gradient(45deg, #ccc 12.5%, transparent 12.5%, transparent 50%, #ccc 50%, #ccc 62.5%, transparent 62.5%, transparent 100%); background-size: 5.66px 5.66px;',
            'background' => 'transparent',
            'text'       => '#000',
            'inverted'   => '#fff',
        ],
        'light' => [
            'style'      => 'background-color: #fff;',
            'background' => '#fff',
            'text'       => '#000',
            'inverted'   => '#fff',
        ],
        'dark-transparent' => [
            'style'      => 'background-color: #001f1a; background-image: linear-gradient(45deg, #888 12.5%, transparent 12.5%, transparent 50%, #888 50%, #888 62.5%, transparent 62.5%, transparent 100%); background-size: 5.66px 5.66px;',
            'background' => 'transparent',
            'text'       => '#fff',
            'inverted'   => '#000',
        ],
        'dark' => [
            'style'      => 'background-color: #001f1a;',
            'background' => '#313131',
            'text'       => '#fff',
            'inverted'   => '#000',
        ],
    ];

    /**
     * @var string[]
     */
    protected $uuidFields = ['preview_id'];

    /**
     * @var string
     */
    protected $table = 'episodes';

    /**
     * @var list<string>
     */
    protected $allowedFields = [
        'id',
        'podcast_id',
        'preview_id',
        'guid',
        'title',
        'slug',
        'audio_id',
        'description_markdown',
        'description_html',
        'cover_id',
        'transcript_id',
        'transcript_remote_url',
        'chapters_id',
        'chapters_remote_url',
        'parental_advisory',
        'number',
        'season_number',
        'type',
        'is_blocked',
        'location_name',
        'location_geo',
        'location_osm',
        'is_published_on_hubs',
        'downloads_count',
        'posts_count',
        'comments_count',
        'is_premium',
        'published_at',
        'created_by',
        'updated_by',
    ];

    /**
     * @var class-string<Episode>
     */
    protected $returnType = Episode::class;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * @var array<string, string>
     */
    protected $validationRules = [
        'podcast_id'            => 'required',
        'title'                 => 'required',
        'slug'                  => 'required|regex_match[/^[a-zA-Z0-9\-]{1,128}$/]',
        'audio_id'              => 'required',
        'description_markdown'  => 'required',
        'number'                => 'is_natural_no_zero|permit_empty',
        'season_number'         => 'is_natural_no_zero|permit_empty',
        'type'                  => 'required',
        'transcript_remote_url' => 'valid_url_strict|permit_empty',
        'chapters_remote_url'   => 'valid_url_strict|permit_empty',
        'published_at'          => 'valid_date|permit_empty',
        'created_by'            => 'required',
        'updated_by'            => 'required',
    ];

    /**
     * @var list<string>
     */
    protected $afterInsert = ['writeEnclosureMetadata', 'clearCache'];

    /**
     * @var list<string>
     */
    protected $afterUpdate = ['clearCache', 'writeEnclosureMetadata'];

    /**
     * @var list<string>
     */
    protected $beforeDelete = ['clearCache'];

    public function getEpisodeBySlug(string $podcastHandle, string $episodeSlug): ?Episode
    {
        $cacheName = "podcast-{$podcastHandle}_episode-{$episodeSlug}";
        if (! ($found = cache($cacheName))) {
            $found = $this->select('episodes.*')
                ->join('podcasts', 'podcasts.id = episodes.podcast_id')
                ->where('slug', $episodeSlug)
                ->where('podcasts.handle', $podcastHandle)
                ->where('`' . $this->db->getPrefix() . 'episodes`.`published_at` <= UTC_TIMESTAMP()', null, false)
                ->first();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getEpisodeById(int $episodeId): ?Episode
    {
        // TODO: episode id should be a composite key. The cache should include podcast_id.
        $cacheName = "podcast_episode#{$episodeId}";
        if (! ($found = cache($cacheName))) {
            $builder = $this->where([
                'id' => $episodeId,
            ]);

            $found = $builder->first();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getPublishedEpisodeById(int $podcastId, int $episodeId): ?Episode
    {
        $cacheName = "podcast#{$podcastId}_episode#{$episodeId}_published";
        if (! ($found = cache($cacheName))) {
            $found = $this->where([
                'id' => $episodeId,
            ])
                ->where('podcast_id', $podcastId)
                ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
                ->first();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getEpisodeByPreviewId(string $previewId): ?Episode
    {
        $cacheName = "podcast_episode-preview#{$previewId}";
        if (! ($found = cache($cacheName))) {
            $builder = $this->where([
                'preview_id' => $this->uuid->fromString($previewId)
                    ->getBytes(),
            ]);

            $found = $builder->first();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function setEpisodePreviewId(int $episodeId): string|false
    {
        /** @var LazyUuidFromString $uuid */
        $uuid = $this->uuid->{$this->uuidVersion}();

        if (! $this->update($episodeId, [
            'preview_id' => $uuid,
        ])) {
            return false;
        }

        return (string) $uuid;
    }

    /**
     * Gets all episodes for a podcast ordered according to podcast type Filtered depending on year or season
     *
     * @return Episode[]
     */
    public function getPodcastEpisodes(
        int $podcastId,
        string $podcastType,
        ?string $year = null,
        ?string $season = null,
    ): array {
        $cacheName = implode(
            '_',
            array_filter(["podcast#{$podcastId}", $year, $season ? 'season' . $season : null, 'episodes']),
        );

        if (! ($found = cache($cacheName))) {
            $where = [
                'podcast_id' => $podcastId,
            ];
            if ($year) {
                $where['YEAR(published_at)'] = $year;
                $where['season_number'] = null;
            }

            if ($season) {
                $where['season_number'] = $season;
            }

            if ($podcastType === 'serial') {
                // podcast is serial
                $found = $this->where($where)
                    ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
                    ->orderBy('season_number DESC, number ASC')
                    ->findAll();
            } else {
                $found = $this->where($where)
                    ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
                    ->orderBy('published_at', 'DESC')
                    ->findAll();
            }

            $secondsToNextUnpublishedEpisode = $this->getSecondsToNextUnpublishedEpisode($podcastId);

            cache()
                ->save($cacheName, $found, $secondsToNextUnpublishedEpisode ?: DECADE);
        }

        return $found;
    }

    /**
     * Returns number of episodes of a podcast
     */
    public function getPodcastEpisodesCount(int $podcastId): int|string
    {
        return $this
            ->where([
                'podcast_id' => $podcastId,
            ])
            ->countAllResults();
    }

    /**
     * Returns the timestamp difference in seconds between the next episode to publish and the current timestamp Returns
     * false if there's no episode to publish
     *
     * @return int|false seconds
     */
    public function getSecondsToNextUnpublishedEpisode(int $podcastId): int | false
    {
        $result = $this->builder()
            ->select('TIMESTAMPDIFF(SECOND, UTC_TIMESTAMP(), `published_at`) as timestamp_diff')
            ->where([
                'podcast_id' => $podcastId,
            ])
            ->where('`published_at` > UTC_TIMESTAMP()', null, false)
            ->orderBy('published_at', 'asc')
            ->get()
            ->getResultArray();

        return $result !== []
            ? (int) $result[0]['timestamp_diff']
            : false;
    }

    public function getCurrentSeasonNumber(int $podcastId): ?int
    {
        $result = $this->builder()
            ->selectMax('season_number', 'current_season_number')
            ->where('podcast_id', $podcastId)
            ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
            ->get()
            ->getResultArray();

        return $result[0]['current_season_number'] ? (int) $result[0]['current_season_number'] : null;
    }

    public function getNextEpisodeNumber(int $podcastId, ?int $seasonNumber): int
    {
        $result = $this->builder()
            ->selectMax('number', 'next_episode_number')
            ->where([
                'podcast_id'    => $podcastId,
                'season_number' => $seasonNumber,
            ])
            ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
            ->get()
            ->getResultArray();

        return (int) $result[0]['next_episode_number'] + 1;
    }

    /**
     * @return array{number_of_seasons: int, number_of_episodes: int, first_published_at?: Time}
     */
    public function getPodcastStats(int $podcastId): array
    {
        $result = $this->builder()
            ->select(
                'COUNT(DISTINCT season_number) as number_of_seasons, COUNT(*) as number_of_episodes, MIN(published_at) as first_published_at',
            )
            ->where('podcast_id', $podcastId)
            ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
            ->get()
            ->getResultArray();

        $stats = [
            'number_of_seasons'  => (int) $result[0]['number_of_seasons'],
            'number_of_episodes' => (int) $result[0]['number_of_episodes'],
        ];

        if ($result[0]['first_published_at'] !== null) {
            $stats['first_published_at'] = new Time($result[0]['first_published_at']);
        }

        return $stats;
    }

    public function resetCommentsCount(): int | false
    {
        $episodeCommentsCount = new EpisodeCommentModel()
            ->builder()
            ->select('episode_id, COUNT(*) as `comments_count`')
            ->where('in_reply_to_id')
            ->groupBy('episode_id')
            ->getCompiledSelect();

        $episodePostsRepliesCount = new PostModel()
            ->builder()
            ->select('fediverse_posts.episode_id as episode_id, COUNT(*) as `comments_count`')
            ->join('fediverse_posts as fp', 'fediverse_posts.id = fp.in_reply_to_id')
            ->where('fediverse_posts.in_reply_to_id')
            ->where('fediverse_posts.episode_id IS NOT')
            ->groupBy('fediverse_posts.episode_id')
            ->getCompiledSelect();

        /** @var BaseResult $query */
        $query = $this->db->query(
            'SELECT `episode_id` as `id`, SUM(`comments_count`) as `comments_count` FROM (' . $episodeCommentsCount . ' UNION ALL ' . $episodePostsRepliesCount . ') x GROUP BY `episode_id`',
        );

        $countsPerEpisodeId = $query->getResultArray();

        if ($countsPerEpisodeId !== []) {
            return new self()
                ->updateBatch($countsPerEpisodeId, 'id');
        }

        return 0;
    }

    public function resetPostsCount(): int | false
    {
        $episodePostsCount = $this->builder()
            ->select('episodes.id, COUNT(*) as `posts_count`')
            ->join('fediverse_posts', 'episodes.id = fediverse_posts.episode_id')
            ->where('in_reply_to_id')
            ->groupBy('episodes.id')
            ->get()
            ->getResultArray();

        if ($episodePostsCount !== []) {
            return $this->updateBatch($episodePostsCount, 'id');
        }

        return 0;
    }

    /**
     * @param mixed[] $data
     *
     * @return mixed[]
     */
    public function clearCache(array $data): array
    {
        /** @var int|null $episodeId */
        $episodeId = is_array($data['id']) ? $data['id'][0] : $data['id'];

        if ($episodeId === null) {
            // Multiple episodes have been updated, do nothing
            return $data;
        }

        /** @var ?Episode $episode */
        $episode = new self()
            ->find($episodeId);

        if (! $episode instanceof Episode) {
            return $data;
        }

        // delete podcast cache
        cache()
            ->deleteMatching("podcast#{$episode->podcast_id}*");
        cache()
            ->deleteMatching("podcast-{$episode->podcast->handle}*");
        cache()
            ->deleteMatching('podcast_episode*');
        cache()
            ->deleteMatching("page_podcast#{$episode->podcast_id}*");
        cache()
            ->deleteMatching('page_credits_*');
        cache()
            ->delete('episodes_markers');

        return $data;
    }

    public function doesPodcastHavePremiumEpisodes(int $podcastId): bool
    {
        return $this->builder()
            ->where([
                'podcast_id' => $podcastId,
                'is_premium' => true,
            ])
            ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
            ->countAllResults() > 0;
    }

    public function fullTextSearch(string $query): ?BaseBuilder
    {
        $prefix = $this->db->getPrefix();
        $episodeTable = $prefix . $this->builder()->getTable();

        $podcastModel = (new PodcastModel());

        $podcastTable = $podcastModel->db->getPrefix() . $podcastModel->builder()->getTable();

        $this->builder()
            ->select('' . $episodeTable . '.*')
            ->select('
                ' . $this->getFullTextMatchClauseForEpisodes($episodeTable, $query) . ' as episodes_score,
                ' . $podcastModel->getFullTextMatchClauseForPodcasts($podcastTable, $query) . ' as podcasts_score,
             ')
            ->select("{$podcastTable}.created_at AS podcast_created_at")
            ->select(
                "{$podcastTable}.title as podcast_title, {$podcastTable}.handle as podcast_handle, {$podcastTable}.description_markdown as podcast_description_markdown",
            )
            ->join($podcastTable, "{$podcastTable} on {$podcastTable}.id = {$episodeTable}.podcast_id")
            ->where('
                (' .
                    $this->getFullTextMatchClauseForEpisodes($episodeTable, $query)
                    . 'OR' .
                    $podcastModel->getFullTextMatchClauseForPodcasts($podcastTable, $query)
                . ')
            ', );

        return $this->builder;
    }

    public function getFullTextMatchClauseForEpisodes(string $table, string $value): string
    {
        return '
                MATCH (
                    ' . $table . '.title,
                    ' . $table . '.description_markdown,
                    ' . $table . '.slug,
                    ' . $table . '.location_name
                )
                AGAINST(' . $this->db->escape($value) . ')
            ';
    }

    /**
     * @param mixed[] $data
     *
     * @return mixed[]
     */
    protected function writeEnclosureMetadata(array $data): array
    {
        /** @var int|null $episodeId */
        $episodeId = is_array($data['id']) ? $data['id'][0] : $data['id'];

        if ($episodeId === null) {
            // Multiple episodes have been updated, do nothing
            return $data;
        }

        /** @var ?Episode $episode */
        $episode = new self()
            ->find($episodeId);

        if (! $episode instanceof Episode) {
            return $data;
        }

        helper('id3');

        write_audio_file_tags($episode);

        return $data;
    }
}
