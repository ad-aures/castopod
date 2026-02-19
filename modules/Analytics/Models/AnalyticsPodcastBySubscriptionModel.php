<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Models;

use CodeIgniter\Model;
use Modules\Analytics\Entities\AnalyticsPodcastsBySubscription;

class AnalyticsPodcastBySubscriptionModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'analytics_podcasts_by_subscription';

    /**
     * @var class-string<AnalyticsPodcastsBySubscription>
     */
    protected $returnType = AnalyticsPodcastsBySubscription::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = false;

    public function getNumberOfDownloadsLast3Months(int $podcastId, int $subscriptionId): int
    {
        $cacheName = "{$podcastId}_{$subscriptionId}_analytics_podcast_by_subscription";

        if (
            ! ($found = cache($cacheName))
        ) {
            $found = (int) ($this->builder()
                ->selectSum('hits', 'total_hits')
                ->where([
                    'podcast_id'      => $podcastId,
                    'subscription_id' => $subscriptionId,
                ])
                ->where('`date` >= UTC_TIMESTAMP() - INTERVAL 3 month', null, false)
                ->get()
                ->getResultArray())[0]['total_hits'];

            cache()
                ->save($cacheName, $found, 600);
        }

        return $found;
    }
}
