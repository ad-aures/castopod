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
        'transcript_uri',
        'chapters_uri',
        'parental_advisory',
        'number',
        'season_number',
        'type',
        'is_blocked',
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

    public function getEpisodeBySlug($podcastId, $episodeSlug)
    {
        if (!($found = cache("podcast{$podcastId}_episode@{$episodeSlug}"))) {
            $found = $this->where([
                'podcast_id' => $podcastId,
                'slug' => $episodeSlug,
            ])
                ->where('`published_at` <= NOW()', null, false)
                ->first();

            cache()->save(
                "podcast{$podcastId}_episode@{$episodeSlug}",
                $found,
                DECADE
            );
        }

        return $found;
    }

    /**
     * Returns the previous episode based on episode ordering
     */
    public function getPreviousNextEpisodes($episode, $podcastType)
    {
        $sortNumberField =
            $podcastType == 'serial'
                ? 'if(isnull(season_number),0,season_number)*1000+number'
                : 'if(isnull(season_number),0,season_number)*100000000000000+published_at';
        $sortNumberValue =
            $podcastType == 'serial'
                ? (empty($episode->season_number)
                        ? 0
                        : $episode->season_number) *
                        1000 +
                    $episode->number
                : (empty($episode->season_number)
                        ? ''
                        : $episode->season_number) .
                    date('YmdHis', strtotime($episode->published_at));

        $previousData = $this->orderBy('(' . $sortNumberField . ') DESC')
            ->where([
                'podcast_id' => $episode->podcast_id,
                $sortNumberField . ' <' => $sortNumberValue,
            ])
            ->where('`published_at` <= NOW()', null, false)
            ->first();

        $nextData = $this->orderBy('(' . $sortNumberField . ') ASC')
            ->where([
                'podcast_id' => $episode->podcast_id,
                $sortNumberField . ' >' => $sortNumberValue,
            ])
            ->where('`published_at` <= NOW()', null, false)
            ->first();

        return [
            'previous' => $previousData,
            'next' => $nextData,
        ];
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
                "podcast{$podcastId}",
                $year,
                $season ? 'season' . $season : null,
                'episodes',
            ])
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
                $podcastId
            );

            cache()->save(
                $cacheName,
                $found,
                $secondsToNextUnpublishedEpisode
                    ? $secondsToNextUnpublishedEpisode
                    : DECADE
            );
        }

        return $found;
    }

    public function getYears(int $podcastId): array
    {
        if (!($found = cache("podcast{$podcastId}_years"))) {
            $found = $this->select(
                'YEAR(published_at) as year, count(*) as number_of_episodes'
            )
                ->where([
                    'podcast_id' => $podcastId,
                    'season_number' => null,
                    $this->deletedField => null,
                ])
                ->where('`published_at` <= NOW()', null, false)
                ->groupBy('year')
                ->orderBy('year', 'DESC')
                ->get()
                ->getResultArray();

            $secondsToNextUnpublishedEpisode = $this->getSecondsToNextUnpublishedEpisode(
                $podcastId
            );

            cache()->save(
                "podcast{$podcastId}_years",
                $found,
                $secondsToNextUnpublishedEpisode
                    ? $secondsToNextUnpublishedEpisode
                    : DECADE
            );
        }

        return $found;
    }

    public function getSeasons(int $podcastId): array
    {
        if (!($found = cache("podcast{$podcastId}_seasons"))) {
            $found = $this->select(
                'season_number, count(*) as number_of_episodes'
            )
                ->where([
                    'podcast_id' => $podcastId,
                    'season_number is not' => null,
                    $this->deletedField => null,
                ])
                ->where('`published_at` <= NOW()', null, false)
                ->groupBy('season_number')
                ->orderBy('season_number', 'ASC')
                ->get()
                ->getResultArray();

            $secondsToNextUnpublishedEpisode = $this->getSecondsToNextUnpublishedEpisode(
                $podcastId
            );

            cache()->save(
                "podcast{$podcastId}_seasons",
                $found,
                $secondsToNextUnpublishedEpisode
                    ? $secondsToNextUnpublishedEpisode
                    : DECADE
            );
        }

        return $found;
    }

    /**
     * Returns the default query for displaying the episode list on the podcast page
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDefaultQuery(int $podcastId)
    {
        if (!($defaultQuery = cache("podcast{$podcastId}_defaultQuery"))) {
            $seasons = $this->getSeasons($podcastId);

            if (!empty($seasons)) {
                // get latest season
                $defaultQuery = ['type' => 'season', 'data' => end($seasons)];
            } else {
                $years = $this->getYears($podcastId);
                if (!empty($years)) {
                    // get most recent year
                    $defaultQuery = ['type' => 'year', 'data' => $years[0]];
                } else {
                    $defaultQuery = null;
                }
            }

            cache()->save(
                "podcast{$podcastId}_defaultQuery",
                $defaultQuery,
                DECADE
            );
        }
        return $defaultQuery;
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
            'TIMESTAMPDIFF(SECOND, NOW(), `published_at`) as timestamp_diff'
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
            is_array($data['id']) ? $data['id'][0] : $data['id']
        );

        write_enclosure_tags($episode);

        return $data;
    }

    protected function clearCache(array $data)
    {
        $episodeModel = new EpisodeModel();
        $episode = (new EpisodeModel())->find(
            is_array($data['id']) ? $data['id'][0] : $data['id']
        );

        // delete cache for rss feed
        cache()->delete("podcast{$episode->podcast_id}_feed");
        foreach (\Opawg\UserAgentsPhp\UserAgentsRSS::$db as $service) {
            cache()->delete(
                "podcast{$episode->podcast_id}_feed_{$service['slug']}"
            );
        }

        // delete model requests cache
        cache()->delete("podcast{$episode->podcast_id}_episodes");

        cache()->delete(
            "podcast{$episode->podcast_id}_episode@{$episode->slug}"
        );

        // delete episode lists cache per year / season for a podcast
        // and localized pages
        $years = $episodeModel->getYears($episode->podcast_id);
        $seasons = $episodeModel->getSeasons($episode->podcast_id);
        $supportedLocales = config('App')->supportedLocales;

        foreach ($supportedLocales as $locale) {
            cache()->delete(
                "page_podcast{$episode->podcast->id}_episode{$episode->id}_{$locale}"
            );
        }

        foreach ($years as $year) {
            cache()->delete(
                "podcast{$episode->podcast_id}_{$year['year']}_episodes"
            );
            foreach ($supportedLocales as $locale) {
                cache()->delete(
                    "page_podcast{$episode->podcast_id}_{$year['year']}_{$locale}"
                );
            }
        }

        foreach ($seasons as $season) {
            cache()->delete(
                "podcast{$episode->podcast_id}_season{$season['season_number']}_episodes"
            );
            foreach ($supportedLocales as $locale) {
                cache()->delete(
                    "page_podcast{$episode->podcast_id}_season{$season['season_number']}_{$locale}"
                );
            }
        }

        // delete query cache
        cache()->delete("podcast{$episode->podcast_id}_defaultQuery");
        cache()->delete("podcast{$episode->podcast_id}_years");
        cache()->delete("podcast{$episode->podcast_id}_seasons");

        return $data;
    }
}
