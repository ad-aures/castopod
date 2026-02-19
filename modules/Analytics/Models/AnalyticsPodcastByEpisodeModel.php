<?php

declare(strict_types=1);

/**
 * Class AnalyticsPodcastByEpisodeModel Model for analytics_podcasts_by_episodes table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Models;

use CodeIgniter\Model;
use Modules\Analytics\Entities\AnalyticsPodcastsByEpisode;

class AnalyticsPodcastByEpisodeModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'analytics_podcasts_by_episode';

    /**
     * @var class-string<AnalyticsPodcastsByEpisode>
     */
    protected $returnType = AnalyticsPodcastsByEpisode::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = false;

    /**
     * @return AnalyticsPodcastsByEpisode[]
     */
    public function getDataByDay(int $podcastId, int $episodeId): array
    {
        if (
            ! ($found = cache("{$podcastId}_{$episodeId}_analytics_podcast_by_episode_by_day"))
        ) {
            $found = $this->select('date as labels')
                ->selectSum('hits', 'values')
                ->where([
                    'episode_id' => $episodeId,
                    'podcast_id' => $podcastId,
                    'age <'      => 60,
                ])
                ->groupBy('labels')
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()
                ->save("{$podcastId}_{$episodeId}_analytics_podcast_by_episode_by_day", $found, 600);
        }

        return $found;
    }

    /**
     * @return AnalyticsPodcastsByEpisode[]
     */
    public function getDataByMonth(int $podcastId, ?int $episodeId = null): array
    {
        if (
            ! ($found = cache("{$podcastId}_{$episodeId}_analytics_podcast_by_episode_by_month"))
        ) {
            $found = $this->select('DATE_FORMAT(date,"%Y-%m-01") as labels')
                ->selectSum('hits', 'values')
                ->where([
                    'episode_id' => $episodeId,
                    'podcast_id' => $podcastId,
                ])
                ->groupBy('labels')
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()
                ->save("{$podcastId}_{$episodeId}_analytics_podcast_by_episode_by_month", $found, 600);
        }

        return $found;
    }
}
