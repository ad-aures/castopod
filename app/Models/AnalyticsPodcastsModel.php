<?php

/**
 * Class AnalyticsPodcastsModel
 * Model for analytics_podcasts table in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class AnalyticsPodcastsModel extends Model
{
    protected $table = 'analytics_podcasts';

    protected $allowedFields = [];

    protected $returnType = \App\Entities\AnalyticsPodcasts::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;

    /**
     * Gets all data for a podcast
     *
     * @param int $podcastId
     *
     * @return array
     */
    public function getDataByDay(int $podcastId): array
    {
        if (!($found = cache("{$podcastId}_analytics_podcast_by_day"))) {
            $found = $this->select('`date` as `labels`')
                ->selectSum('`hits`', '`values`')
                ->where([
                    '`podcast_id`' => $podcastId,
                    '`date` >' => date('Y-m-d', strtotime('-1 year')),
                ])
                ->groupBy('`labels`')
                ->orderBy('`labels``', 'ASC')
                ->findAll();

            cache()->save(
                "{$podcastId}_analytics_podcast_by_day",
                $found,
                14400
            );
        }

        return $found;
    }
}
