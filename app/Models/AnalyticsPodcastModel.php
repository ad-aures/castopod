<?php

/**
 * Class AnalyticsPodcastModel
 * Model for analytics_podcasts table in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class AnalyticsPodcastModel extends Model
{
    protected $table = 'analytics_podcasts';

    protected $allowedFields = [];

    protected $returnType = \App\Entities\AnalyticsPodcasts::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;

    /**
     * Gets hits data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataByDay(int $podcastId): array
    {
        if (!($found = cache("{$podcastId}_analytics_podcast_by_day"))) {
            $found = $this->select('date as labels, hits as values')
                ->where([
                    'podcast_id' => $podcastId,
                    'date >' => date('Y-m-d', strtotime('-60 days')),
                ])
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()->save("{$podcastId}_analytics_podcast_by_day", $found, 600);
        }
        return $found;
    }

    /**
     * Gets hits data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataByWeekday(int $podcastId): array
    {
        if (!($found = cache("{$podcastId}_analytics_podcasts_by_weekday"))) {
            $found = $this->select(
                'LEFT(DAYNAME(date),3) as labels, WEEKDAY(date) as sort_labels',
            )
                ->selectSum('hits', 'values')
                ->where([
                    'podcast_id' => $podcastId,
                    'date >' => date('Y-m-d', strtotime('-60 days')),
                ])
                ->groupBy('labels, sort_labels')
                ->orderBy('sort_labels', 'ASC')
                ->findAll();

            cache()->save(
                "{$podcastId}_analytics_podcasts_by_weekday",
                $found,
                600,
            );
        }
        return $found;
    }

    /**
     * Gets bandwidth data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataBandwidthByDay(int $podcastId): array
    {
        if (!($found = cache("{$podcastId}_analytics_podcast_by_bandwidth"))) {
            $found = $this->select(
                'date as labels, round(bandwidth / 1048576, 1) as `values`',
            )
                ->where([
                    'podcast_id' => $podcastId,
                    'date >' => date('Y-m-d', strtotime('-60 days')),
                ])
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()->save(
                "{$podcastId}_analytics_podcast_by_bandwidth",
                $found,
                600,
            );
        }
        return $found;
    }

    /**
     * Gets hits data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataByMonth(int $podcastId): array
    {
        if (!($found = cache("{$podcastId}_analytics_podcast_by_month"))) {
            $found = $this->select('DATE_FORMAT(date,"%Y-%m-01") as labels')
                ->selectSum('hits', 'values')
                ->where([
                    'podcast_id' => $podcastId,
                ])
                ->groupBy('labels')
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()->save(
                "{$podcastId}_analytics_podcast_by_month",
                $found,
                600,
            );
        }
        return $found;
    }

    /**
     * Gets unique listeners data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataUniqueListenersByDay(int $podcastId): array
    {
        if (
            !($found = cache(
                "{$podcastId}_analytics_podcast_unique_listeners_by_day",
            ))
        ) {
            $found = $this->select('date as labels, unique_listeners as values')
                ->where([
                    'podcast_id' => $podcastId,
                    'date >' => date('Y-m-d', strtotime('-60 days')),
                ])
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()->save(
                "{$podcastId}_analytics_podcast_unique_listeners_by_day",
                $found,
                600,
            );
        }
        return $found;
    }

    /**
     * Gets unique listeners data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataUniqueListenersByMonth(int $podcastId): array
    {
        if (
            !($found = cache(
                "{$podcastId}_analytics_podcast_unique_listeners_by_month",
            ))
        ) {
            $found = $this->select('DATE_FORMAT(date,"%Y-%m-01") as labels')
                ->selectSum('unique_listeners', 'values')
                ->where([
                    'podcast_id' => $podcastId,
                ])
                ->groupBy('labels')
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()->save(
                "{$podcastId}_analytics_podcast_unique_listeners_by_month",
                $found,
                600,
            );
        }
        return $found;
    }

    /**
     * Gets listening-time data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataTotalListeningTimeByDay(int $podcastId): array
    {
        if (
            !($found = cache(
                "{$podcastId}_analytics_podcast_listening_time_by_day",
            ))
        ) {
            $found = $this->select('date as labels')
                ->selectSum('duration', 'values')
                ->where([
                    $this->table . '.podcast_id' => $podcastId,
                    'date >' => date('Y-m-d', strtotime('-60 days')),
                ])
                ->groupBy('labels')
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()->save(
                "{$podcastId}_analytics_podcast_listening_time_by_day",
                $found,
                600,
            );
        }
        return $found;
    }

    /**
     * Gets listening-time data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataTotalListeningTimeByMonth(int $podcastId): array
    {
        if (
            !($found = cache(
                "{$podcastId}_analytics_podcast_listening_time_by_month",
            ))
        ) {
            $found = $this->select('DATE_FORMAT(date,"%Y-%m-01") as labels')
                ->selectSum('duration', 'values')
                ->where([
                    $this->table . '.podcast_id' => $podcastId,
                ])
                ->groupBy('labels')
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()->save(
                "{$podcastId}_analytics_podcast_listening_time_by_month",
                $found,
                600,
            );
        }
        return $found;
    }
}
