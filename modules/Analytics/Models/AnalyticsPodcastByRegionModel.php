<?php

declare(strict_types=1);

/**
 * Class AnalyticsPodcastByRegionModel Model for analytics_podcasts_by_region table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Models;

use CodeIgniter\Model;
use Modules\Analytics\Entities\AnalyticsPodcastsByRegion;

class AnalyticsPodcastByRegionModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'analytics_podcasts_by_region';

    /**
     * @var class-string<AnalyticsPodcastsByRegion>
     */
    protected $returnType = AnalyticsPodcastsByRegion::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = false;

    /**
     * Gets region data for a podcast
     *
     * @return AnalyticsPodcastsByRegion[]
     */
    public function getData(int $podcastId): array
    {
        $locale = service('request')
            ->getLocale();
        if (
            ! ($found = cache("{$podcastId}_analytics_podcast_by_region_{$locale}"))
        ) {
            $found = $this->select('country_code, region_code')
                ->selectSum('hits', 'value')
                ->selectAvg('latitude')
                ->selectAvg('longitude')
                ->groupBy('country_code, region_code')
                ->where([
                    'podcast_id' => $podcastId,
                    'date >'     => date('Y-m-d', strtotime('-1 week')),
                ])
                ->orderBy('value', 'DESC')
                ->findAll();

            cache()
                ->save("{$podcastId}_analytics_podcast_by_region_{$locale}", $found, 600);
        }

        return $found;
    }
}
