<?php

/**
 * Class AnalyticsPodcastByEpisodeModel
 * Model for analytics_podcasts_by_episodes table in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class AnalyticsPodcastByEpisodeModel extends Model
{
    protected $table = 'analytics_podcasts_by_episode';

    protected $allowedFields = [];

    protected $returnType = \App\Entities\AnalyticsPodcastsByEpisode::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;

    /**
     * @param int $podcastId, $episodeId
     *
     * @return array
     */
    public function getDataByDay(int $podcastId, int $episodeId = null): array
    {
        if (!$episodeId) {
            if (
                !($found = cache(
                    "{$podcastId}_analytics_podcast_by_episode_by_day"
                ))
            ) {
                $lastEpisodes = (new EpisodeModel())
                    ->select('`id`, `season_number`, `number`, `title`')
                    ->orderBy('`id`', 'DESC')
                    ->where(['`podcast_id`' => $podcastId])
                    ->findAll(5);

                $found = $this->select('`age` AS `X`');

                $letter = 97;
                foreach ($lastEpisodes as $episode) {
                    $found = $found
                        ->selectSum(
                            '(CASE WHEN `episode_id`=' .
                                $episode->id .
                                ' THEN `hits` END)',
                            '`' . chr($letter) . 'Y`'
                        )
                        ->select(
                            '"' .
                                (empty($episode->season_number)
                                    ? ''
                                    : $episode->season_number) .
                                (empty($episode->number)
                                    ? ''
                                    : '-' . $episode->number . '/ ') .
                                $episode->title .
                                '" AS `' .
                                chr($letter) .
                                'Value`'
                        );
                    $letter++;
                }

                $found = $found
                    ->where([
                        '`podcast_id`' => $podcastId,
                        '`age` <' => 60,
                    ])
                    ->groupBy('`X`')
                    ->orderBy('`X`', 'ASC')
                    ->findAll();

                cache()->save(
                    "{$podcastId}_analytics_podcast_by_episode_by_day",
                    $found,
                    600
                );
            }
            return $found;
        } else {
            if (
                !($found = cache(
                    "{$podcastId}_{$episodeId}_analytics_podcast_by_episode_by_day"
                ))
            ) {
                $found = $this->select('`date as `labels`')
                    ->selectSum('`hits`', '`values`')
                    ->where([
                        '`episode_id`' => $episodeId,
                        '`podcast_id`' => $podcastId,
                        '`age` <' => 60,
                    ])
                    ->groupBy('`labels`')
                    ->orderBy('`labels`', 'ASC')
                    ->findAll();

                cache()->save(
                    "{$podcastId}_{$episodeId}_analytics_podcast_by_episode_by_day",
                    $found,
                    600
                );
            }
            return $found;
        }
    }

    /**
     * @param int $podcastId, $episodeId
     *
     * @return array
     */
    public function getDataByMonth(int $podcastId, int $episodeId = null): array
    {
        if (
            !($found = cache(
                "{$podcastId}_{$episodeId}_analytics_podcast_by_episode_by_month"
            ))
        ) {
            $found = $this->select('DATE_FORMAT(`date`,"%Y-%m-01") as `labels`')
                ->selectSum('`hits`', '`values`')
                ->where([
                    'episode_id' => $episodeId,
                    'podcast_id' => $podcastId,
                ])
                ->groupBy('`labels`')
                ->orderBy('`labels`', 'ASC')
                ->findAll();

            cache()->save(
                "{$podcastId}_{$episodeId}_analytics_podcast_by_episode_by_month",
                $found,
                600
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
                "{$podcastId}_analytics_podcast_listening_time_by_day"
            ))
        ) {
            $found = $this->select('date as labels')
                ->selectSum('(enclosure_duration * hits)', 'values')
                ->join('episodes', 'id = episode_id', 'inner')
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
                600
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
                "{$podcastId}_analytics_podcast_listening_time_by_month"
            ))
        ) {
            $found = $this->select('DATE_FORMAT(`date`,"%Y-%m-01") as `labels`')
                ->selectSum('(enclosure_duration * hits)', 'values')
                ->join('episodes', 'id = episode_id', 'inner')
                ->where([
                    $this->table . '.podcast_id' => $podcastId,
                ])
                ->groupBy('`labels`')
                ->orderBy('`labels`', 'ASC')
                ->findAll();

            cache()->save(
                "{$podcastId}_analytics_podcast_listening_time_by_month",
                $found,
                600
            );
        }
        return $found;
    }
}
