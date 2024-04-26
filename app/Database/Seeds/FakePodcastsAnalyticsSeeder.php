<?php

declare(strict_types=1);

/**
 * Class FakePodcastsAnalyticsSeeder Inserts Fake Analytics in the database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Seeds;

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use CodeIgniter\Database\Seeder;
use Exception;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;

class FakePodcastsAnalyticsSeeder extends Seeder
{
    public function run(): void
    {
        $jsonUserAgents = json_decode(
            file_get_contents('https://raw.githubusercontent.com/opawg/user-agents/master/src/user-agents.json'),
            true,
            512,
            JSON_THROW_ON_ERROR,
        );

        $jsonRSSUserAgents = json_decode(
            file_get_contents(
                'https://raw.githubusercontent.com/opawg/podcast-rss-useragents/master/src/rss-ua.json',
            ),
            true,
            512,
            JSON_THROW_ON_ERROR,
        );

        $podcast = (new PodcastModel())->first();

        if (! $podcast instanceof Podcast) {
            throw new Exception("COULD NOT POPULATE DATABASE:\n\tCreate a podcast with episodes first.\n");
        }

        $firstEpisode = (new EpisodeModel())
            ->selectMin('published_at')
            ->first();

        if (! $firstEpisode instanceof Episode) {
            throw new Exception("COULD NOT POPULATE DATABASE:\n\tCreate an episode first.");
        }

        for (
            $date = strtotime((string) $firstEpisode->published_at);
            $date < strtotime('now');
            $date = strtotime(date('Y-m-d', $date) . ' +1 day')
        ) {
            $analyticsPodcasts = [];
            $analyticsPodcastsByHour = [];
            $analyticsPodcastsByCountry = [];
            $analyticsPodcastsByEpisode = [];
            $analyticsPodcastsByPlayer = [];
            $analyticsPodcastsByRegion = [];

            $episodes = (new EpisodeModel())
                ->where('podcast_id', $podcast->id)
                ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
                ->findAll();
            foreach ($episodes as $episode) {
                $age = floor(($date - strtotime((string) $episode->published_at)) / 86400);
                $probability1 = floor(exp(3 - $age / 40)) + 1;

                for (
                    $lineNumber = 0;
                    $lineNumber < random_int(1, (int) $probability1);
                    ++$lineNumber
                ) {
                    $probability2 = floor(exp(6 - $age / 20)) + 10;

                    $player =
                        $jsonUserAgents[
                            random_int(1, count($jsonUserAgents) - 1)
                        ];
                    $service =
                        $jsonRSSUserAgents[
                            random_int(1, count($jsonRSSUserAgents) - 1)
                        ]['slug'];
                    $app = $player['app'] ?? '';
                    $device = $player['device'] ?? '';
                    $os = $player['os'] ?? '';
                    $isBot = $player['bot'] ?? 0;

                    $fakeIp =
                        random_int(0, 255) .
                        '.' .
                        random_int(0, 255) .
                        '.' .
                        random_int(0, 255) .
                        '.' .
                        random_int(0, 255);

                    $cityReader = new Reader(WRITEPATH . 'uploads/GeoLite2-City/GeoLite2-City.mmdb');

                    $countryCode = 'N/A';
                    $regionCode = 'N/A';
                    $latitude = null;
                    $longitude = null;
                    try {
                        $city = $cityReader->city($fakeIp);

                        $countryCode = $city->country->isoCode ?? 'N/A';

                        $regionCode = $city->subdivisions === []
                            ? 'N/A'
                            : $city->subdivisions[0]->isoCode;
                        $latitude = round((float) $city->location->latitude, 3);
                        $longitude = round((float) $city->location->longitude, 3);
                    } catch (AddressNotFoundException) {
                        //Bad luck, bad IP, nothing to do.
                    }

                    $hits = random_int(0, (int) $probability2);

                    $analyticsPodcasts[] = [
                        'podcast_id'       => $podcast->id,
                        'date'             => date('Y-m-d', $date),
                        'duration'         => random_int(60, 3600),
                        'bandwidth'        => random_int(1000000, 10000000),
                        'hits'             => $hits,
                        'unique_listeners' => $hits,
                    ];
                    $analyticsPodcastsByHour[] = [
                        'podcast_id' => $podcast->id,
                        'date'       => date('Y-m-d', $date),
                        'hour'       => random_int(0, 23),
                        'hits'       => $hits,
                    ];
                    $analyticsPodcastsByCountry[] = [
                        'podcast_id'   => $podcast->id,
                        'date'         => date('Y-m-d', $date),
                        'country_code' => $countryCode,
                        'hits'         => $hits,
                    ];
                    $analyticsPodcastsByEpisode[] = [
                        'podcast_id' => $podcast->id,
                        'date'       => date('Y-m-d', $date),
                        'episode_id' => $episode->id,
                        'age'        => $age,
                        'hits'       => $hits,
                    ];
                    $analyticsPodcastsByPlayer[] = [
                        'podcast_id' => $podcast->id,
                        'date'       => date('Y-m-d', $date),
                        'service'    => $service,
                        'app'        => $app,
                        'device'     => $device,
                        'os'         => $os,
                        'is_bot'     => $isBot,
                        'hits'       => $hits,
                    ];
                    $analyticsPodcastsByRegion[] = [
                        'podcast_id'   => $podcast->id,
                        'date'         => date('Y-m-d', $date),
                        'country_code' => $countryCode,
                        'region_code'  => $regionCode,
                        'latitude'     => $latitude,
                        'longitude'    => $longitude,
                        'hits'         => $hits,
                    ];
                }
            }

            $this->db
                ->table('analytics_podcasts')
                ->ignore(true)
                ->insertBatch($analyticsPodcasts);
            $this->db
                ->table('analytics_podcasts_by_hour')
                ->ignore(true)
                ->insertBatch($analyticsPodcastsByHour);
            $this->db
                ->table('analytics_podcasts_by_country')
                ->ignore(true)
                ->insertBatch($analyticsPodcastsByCountry);
            $this->db
                ->table('analytics_podcasts_by_episode')
                ->ignore(true)
                ->insertBatch($analyticsPodcastsByEpisode);
            $this->db
                ->table('analytics_podcasts_by_player')
                ->ignore(true)
                ->insertBatch($analyticsPodcastsByPlayer);
            $this->db
                ->table('analytics_podcasts_by_region')
                ->ignore(true)
                ->insertBatch($analyticsPodcastsByRegion);
        }
    }
}
