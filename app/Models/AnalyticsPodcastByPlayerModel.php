<?php

/**
 * Class AnalyticsPodcastByPlayerModel
 * Model for analytics_podcasts_by_player table in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class AnalyticsPodcastByPlayerModel extends Model
{
    protected $table = 'analytics_podcasts_by_player';

    protected $allowedFields = [];

    protected $returnType = \App\Entities\AnalyticsPodcastsByPlayer::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;

    /**
     * Gets service data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataByServiceWeekly(int $podcastId): array
    {
        if (
            !($found = cache(
                "{$podcastId}_analytics_podcasts_by_player_by_service_weekly"
            ))
        ) {
            $found = $this->select('`service` as `labels`')
                ->selectSum('`hits`', '`values`')
                ->where([
                    '`podcast_id`' => $podcastId,
                    '`service` !=' => '',
                    '`is_bot`' => 0,
                    '`date` >' => date('Y-m-d', strtotime('-1 week')),
                ])
                ->groupBy('`labels`')
                ->orderBy('`values`', 'DESC')
                ->findAll(10);

            cache()->save(
                "{$podcastId}_analytics_podcasts_by_player_by_service_weekly",
                $found,
                600
            );
        }
        return $found;
    }

    /**
     * Gets player data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataByAppWeekly(int $podcastId): array
    {
        if (
            !($found = cache(
                "{$podcastId}_analytics_podcasts_by_player_by_app_weekly"
            ))
        ) {
            $found = $this->select('`app` as `labels`')
                ->selectSum('`hits`', '`values`')
                ->where([
                    '`podcast_id`' => $podcastId,
                    '`app` !=' => '',
                    '`is_bot`' => 0,
                    '`date` >' => date('Y-m-d', strtotime('-1 week')),
                ])
                ->groupBy('`labels`')
                ->orderBy('`values`', 'DESC')
                ->findAll(10);

            cache()->save(
                "{$podcastId}_analytics_podcasts_by_player_by_app_weekly",
                $found,
                600
            );
        }
        return $found;
    }

    /**
     * Gets player data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataByAppYearly(int $podcastId): array
    {
        if (
            !($found = cache(
                "{$podcastId}_analytics_podcasts_by_player_by_app_yearly"
            ))
        ) {
            $found = $this->select('`app` as `labels`')
                ->selectSum('`hits`', '`values`')
                ->where([
                    '`podcast_id`' => $podcastId,
                    '`app` !=' => '',
                    '`is_bot`' => 0,
                    '`date` >' => date('Y-m-d', strtotime('-1 year')),
                ])
                ->groupBy('`labels`')
                ->orderBy('`values`', 'DESC')
                ->findAll(10);

            cache()->save(
                "{$podcastId}_analytics_podcasts_by_player_by_app_yearly",
                $found,
                600
            );
        }
        return $found;
    }

    /**
     * Gets os data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataByOsWeekly(int $podcastId): array
    {
        if (
            !($found = cache(
                "{$podcastId}_analytics_podcasts_by_player_by_os_weekly"
            ))
        ) {
            $found = $this->select('`os` as `labels`')
                ->selectSum('`hits`', '`values`')
                ->where([
                    '`podcast_id`' => $podcastId,
                    '`app` !=' => '',
                    '`os` !=' => '',
                    '`is_bot`' => 0,
                    '`date` >' => date('Y-m-d', strtotime('-1 week')),
                ])
                ->groupBy('`labels`')
                ->orderBy('`values`', 'DESC')
                ->findAll(10);

            cache()->save(
                "{$podcastId}_analytics_podcasts_by_player_by_os_weekly",
                $found,
                600
            );
        }
        return $found;
    }

    /**
     * Gets player data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataByDeviceWeekly(int $podcastId): array
    {
        if (
            !($found = cache(
                "{$podcastId}_analytics_podcasts_by_player_by_device_weekly"
            ))
        ) {
            $found = $this->select('`device` as `labels`')
                ->selectSum('`hits`', '`values`')
                ->where([
                    '`podcast_id`' => $podcastId,
                    '`device` !=' => '',
                    '`is_bot`' => 0,
                    '`date` >' => date('Y-m-d', strtotime('-1 week')),
                ])
                ->groupBy('`labels`')
                ->orderBy('`values`', 'DESC')
                ->findAll(10);

            cache()->save(
                "{$podcastId}_analytics_podcasts_by_player_by_device_weekly",
                $found,
                600
            );
        }
        return $found;
    }

    /**
     * Gets bots data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataBots(int $podcastId): array
    {
        if (
            !($found = cache("{$podcastId}_analytics_podcasts_by_player_bots"))
        ) {
            $found = $this->select('DATE_FORMAT(`date`,"%Y-%m-01") as `labels`')
                ->selectSum('`hits`', '`values`')
                ->where([
                    '`podcast_id`' => $podcastId,
                    '`is_bot`' => 1,
                    '`date` >' => date('Y-m-d', strtotime('-1 year')),
                ])
                ->groupBy('`labels`')
                ->orderBy('`labels`', 'ASC')
                ->findAll(10);

            cache()->save(
                "{$podcastId}_analytics_podcasts_by_player_bots",
                $found,
                600
            );
        }
        return $found;
    }
}
