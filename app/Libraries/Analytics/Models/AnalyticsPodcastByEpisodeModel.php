<?php

/**
 * Class AnalyticsPodcastByEpisodeModel
 * Model for analytics_podcasts_by_episodes table in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Models;

use CodeIgniter\Model;

class AnalyticsPodcastByEpisodeModel extends Model
{
    protected $table = 'analytics_podcasts_by_episode';

    protected $allowedFields = [];

    protected $returnType = \Analytics\Entities\AnalyticsPodcastsByEpisode::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;

    /**
     * @param int $podcastId
     * @param int $episodeId
     *
     * @return array
     */
    public function getDataByDay(int $podcastId, int $episodeId): array
    {
        if (
            !($found = cache(
                "{$podcastId}_{$episodeId}_analytics_podcast_by_episode_by_day",
            ))
        ) {
            $found = $this->select('date as labels')
                ->selectSum('hits', 'values')
                ->where([
                    'episode_id' => $episodeId,
                    'podcast_id' => $podcastId,
                    'age <' => 60,
                ])
                ->groupBy('labels')
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()->save(
                "{$podcastId}_{$episodeId}_analytics_podcast_by_episode_by_day",
                $found,
                600,
            );
        }
        return $found;
    }

    /**
     * @param int $podcastId
     * @param int $episodeId
     *
     * @return array
     */
    public function getDataByMonth(int $podcastId, int $episodeId = null): array
    {
        if (
            !($found = cache(
                "{$podcastId}_{$episodeId}_analytics_podcast_by_episode_by_month",
            ))
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

            cache()->save(
                "{$podcastId}_{$episodeId}_analytics_podcast_by_episode_by_month",
                $found,
                600,
            );
        }
        return $found;
    }
}
