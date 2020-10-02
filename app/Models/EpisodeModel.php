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
        'description',
        'image_uri',
        'parental_advisory',
        'number',
        'season_number',
        'type',
        'block',
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
        'description' => 'required',
        'number' => 'is_natural_no_zero|permit_empty',
        'season_number' => 'is_natural_no_zero|permit_empty',
        'type' => 'required',
        'published_at' => 'valid_date|permit_empty',
        'created_by' => 'required',
        'updated_by' => 'required',
    ];
    protected $validationMessages = [];

    protected $afterInsert = ['writeEnclosureMetadata'];
    // clear cache beforeUpdate because if slug changes, so will the episode link
    protected $beforeUpdate = ['clearCache'];
    protected $afterUpdate = ['writeEnclosureMetadata'];
    protected $beforeDelete = ['clearCache'];

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

        $episode = $episodeModel->find(
            is_array($data['id']) ? $data['id'][0] : $data['id']
        );

        // delete cache for rss feed, podcast and episode pages
        cache()->delete(md5($episode->podcast->feed_url));
        cache()->delete(md5($episode->podcast->link));
        cache()->delete(md5($episode->link));

        // delete model requests cache
        cache()->delete("podcast{$episode->podcast_id}_episodes");

        // delete episode lists cache per year / season
        $years = $episodeModel->getYears($episode->podcast_id);
        $seasons = $episodeModel->getSeasons($episode->podcast_id);

        foreach ($years as $year) {
            cache()->delete(
                "podcast{$episode->podcast_id}_{$year['year']}_episodes"
            );
            cache()->delete(
                "page_podcast{$episode->podcast_id}_{$year['year']}"
            );
        }
        foreach ($seasons as $season) {
            cache()->delete(
                "podcast{$episode->podcast_id}_season{$season['season_number']}_episodes"
            );
            cache()->delete(
                "page_podcast{$episode->podcast_id}_season{$season['season_number']}"
            );
        }

        cache()->delete("podcast{$episode->podcast_id}_defaultQuery");
        cache()->delete("podcast{$episode->podcast_id}_years");
        cache()->delete("podcast{$episode->podcast_id}_seasons");

        cache()->delete(
            "podcast{$episode->podcast_id}_episode@{$episode->slug}"
        );

        return $data;
    }

    public function getEpisodeBySlug($podcastId, $episodeSlug)
    {
        if (!($found = cache("podcast{$podcastId}_episode@{$episodeSlug}"))) {
            $found = $this->where([
                'podcast_id' => $podcastId,
                'slug' => $episodeSlug,
            ])->first();

            cache()->save(
                "podcast{$podcastId}_episode@{$episodeSlug}",
                $found,
                DECADE
            );
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
                "podcast{$podcastId}",
                $year,
                $season ? 'season' . $season : null,
                'episodes',
            ])
        );

        if (!($found = cache($cacheName))) {
            $where = ['podcast_id' => $podcastId];
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
                    ->orderBy('season_number DESC, number ASC')
                    ->findAll();
            } else {
                $found = $this->where($where)
                    ->orderBy('published_at', 'DESC')
                    ->findAll();
            }

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getYears(int $podcastId): array
    {
        if (!($found = cache("podcast{$podcastId}_years"))) {
            $found = $this->select(
                'YEAR(published_at) as year, count(*) as number_of_episodes'
            )
                ->where(['podcast_id' => $podcastId, 'season_number' => null])
                ->groupBy('year')
                ->orderBy('year', 'DESC')
                ->get()
                ->getResultArray();

            cache()->save("podcast{$podcastId}_years", $found, DECADE);
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
                ])
                ->groupBy('season_number')
                ->orderBy('season_number', 'ASC')
                ->get()
                ->getResultArray();

            cache()->save("podcast{$podcastId}_seasons", $found, DECADE);
        }

        return $found;
    }

    /**
     * Returns the default query for displaying the episode list on the podcast page
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
            ->first();

        $nextData = $this->orderBy('(' . $sortNumberField . ') ASC')
            ->where([
                'podcast_id' => $episode->podcast_id,
                $sortNumberField . ' >' => $sortNumberValue,
            ])
            ->first();

        return [
            'previous' => $previousData,
            'next' => $nextData,
        ];
    }
}
