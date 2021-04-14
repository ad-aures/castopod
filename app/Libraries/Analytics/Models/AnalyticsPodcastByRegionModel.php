<?php

/**
 * Class AnalyticsPodcastByRegionModel
 * Model for analytics_podcasts_by_region table in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Models;

use CodeIgniter\Model;

class AnalyticsPodcastByRegionModel extends Model
{
    protected $table = 'analytics_podcasts_by_region';

    protected $allowedFields = [];

    protected $returnType = \Analytics\Entities\AnalyticsPodcastsByRegion::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;

    /**
     * Gets region data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getData(int $podcastId): array
    {
        $locale = service('request')->getLocale();
        if (
            !($found = cache(
                "{$podcastId}_analytics_podcast_by_region_{$locale}",
            ))
        ) {
            $found = $this->select('country_code, region_code')
                ->selectSum('hits', 'value')
                ->selectAvg('latitude')
                ->selectAvg('longitude')
                ->groupBy('country_code, region_code')
                ->where([
                    'podcast_id' => $podcastId,
                    'date >' => date('Y-m-d', strtotime('-1 week')),
                ])
                ->orderBy('value', 'DESC')
                ->findAll();

            cache()->save(
                "{$podcastId}_analytics_podcast_by_region_{$locale}",
                $found,
                600,
            );
        }
        return $found;
    }
}
