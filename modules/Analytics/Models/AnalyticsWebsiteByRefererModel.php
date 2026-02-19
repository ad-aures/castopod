<?php

declare(strict_types=1);

/**
 * Class AnalyticsWebsiteByRefererModel Model for analytics_website_by_referer table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Models;

use CodeIgniter\Model;
use Modules\Analytics\Entities\AnalyticsWebsiteByReferer;

class AnalyticsWebsiteByRefererModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'analytics_website_by_referer';

    /**
     * @var class-string<AnalyticsWebsiteByReferer>
     */
    protected $returnType = AnalyticsWebsiteByReferer::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = false;

    /**
     * Gets referer data for a podcast
     *
     * @return AnalyticsWebsiteByReferer[]
     */
    public function getData(int $podcastId): array
    {
        if (! ($found = cache("{$podcastId}_analytics_website_by_referer"))) {
            $oneWeekAgo = date('Y-m-d', strtotime('-1 week'));
            $found = $this->select('referer_url as labels')
                ->selectSum('hits', 'values')
                ->where([
                    'podcast_id' => $podcastId,
                    'date >'     => $oneWeekAgo,
                ])
                ->groupBy('labels')
                ->orderBy('values', 'DESC')
                ->findAll();
            cache()
                ->save("{$podcastId}_analytics_website_by_referer", $found, 600);
        }

        return $found;
    }

    /**
     * Gets domain data for a podcast
     *
     * @return AnalyticsWebsiteByReferer[]
     */
    public function getDataByDomainWeekly(int $podcastId): array
    {
        if (
            ! ($found = cache("{$podcastId}_analytics_website_by_domain_weekly"))
        ) {
            $oneWeekAgo = date('Y-m-d', strtotime('-1 week'));
            $found = $this->select('domain as labels')
                ->selectSum('hits', 'values')
                ->where([
                    'podcast_id' => $podcastId,
                    'date >'     => $oneWeekAgo,
                ])
                ->groupBy('labels')
                ->orderBy('values', 'DESC')
                ->findAll();
            cache()
                ->save("{$podcastId}_analytics_website_by_domain_weekly", $found, 600);
        }

        return $found;
    }

    /**
     * Gets domain data for a podcast
     *
     * @return AnalyticsWebsiteByReferer[]
     */
    public function getDataByDomainYearly(int $podcastId): array
    {
        if (
            ! ($found = cache("{$podcastId}_analytics_website_by_domain_yearly"))
        ) {
            $oneYearAgo = date('Y-m-d', strtotime('-1 year'));
            $found = $this->select('domain as labels')
                ->selectSum('hits', 'values')
                ->where([
                    'podcast_id' => $podcastId,
                    'date >'     => $oneYearAgo,
                ])
                ->groupBy('labels')
                ->orderBy('values', 'DESC')
                ->findAll();
            cache()
                ->save("{$podcastId}_analytics_website_by_domain_yearly", $found, 600);
        }

        return $found;
    }
}
