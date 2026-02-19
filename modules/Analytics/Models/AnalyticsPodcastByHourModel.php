<?php

declare(strict_types=1);

/**
 * Class AnalyticsPodcastByHour Model for analytics_podcasts_by_hour table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Models;

use CodeIgniter\Model;
use Modules\Analytics\Entities\AnalyticsPodcastsByHour;

class AnalyticsPodcastByHourModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'analytics_podcasts_by_hour';

    /**
     * @var class-string<AnalyticsPodcastsByHour>
     */
    protected $returnType = AnalyticsPodcastsByHour::class;

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
     * @return AnalyticsPodcastsByHour[]
     */
    public function getData(int $podcastId): array
    {
        if (! ($found = cache("{$podcastId}_analytics_podcasts_by_hour"))) {
            $found = $this->select("right(concat('0',hour,'h'),3) as labels")
                ->selectSum('hits', 'values')
                ->where([
                    'podcast_id' => $podcastId,
                    'date >'     => date('Y-m-d', strtotime('-60 days')),
                ])
                ->groupBy('labels')
                ->orderBy('labels', 'ASC')
                ->findAll();

            cache()
                ->save("{$podcastId}_analytics_podcasts_by_hour", $found, 600);
        }

        return $found;
    }
}
