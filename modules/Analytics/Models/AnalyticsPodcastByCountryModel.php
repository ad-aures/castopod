<?php

declare(strict_types=1);

/**
 * Class AnalyticsPodcastByCountryModel Model for analytics_podcasts_by_country table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Models;

use CodeIgniter\Model;
use Modules\Analytics\Entities\AnalyticsPodcastsByCountry;

class AnalyticsPodcastByCountryModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'analytics_podcasts_by_country';

    /**
     * @var class-string<AnalyticsPodcastsByCountry>
     */
    protected $returnType = AnalyticsPodcastsByCountry::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = false;

    /**
     * Gets country data for a podcast
     *
     * @return AnalyticsPodcastsByCountry[]
     */
    public function getDataWeekly(int $podcastId): array
    {
        if (
            ! ($found = cache("{$podcastId}_analytics_podcast_by_country_weekly"))
        ) {
            $oneWeekAgo = date('Y-m-d', strtotime('-1 week'));
            $found = $this->select('country_code as labels')
                ->selectSum('hits', 'values')
                ->where([
                    'podcast_id' => $podcastId,
                    'date >'     => $oneWeekAgo,
                ])
                ->groupBy('labels')
                ->orderBy('values', 'DESC')
                ->findAll();

            cache()
                ->save("{$podcastId}_analytics_podcast_by_country_weekly", $found, 600);
        }

        return $found;
    }

    /**
     * Gets country data for a podcast
     *
     * @return AnalyticsPodcastsByCountry[]
     */
    public function getDataYearly(int $podcastId): array
    {
        if (
            ! ($found = cache("{$podcastId}_analytics_podcast_by_country_yearly"))
        ) {
            $oneYearAgo = date('Y-m-d', strtotime('-1 year'));
            $found = $this->select('country_code as labels')
                ->selectSum('hits', 'values')
                ->where([
                    'podcast_id' => $podcastId,
                    'date >'     => $oneYearAgo,
                ])
                ->groupBy('labels')
                ->orderBy('values', 'DESC')
                ->findAll();

            cache()
                ->save("{$podcastId}_analytics_podcast_by_country_yearly", $found, 600);
        }

        return $found;
    }
}
