<?php

/**
 * Class AnalyticsPodcastByServiceModel Model for analytics_podcasts_by_player table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Models;

use Analytics\Entities\AnalyticsPodcastsByService;
use CodeIgniter\Model;

class AnalyticsPodcastByServiceModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'analytics_podcasts_by_player';

    /**
     * @var string
     */
    protected $returnType = AnalyticsPodcastsByService::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = false;

    /**
     * Gets service data for a podcast
     *
     * @return AnalyticsPodcastsByService[]
     */
    public function getDataByServiceWeekly(int $podcastId): array
    {
        if (
            ! ($found = cache("{$podcastId}_analytics_podcasts_by_service_weekly",))
        ) {
            $oneWeekAgo = date('Y-m-d', strtotime('-1 week'));
            $found = $this->select('service as labels')
                ->selectSum('hits', 'values')
                ->where([
                    'podcast_id' => $podcastId,
                    'service !=' => '',
                    'is_bot' => 0,
                    'date >' => $oneWeekAgo,
                ])
                ->groupBy('labels')
                ->orderBy('values', 'DESC')
                ->findAll();
            cache()
                ->save("{$podcastId}_analytics_podcasts_by_service_weekly", $found, 600,);
        }
        return $found;
    }
}
