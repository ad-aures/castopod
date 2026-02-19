<?php

declare(strict_types=1);

/**
 * Class AnalyticsWebsiteByBrowserModel Model for analytics_website_by_browser table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Models;

use CodeIgniter\Model;
use Modules\Analytics\Entities\AnalyticsWebsiteByBrowser;

class AnalyticsWebsiteByBrowserModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'analytics_website_by_browser';

    /**
     * @var class-string<AnalyticsWebsiteByBrowser>
     */
    protected $returnType = AnalyticsWebsiteByBrowser::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = false;

    /**
     * Gets browser data for a podcast
     *
     * @return AnalyticsWebsiteByBrowser[]
     */
    public function getData(int $podcastId): array
    {
        if (! ($found = cache("{$podcastId}_analytics_website_by_browser"))) {
            $oneWeekAgo = date('Y-m-d', strtotime('-1 week'));
            $found = $this->select('browser as labels')
                ->selectSum('hits', 'values')
                ->where([
                    'podcast_id' => $podcastId,
                    'date >'     => $oneWeekAgo,
                ])
                ->groupBy('labels')
                ->orderBy('values', 'DESC')
                ->findAll();

            cache()
                ->save("{$podcastId}_analytics_website_by_browser", $found, 600);
        }

        return $found;
    }
}
