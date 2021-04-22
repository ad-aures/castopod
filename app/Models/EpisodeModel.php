<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class EpisodeModel extends Model
{
    protected $table = 'episodes';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'podcast_id',
        'guid',
        'title',
        'slug',
        'enclosure_uri',
        'enclosure_duration',
        'enclosure_mimetype',
        'enclosure_filesize',
        'enclosure_headersize',
        'description_markdown',
        'description_html',
        'image_uri',
        'image_mimetype',
        'transcript_uri',
        'chapters_uri',
        'parental_advisory',
        'number',
        'season_number',
        'type',
        'is_blocked',
        'location_name',
        'location_geo',
        'location_osmid',
        'custom_rss',
        'favourites_total',
        'reblogs_total',
        'notes_total',
        'published_at',
        'created_by',
        'updated_by',
    ];

    protected $returnType = \App\Entities\Episode::class;

    protected $useSoftDeletes = true;
    protected $useTimestamps = true;

    protected $validationRules = [
        'podcast_id' => 'required',
        'title' => 'required',
        'slug' => 'required|regex_match[/^[a-zA-Z0-9\-]{1,191}$/]',
        'enclosure_uri' => 'required',
        'description_markdown' => 'required',
        'number' => 'is_natural_no_zero|permit_empty',
        'season_number' => 'is_natural_no_zero|permit_empty',
        'type' => 'required',
        'published_at' => 'valid_date|permit_empty',
        'created_by' => 'required',
        'updated_by' => 'required',
    ];
    protected $validationMessages = [];

    protected $afterInsert = ['writeEnclosureMetadata', 'clearCache'];
    // clear cache beforeUpdate because if slug changes, so will the episode link
    protected $beforeUpdate = ['clearCache'];
    protected $afterUpdate = ['writeEnclosureMetadata'];
    protected $beforeDelete = ['clearCache'];

    // TODO: remove
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
            'background' => '#001f1a',
            'text' => '#fff',
            'inverted' => '#000',
        ],
    ];

    /**
     *
     * @param int|string $podcastId Podcast Id or name
     * @param mixed $episodeSlug
     * @return mixed
     */
    public function getEpisodeBySlug($podcastId, $episodeSlug)
    {
        $cacheName = "podcast#{$podcastId}_episode@{$episodeSlug}";
        if (!($found = cache($cacheName))) {
            $builder = $this->select('episodes.*')
                ->where('slug', $episodeSlug)
                ->where('`published_at` <= NOW()', null, false);

            if (is_numeric($podcastId)) {
                // passed argument is the podcast id
                $builder->where('podcast_id', $podcastId);
            } else {
                // passed argument is the podcast name, must perform join
                $builder
                    ->join('podcasts', 'podcasts.id = episodes.podcast_id')
                    ->where('podcasts.name', $podcastId);
            }

            $found = $builder->first();

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getEpisodeById($episodeId)
    {
        // TODO: episode id should be a composite key. The cache should include podcast_id.
        $cacheName = "podcast_episode#{$episodeId}";
        if (!($found = cache($cacheName))) {
            $builder = $this->where([
                'id' => $episodeId,
            ]);

            $found = $builder->first();

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getPublishedEpisodeById($podcastId, $episodeId)
    {
        $cacheName = "podcast#{$podcastId}_episode#{$episodeId}_published";
        if (!($found = cache($cacheName))) {
            $found = $this->where([
                'id' => $episodeId,
            ])
                ->where('podcast_id', $podcastId)
                ->where('`published_at` <= NOW()', null, false)
                ->first();

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * Gets all episodes for a podcast ordered according to podcast type
     * Filtered depending on year or season
     *
     * @param int $podcastId
     *
     * @return \App\Entities\Episode[]
     */
    public function getPodcastEpisodes(
        int $podcastId,
        string $podcastType,
        string $year = null,
        string $season = null
    ): array {
        $cacheName = implode(
            '_',
            array_filter([
                "podcast#{$podcastId}",
                $year,
                $season ? 'season' . $season : null,
                'episodes',
            ]),
        );

        if (!($found = cache($cacheName))) {
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

            if ($podcastType == 'serial') {
                // podcast is serial
                $found = $this->where($where)
                    ->where('`published_at` <= NOW()', null, false)
                    ->orderBy('season_number DESC, number ASC')
                    ->findAll();
            } else {
                $found = $this->where($where)
                    ->where('`published_at` <= NOW()', null, false)
                    ->orderBy('published_at', 'DESC')
                    ->findAll();
            }

            $secondsToNextUnpublishedEpisode = $this->getSecondsToNextUnpublishedEpisode(
                $podcastId,
            );

            cache()->save(
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
     * Returns the timestamp difference in seconds between the next episode to publish and the current timestamp
     * Returns false if there's no episode to publish
     *
     * @param int $podcastId
     *
     * @return int|false seconds
     */
    public function getSecondsToNextUnpublishedEpisode(int $podcastId)
    {
        $result = $this->select(
            'TIMESTAMPDIFF(SECOND, NOW(), `published_at`) as timestamp_diff',
        )
            ->where([
                'podcast_id' => $podcastId,
            ])
            ->where('`published_at` > NOW()', null, false)
            ->orderBy('published_at', 'asc')
            ->get()
            ->getResultArray();

        return (int) $result ? $result[0]['timestamp_diff'] : false;
    }

    protected function writeEnclosureMetadata(array $data)
    {
        helper('id3');

        $episode = (new EpisodeModel())->find(
            is_array($data['id']) ? $data['id'][0] : $data['id'],
        );

        write_enclosure_tags($episode);

        return $data;
    }

    public function clearCache(array $data)
    {
        $episode = (new EpisodeModel())->find(
            is_array($data['id']) ? $data['id'][0] : $data['id'],
        );

        // delete cache for rss feed
        cache()->deleteMatching("podcast#{$episode->podcast_id}_feed*");

        // delete model requests cache
        cache()->delete("podcast#{$episode->podcast_id}_episodes");

        cache()->delete("podcast_episode#{$episode->id}");
        cache()->deleteMatching(
            "podcast#{$episode->podcast_id}_episode#{$episode->id}*",
        );
        cache()->delete(
            "podcast#{$episode->podcast_id}_episode@{$episode->slug}",
        );

        cache()->deleteMatching(
            "page_podcast#{$episode->podcast_id}_activity*",
        );
        cache()->deleteMatching(
            "page_podcast#{$episode->podcast_id}_episode#{$episode->id}_*",
        );
        cache()->deleteMatching('page_credits_*');

        if ($episode->season_number) {
            cache()->deleteMatching("podcast#{$episode->podcast_id}_season*");
            cache()->deleteMatching(
                "page_podcast#{$episode->podcast_id}_episodes_season*",
            );
        } else {
            cache()->deleteMatching("podcast#{$episode->podcast_id}_year*");
            cache()->deleteMatching(
                "page_podcast#{$episode->podcast_id}_episodes_year*",
            );
        }

        // delete query cache
        cache()->delete("podcast#{$episode->podcast_id}_defaultQuery");
        cache()->delete("podcast#{$episode->podcast_id}_years");
        cache()->delete("podcast#{$episode->podcast_id}_seasons");

        return $data;
    }
}
