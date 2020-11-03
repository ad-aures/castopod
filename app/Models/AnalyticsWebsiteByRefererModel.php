<?php

/**
 * Class AnalyticsWebsiteByRefererModel
 * Model for analytics_website_by_referer table in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class AnalyticsWebsiteByRefererModel extends Model
{
    protected $table = 'analytics_website_by_referer';

    protected $allowedFields = [];

    protected $returnType = \App\Entities\AnalyticsWebsiteByReferer::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;

    /**
     * Gets referer data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getData(int $podcastId): array
    {
        if (!($found = cache("{$podcastId}_analytics_website_by_referer"))) {
            $oneWeekAgo = date('Y-m-d', strtotime('-1 week'));
            $found = $this->select('`referer_url` as `labels`')
                ->selectSum('`hits`', '`values`')
                ->where([
                    '`podcast_id`' => $podcastId,
                    '`date` >' => $oneWeekAgo,
                ])
                ->groupBy('`labels`')
                ->orderBy('`values`', 'DESC')
                ->findAll();
            cache()->save(
                "{$podcastId}_analytics_website_by_referer",
                $found,
                600
            );
        }
        return $found;
    }

    /**
     * Gets domain data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataByDomainWeekly(int $podcastId): array
    {
        if (
            !($found = cache("{$podcastId}_analytics_website_by_domain_weekly"))
        ) {
            $oneWeekAgo = date('Y-m-d', strtotime('-1 week'));
            $found = $this->select(
                'SUBSTRING_INDEX(`domain`, \'.\', -2) as `labels`'
            )
                ->selectSum('`hits`', '`values`')
                ->where([
                    '`podcast_id`' => $podcastId,
                    '`date` >' => $oneWeekAgo,
                ])
                ->groupBy('`labels`')
                ->orderBy('`values`', 'DESC')
                ->findAll();
            cache()->save(
                "{$podcastId}_analytics_website_by_domain_weekly",
                $found,
                600
            );
        }
        return $found;
    }

    /**
     * Gets domain data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataByDomainYearly(int $podcastId): array
    {
        if (
            !($found = cache("{$podcastId}_analytics_website_by_domain_yearly"))
        ) {
            $oneYearAgo = date('Y-m-d', strtotime('-1 year'));
            $found = $this->select(
                'SUBSTRING_INDEX(`domain`, \'.\', -2) as `labels`'
            )
                ->selectSum('`hits`', '`values`')
                ->where([
                    '`podcast_id`' => $podcastId,
                    '`date` >' => $oneYearAgo,
                ])
                ->groupBy('`labels`')
                ->orderBy('`values`', 'DESC')
                ->findAll();
            cache()->save(
                "{$podcastId}_analytics_website_by_domain_yearly",
                $found,
                600
            );
        }
        return $found;
    }
}
