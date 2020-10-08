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
     * Gets player data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataByApp(int $podcastId): array
    {
        if (
            !($found = cache(
                "{$podcastId}_analytics_podcasts_by_player_by_app"
            ))
        ) {
            $found = $this->select('`app` as `labels`')
                ->selectSum('`hits`', '`values`')
                ->where([
                    '`podcast_id`' => $podcastId,
                    '`app` !=' => '',
                    '`bot`' => 0,
                    '`date` >' => date('Y-m-d', strtotime('-1 week')),
                ])
                ->groupBy('`labels`')
                ->orderBy('`values`', 'DESC')
                ->findAll(10);

            cache()->save(
                "{$podcastId}_analytics_podcasts_by_player_by_app",
                $found,
                600
            );
        }

        return $found;
    }

    /**
     * Gets device data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataByDevice(int $podcastId): array
    {
        if (
            !($found = cache(
                "{$podcastId}_analytics_podcasts_by_player_by_device"
            ))
        ) {
            $foundApp = $this->select(
                'CONCAT_WS("/", `device`, `os`, `app`) as `ids`, `app` as `labels`, CONCAT_WS("/", `device`, `os`) as `parents`'
            )
                ->selectSum('`hits`', '`values`')
                ->where([
                    '`podcast_id`' => $podcastId,
                    '`app` !=' => null,
                    '`bot`' => 0,
                    '`date` >' => date('Y-m-d', strtotime('-1 week')),
                ])
                ->groupBy('`ids`')
                ->orderBy('`values`', 'DESC')
                ->findAll();

            $foundOs = $this->select(
                'CONCAT_WS("/", `device`, `os`) as `ids`, `os` as `labels`, `device` as `parents`'
            )
                ->selectSum('`hits`', '`values`')
                ->where([
                    '`podcast_id`' => $podcastId,
                    '`os` !=' => null,
                    '`bot`' => 0,
                    '`date` >' => date('Y-m-d', strtotime('-1 week')),
                ])
                ->groupBy('`ids`')
                ->orderBy('`values`', 'DESC')
                ->findAll();

            $foundDevice = $this->select(
                '`device` as `ids`, `device` as `labels`, "" as `parents`'
            )
                ->selectSum('`hits`', '`values`')
                ->where([
                    '`podcast_id`' => $podcastId,
                    '`device` !=' => null,
                    '`bot`' => 0,
                    '`date` >' => date('Y-m-d', strtotime('-1 week')),
                ])
                ->groupBy('`ids`')
                ->orderBy('`values`', 'DESC')
                ->findAll();

            $foundBot = $this->select(
                '"bots" as `ids`, "Bots" as `labels`, "" as `parents`'
            )
                ->selectSum('`hits`', '`values`')
                ->where([
                    '`podcast_id`' => $podcastId,
                    '`bot`' => 1,
                    '`date` >' => date('Y-m-d', strtotime('-1 week')),
                ])
                ->groupBy('`ids`')
                ->orderBy('`values`', 'DESC')
                ->findAll();

            $found = array_merge($foundApp, $foundOs, $foundDevice, $foundBot);
            cache()->save(
                "{$podcastId}_analytics_podcasts_by_player_by_device",
                $found,
                600
            );
        }

        return $found;
    }
}
