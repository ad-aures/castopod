<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\Episode;
use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class EpisodeModel extends Model
{
    /**
     * TODO: remove, shouldn't be here
     *
     * @var array<string, array<string, string>>
     */
    public static $themes = [
        'light-transparent' => [
            'style' =>
                'background-color: #fff; background-image: linear-gradient(45deg, #ccc 12.5%, transparent 12.5%, transparent 50%, #ccc 50%, #ccc 62.5%, transparent 62.5%, transparent 100%); background-size: 5.66px 5.66px;',
            'background' => 'transparent',
            'text' => '#000',
            'inverted' => '#fff',
        ],
        'light' => [
            'style' => 'background-color: #fff;',
            'background' => '#fff',
            'text' => '#000',
            'inverted' => '#fff',
        ],
        'dark-transparent' => [
            'style' =>
                'background-color: #001f1a; background-image: linear-gradient(45deg, #888 12.5%, transparent 12.5%, transparent 50%, #888 50%, #888 62.5%, transparent 62.5%, transparent 100%); background-size: 5.66px 5.66px;',
            'background' => 'transparent',
            'text' => '#fff',
            'inverted' => '#000',
        ],
        'dark' => [
            'style' => 'background-color: #001f1a;',
            'background' => '#313131',
            'text' => '#fff',
            'inverted' => '#000',
        ],
    ];

    /**
     * @var string
     */
    protected $table = 'episodes';

    /**
     * @var string[]
     */
    protected $allowedFields = [
        'id',
        'podcast_id',
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
        'custom_rss',
        'is_published_on_hubs',
        'posts_count',
        'comments_count',
        'published_at',
        'created_by',
        'updated_by',
    ];

    /**
     * @var string
     */
    protected $returnType = Episode::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = true;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * @var array<string, string>
     */
    protected $validationRules = [
        'podcast_id' => 'required',
        'title' => 'required',
        'slug' => 'required|regex_match[/^[a-zA-Z0-9\-]{1,128}$/]',
        'audio_id' => 'required',
        'description_markdown' => 'required',
        'number' => 'is_natural_no_zero|permit_empty',
        'season_number' => 'is_natural_no_zero|permit_empty',
        'type' => 'required',
        'transcript_remote_url' => 'valid_url_strict|permit_empty',
        'chapters_remote_url' => 'valid_url_strict|permit_empty',
        'published_at' => 'valid_date|permit_empty',
        'created_by' => 'required',
        'updated_by' => 'required',
    ];

    /**
     * @var string[]
     */
    protected $afterInsert = ['writeEnclosureMetadata', 'clearCache'];

    /**
     * @var string[]
     */
    protected $afterUpdate = ['clearCache', 'writeEnclosureMetadata'];

    /**
     * @var string[]
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
                ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
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

    /**
     * Gets all episodes for a podcast ordered according to podcast type Filtered depending on year or season
     *
     * @return Episode[]
     */
    public function getPodcastEpisodes(
        int $podcastId,
        string $podcastType,
        string $year = null,
        string $season = null
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
                ->save(
                    $cacheName,
                    $found,
                    $secondsToNextUnpublishedEpisode
                    ? $secondsToNextUnpublishedEpisode
                    : DECADE,
                );
        }

        return $found;
    }

    /**
     * Returns the timestamp difference in seconds between the next episode to publish and the current timestamp Returns
     * false if there's no episode to publish
     *
     * @return int|false seconds
     */
    public function getSecondsToNextUnpublishedEpisode(int $podcastId): int | false
    {
        $result = $this->select('TIMESTAMPDIFF(SECOND, UTC_TIMESTAMP(), `published_at`) as timestamp_diff')
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
        $result = $this->select('MAX(season_number) as current_season_number')
            ->where([
                'podcast_id' => $podcastId,
                $this->deletedField => null,
            ])
            ->get()
            ->getResultArray();

        return $result[0]['current_season_number'] ? (int) $result[0]['current_season_number'] : null;
    }

    public function getNextEpisodeNumber(int $podcastId, ?int $seasonNumber): int
    {
        $result = $this->select('MAX(number) as next_episode_number')
            ->where([
                'podcast_id' => $podcastId,
                'season_number' => $seasonNumber,
                $this->deletedField => null,
            ])->get()
            ->getResultArray();

        return (int) $result[0]['next_episode_number'] + 1;
    }

    /**
     * @return array<string, int|Time>
     */
    public function getPodcastStats(int $podcastId): array
    {
        $result = $this->select(
            'COUNT(DISTINCT season_number) as number_of_seasons, COUNT(*) as number_of_episodes, MIN(published_at) as first_published_at'
        )
            ->where([
                'podcast_id' => $podcastId,
                'published_at IS NOT' => null,
                $this->deletedField => null,
            ])->get()
            ->getResultArray();

        $stats = [
            'number_of_seasons' => (int) $result[0]['number_of_seasons'],
            'number_of_episodes' => (int) $result[0]['number_of_episodes'],
        ];

        if ($result[0]['first_published_at'] !== null) {
            $stats['first_published_at'] = new Time($result[0]['first_published_at']);
        }

        return $stats;
    }

    public function resetCommentsCount(): int | false
    {
        $episodeCommentsCount = $this->select('episodes.id, COUNT(*) as `comments_count`')
            ->join('episode_comments', 'episodes.id = episode_comments.episode_id')
            ->where('in_reply_to_id', null)
            ->groupBy('episodes.id')
            ->getCompiledSelect();

        $episodePostsRepliesCount = $this
            ->select('episodes.id, COUNT(*) as `comments_count`')
            ->join(
                config('Fediverse')
                    ->tablesPrefix . 'posts',
                'episodes.id = ' . config('Fediverse')->tablesPrefix . 'posts.episode_id'
            )
            ->where('in_reply_to_id IS NOT', null)
            ->groupBy('episodes.id')
            ->getCompiledSelect();

        $query = $this->db->query(
            'SELECT `id`, SUM(`comments_count`) as `comments_count` FROM (' . $episodeCommentsCount . ' UNION ALL ' . $episodePostsRepliesCount . ') x GROUP BY `id`'
        );

        $countsPerEpisodeId = $query->getResultArray();

        if ($countsPerEpisodeId !== []) {
            return $this->updateBatch($countsPerEpisodeId, 'id');
        }

        return 0;
    }

    public function resetPostsCount(): int | false
    {
        $episodePostsCount = $this->select('episodes.id, COUNT(*) as `posts_count`')
            ->join(
                config('Fediverse')
                    ->tablesPrefix . 'posts',
                'episodes.id = ' . config('Fediverse')->tablesPrefix . 'posts.episode_id'
            )
            ->where('in_reply_to_id', null)
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
        $episode = (new self())->find(is_array($data['id']) ? $data['id'][0] : $data['id']);

        // delete podcast cache
        cache()
            ->deleteMatching("podcast#{$episode->podcast_id}*");
        cache()
            ->deleteMatching("podcast-{$episode->podcast->handle}*");
        cache()
            ->delete("podcast_episode#{$episode->id}");
        cache()
            ->deleteMatching("page_podcast#{$episode->podcast_id}*");
        cache()
            ->deleteMatching('page_credits_*');
        cache()
            ->delete('episodes_markers');

        return $data;
    }

    /**
     * @param mixed[] $data
     *
     * @return mixed[]
     */
    protected function writeEnclosureMetadata(array $data): array
    {
        helper('id3');

        $episode = (new self())->find(is_array($data['id']) ? $data['id'][0] : $data['id']);

        write_audio_file_tags($episode);

        return $data;
    }
}
