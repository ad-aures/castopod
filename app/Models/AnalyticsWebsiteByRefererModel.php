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
            $found = $this->select('`referer` as `labels`')
                ->selectSum('`hits`', '`values`')
                ->groupBy('`referer`')
                ->where([
                    '`podcast_id`' => $podcastId,
                    '`date` >' => date('Y-m-d', strtotime('-1 week')),
                ])
                ->orderBy('`values`', 'DESC')
                ->limit(10)
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
    public function getDataByDomain(int $podcastId): array
    {
        if (!($found = cache("{$podcastId}_analytics_website_by_domain"))) {
            $found = $this->select('`domain` as `labels`')
                ->selectSum('`hits`', '`values`')
                ->groupBy('`domain`')
                ->where([
                    '`podcast_id`' => $podcastId,
                    '`date` >' => date('Y-m-d', strtotime('-1 week')),
                ])
                ->orderBy('`values`', 'DESC')
                ->limit(10)
                ->findAll();

            cache()->save(
                "{$podcastId}_analytics_website_by_domain",
                $found,
                600
            );
        }
        return $found;
    }
}
