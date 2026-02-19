<?php

declare(strict_types=1);

/**
 * Class AnalyticsPodcastModel Model for analytics_podcasts table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Models;

use CodeIgniter\Model;
use Modules\Analytics\Entities\AnalyticsPodcasts;
use Modules\Media\Models\MediaModel;

class AnalyticsPodcastModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'analytics_podcasts';

    /**
     * @var class-string<AnalyticsPodcasts>
     */
    protected $returnType = AnalyticsPodcasts::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = false;

    /**
     * Gets hits data for a podcast
     *
     * @return AnalyticsPodcasts[]
     */
    public function getDataByDay(int $podcastId): array
    {
        if (! ($found = cache("{$podcastId}_analytics_podcast_by_day"))) {
            $found = $this->select('date as labels, hits as values')
                ->where([
                    'podcast_id' => $podcastId,
                    'date >'     => date('Y-m-d', strtotime('-60 days')),
                ])
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()
                ->save("{$podcastId}_analytics_podcast_by_day", $found, 600);
        }

        return $found;
    }

    /**
     * Gets hits data for a podcast
     *
     * @return AnalyticsPodcasts[]
     */
    public function getDataByWeekday(int $podcastId): array
    {
        if (! ($found = cache("{$podcastId}_analytics_podcasts_by_weekday"))) {
            $found = $this->select('LEFT(DAYNAME(date),3) as labels, WEEKDAY(date) as sort_labels')
                ->selectSum('hits', 'values')
                ->where([
                    'podcast_id' => $podcastId,
                    'date >'     => date('Y-m-d', strtotime('-60 days')),
                ])
                ->groupBy('labels, sort_labels')
                ->orderBy('sort_labels', 'ASC')
                ->findAll();

            cache()
                ->save("{$podcastId}_analytics_podcasts_by_weekday", $found, 600);
        }

        return $found;
    }

    /**
     * Gets bandwidth data for a podcast
     *
     * @return AnalyticsPodcasts[]
     */
    public function getDataBandwidthByDay(int $podcastId): array
    {
        if (! ($found = cache("{$podcastId}_analytics_podcast_by_bandwidth"))) {
            $found = $this->select('date as labels, ROUND(bandwidth / 1000000, 2) as `values`')
                ->where([
                    'podcast_id' => $podcastId,
                    'date >'     => date('Y-m-d', strtotime('-60 days')),
                ])
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()
                ->save("{$podcastId}_analytics_podcast_by_bandwidth", $found, 600);
        }

        return $found;
    }

    /**
     * Gets hits data for a podcast
     *
     * @return AnalyticsPodcasts[]
     */
    public function getDataByMonth(int $podcastId): array
    {
        if (! ($found = cache("{$podcastId}_analytics_podcast_by_month"))) {
            $found = $this->select('DATE_FORMAT(date,"%Y-%m-01") as labels')
                ->selectSum('hits', 'values')
                ->where([
                    'podcast_id' => $podcastId,
                ])
                ->groupBy('labels')
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()
                ->save("{$podcastId}_analytics_podcast_by_month", $found, 600);
        }

        return $found;
    }

    /**
     * Gets unique listeners data for a podcast
     *
     * @return AnalyticsPodcasts[]
     */
    public function getDataUniqueListenersByDay(int $podcastId): array
    {
        if (
            ! ($found = cache("{$podcastId}_analytics_podcast_unique_listeners_by_day"))
        ) {
            $found = $this->select('date as labels, unique_listeners as values')
                ->where([
                    'podcast_id' => $podcastId,
                    'date >'     => date('Y-m-d', strtotime('-60 days')),
                ])
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()
                ->save("{$podcastId}_analytics_podcast_unique_listeners_by_day", $found, 600);
        }

        return $found;
    }

    /**
     * Gets unique listeners data for a podcast
     *
     * @return AnalyticsPodcasts[]
     */
    public function getDataUniqueListenersByMonth(int $podcastId): array
    {
        if (
            ! ($found = cache("{$podcastId}_analytics_podcast_unique_listeners_by_month"))
        ) {
            $found = $this->select('DATE_FORMAT(date,"%Y-%m-01") as labels')
                ->selectSum('unique_listeners', 'values')
                ->where([
                    'podcast_id' => $podcastId,
                ])
                ->groupBy('labels')
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()
                ->save("{$podcastId}_analytics_podcast_unique_listeners_by_month", $found, 600);
        }

        return $found;
    }

    /**
     * Gets listening-time data for a podcast
     *
     * @return AnalyticsPodcasts[]
     */
    public function getDataTotalListeningTimeByDay(int $podcastId): array
    {
        if (
            ! ($found = cache("{$podcastId}_analytics_podcast_listening_time_by_day"))
        ) {
            $found = $this->select('date as labels')
                ->selectSum('duration', 'values')
                ->where([
                    $this->table . '.podcast_id' => $podcastId,
                    'date >'                     => date('Y-m-d', strtotime('-60 days')),
                ])
                ->groupBy('labels')
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()
                ->save("{$podcastId}_analytics_podcast_listening_time_by_day", $found, 600);
        }

        return $found;
    }

    /**
     * Gets listening-time data for a podcast
     *
     * @return AnalyticsPodcasts[]
     */
    public function getDataTotalListeningTimeByMonth(int $podcastId): array
    {
        if (
            ! ($found = cache("{$podcastId}_analytics_podcast_listening_time_by_month"))
        ) {
            $found = $this->select('DATE_FORMAT(date,"%Y-%m-01") as labels')
                ->selectSum('duration', 'values')
                ->where([
                    $this->table . '.podcast_id' => $podcastId,
                ])
                ->groupBy('labels')
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()
                ->save("{$podcastId}_analytics_podcast_listening_time_by_month", $found, 600);
        }

        return $found;
    }

    /**
     * Gets total bandwidth data for instance
     *
     * @return AnalyticsPodcasts[]
     */
    public function getDataTotalBandwidthByMonth(): array
    {
        if (! ($found = cache('analytics_total_bandwidth_by_month'))) {
            $found = $this->select(
                'DATE_FORMAT(updated_at,"%Y-%m") as labels, ROUND(sum(bandwidth) / 1000000, 2) as `values`',
            )
                ->groupBy('labels')
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()
                ->save('analytics_total_bandwidth_by_month', $found, 600);
        }

        return $found;
    }

    /**
     * Get total storage
     *
     * @return AnalyticsPodcasts[]
     */
    public function getDataTotalStorageByMonth(): array
    {
        if (! ($found = cache('analytics_total_storage_by_month'))) {
            $found = new MediaModel()
                ->select('DATE_FORMAT(uploaded_at,"%Y-%m") as labels, ROUND(sum(file_size) / 1000000, 2) as `values`')
                ->groupBy('labels')
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()
                ->save('analytics_total_storage_by_month', $found, 600);
        }

        return $found;
    }
}
