<?php

declare(strict_types=1);

/**
 * Class AnalyticsPodcastByPlayerModel Model for analytics_podcasts_by_player table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Models;

use CodeIgniter\Model;
use Modules\Analytics\Entities\AnalyticsPodcastsByPlayer;

class AnalyticsPodcastByPlayerModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'analytics_podcasts_by_player';

    /**
     * @var class-string<AnalyticsPodcastsByPlayer>
     */
    protected $returnType = AnalyticsPodcastsByPlayer::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = false;

    /**
     * Gets player data for a podcast
     *
     * @return AnalyticsPodcastsByPlayer[]
     */
    public function getDataByAppWeekly(int $podcastId): array
    {
        if (
            ! ($found = cache("{$podcastId}_analytics_podcasts_by_player_by_app_weekly"))
        ) {
            $oneWeekAgo = date('Y-m-d', strtotime('-1 week'));
            $found = $this->select('app as labels')
                ->selectSum('hits', 'values')
                ->where([
                    'podcast_id' => $podcastId,
                    'app !='     => '',
                    'is_bot'     => 0,
                    'date >'     => $oneWeekAgo,
                ])
                ->groupBy('labels')
                ->orderBy('values', 'DESC')
                ->findAll();
            cache()
                ->save("{$podcastId}_analytics_podcasts_by_player_by_app_weekly", $found, 600);
        }

        return $found;
    }

    /**
     * Gets player data for a podcast
     *
     * @return AnalyticsPodcastsByPlayer[]
     */
    public function getDataByAppYearly(int $podcastId): array
    {
        if (
            ! ($found = cache("{$podcastId}_analytics_podcasts_by_player_by_app_yearly"))
        ) {
            $oneYearAgo = date('Y-m-d', strtotime('-1 year'));
            $found = $this->select('app as labels')
                ->selectSum('hits', 'values')
                ->where([
                    'podcast_id' => $podcastId,
                    'app !='     => '',
                    'is_bot'     => 0,
                    'date >'     => $oneYearAgo,
                ])
                ->groupBy('labels')
                ->orderBy('values', 'DESC')
                ->findAll();
            cache()
                ->save("{$podcastId}_analytics_podcasts_by_player_by_app_yearly", $found, 600);
        }

        return $found;
    }

    /**
     * Gets os data for a podcast
     *
     * @return AnalyticsPodcastsByPlayer[]
     */
    public function getDataByOsWeekly(int $podcastId): array
    {
        if (
            ! ($found = cache("{$podcastId}_analytics_podcasts_by_player_by_os_weekly"))
        ) {
            $oneWeekAgo = date('Y-m-d', strtotime('-1 week'));
            $found = $this->select('os as labels')
                ->selectSum('hits', 'values')
                ->where([
                    'podcast_id' => $podcastId,
                    'app !='     => '',
                    'os !='      => '',
                    'is_bot'     => 0,
                    'date >'     => $oneWeekAgo,
                ])
                ->groupBy('labels')
                ->orderBy('values', 'DESC')
                ->findAll();
            cache()
                ->save("{$podcastId}_analytics_podcasts_by_player_by_os_weekly", $found, 600);
        }

        return $found;
    }

    /**
     * Gets player data for a podcast
     *
     * @return AnalyticsPodcastsByPlayer[]
     */
    public function getDataByDeviceWeekly(int $podcastId): array
    {
        if (
            ! ($found = cache("{$podcastId}_analytics_podcasts_by_player_by_device_weekly"))
        ) {
            $oneWeekAgo = date('Y-m-d', strtotime('-1 week'));
            $found = $this->select('device as labels')
                ->selectSum('hits', 'values')
                ->where([
                    'podcast_id' => $podcastId,
                    'device !='  => '',
                    'is_bot'     => 0,
                    'date >'     => $oneWeekAgo,
                ])
                ->groupBy('labels')
                ->orderBy('values', 'DESC')
                ->findAll();
            cache()
                ->save("{$podcastId}_analytics_podcasts_by_player_by_device_weekly", $found, 600);
        }

        return $found;
    }

    /**
     * Gets bots data for a podcast
     *
     * @return AnalyticsPodcastsByPlayer[]
     */
    public function getDataBots(int $podcastId): array
    {
        if (
            ! ($found = cache("{$podcastId}_analytics_podcasts_by_player_bots"))
        ) {
            $oneYearAgo = date('Y-m-d', strtotime('-1 year'));
            $found = $this->select('DATE_FORMAT(date,"%Y-%m-01") as labels')
                ->selectSum('hits', 'values')
                ->where([
                    'podcast_id' => $podcastId,
                    'is_bot'     => 1,
                    'date >'     => $oneYearAgo,
                ])
                ->groupBy('labels')
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()
                ->save("{$podcastId}_analytics_podcasts_by_player_bots", $found, 600);
        }

        return $found;
    }
}
