<?php

/**
 * Class AnalyticsPodcastByCountryModel
 * Model for analytics_podcasts_by_country table in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class AnalyticsPodcastByCountryModel extends Model
{
    protected $table = 'analytics_podcasts_by_country';

    protected $allowedFields = [];

    protected $returnType = \App\Entities\AnalyticsPodcastsByCountry::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;

    /**
     * Gets country data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataWeekly(int $podcastId): array
    {
        if (
            !($found = cache(
                "{$podcastId}_analytics_podcast_by_country_weekly"
            ))
        ) {
            $found = $this->select('`country_code` as `labels`')
                ->selectSum('`hits`', '`values`')
                ->where([
                    '`podcast_id`' => $podcastId,
                    '`date` >' => date('Y-m-d', strtotime('-1 week')),
                ])
                ->groupBy('`labels`')
                ->orderBy('`values`', 'DESC')
                ->findAll(10);

            cache()->save(
                "{$podcastId}_analytics_podcast_by_country_weekly",
                $found,
                600
            );
        }
        return $found;
    }

    /**
     * Gets country data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataYearly(int $podcastId): array
    {
        if (
            !($found = cache(
                "{$podcastId}_analytics_podcast_by_country_yearly"
            ))
        ) {
            $found = $this->select('`country_code` as `labels`')
                ->selectSum('`hits`', '`values`')
                ->where([
                    '`podcast_id`' => $podcastId,
                    '`date` >' => date('Y-m-d', strtotime('-1 year')),
                ])
                ->groupBy('`labels`')
                ->orderBy('`values`', 'DESC')
                ->findAll(10);

            cache()->save(
                "{$podcastId}_analytics_podcast_by_country_yearly",
                $found,
                600
            );
        }
        return $found;
    }
}
