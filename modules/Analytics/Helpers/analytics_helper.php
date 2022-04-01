<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use AdAures\Ipcat\IpDb;
use Config\Services;
use GeoIp2\Database\Reader;
use Opawg\UserAgentsPhp\UserAgents;
use WhichBrowser\Parser;

if (! function_exists('base64_url_encode')) {
    /**
     * Encode Base64 for URLs
     */
    function base64_url_encode(string $input): string
    {
        return strtr(base64_encode($input), '+/=', '._-');
    }
}

if (! function_exists('base64_url_decode')) {
    /**
     * Decode Base64 from URL
     */
    function base64_url_decode(string $input): string
    {
        return base64_decode(strtr($input, '._-', '+/='), true);
    }
}

if (! function_exists('generate_episode_analytics_url')) {
    /**
     * Builds the episode analytics url that redirects to the audio file url after analytics hit.
     */
    function generate_episode_analytics_url(
        int $podcastId,
        int $episodeId,
        string $audioPath,
        float $audioDuration,
        int $audioFileSize,
        int $audioFileHeaderSize,
        \CodeIgniter\I18n\Time $publicationDate
    ): string {
        return url_to(
            'episode-analytics-hit',
            base64_url_encode(
                pack(
                    'I*',
                    $podcastId,
                    $episodeId,
                    // bytes_threshold: number of bytes that must be downloaded for an episode to be counted in download analytics
                    // - if audio is less than or equal to 60s, then take the audio file_size
                    // - if audio is more than 60s, then take the audio file_header_size + 60s
                    $audioDuration <= 60
                        ? $audioFileSize
                        : $audioFileHeaderSize +
                            floor((($audioFileSize - $audioFileHeaderSize) / $audioDuration) * 60),
                    $audioFileSize,
                    $audioDuration,
                    $publicationDate->getTimestamp(),
                ),
            ),
            $audioPath,
        );
    }
}

if (! function_exists('set_user_session_deny_list_ip')) {
    /**
     * Set user country in session variable, for analytic purposes
     */
    function set_user_session_deny_list_ip(): void
    {
        $session = Services::session();
        $session->start();

        if (! $session->has('denyListIp')) {
            $session->set('denyListIp', IpDb::find($_SERVER['REMOTE_ADDR']) !== null);
        }
    }
}

if (! function_exists('set_user_session_location')) {
    /**
     * Set user country in session variable, for analytic purposes
     */
    function set_user_session_location(): void
    {
        $session = Services::session();
        $session->start();

        $location = [
            'countryCode' => 'N/A',
            'regionCode' => 'N/A',
            'latitude' => null,
            'longitude' => null,
        ];

        // Finds location:
        if (! $session->has('location')) {
            try {
                $cityReader = new Reader(WRITEPATH . 'uploads/GeoLite2-City/GeoLite2-City.mmdb');
                $city = $cityReader->city($_SERVER['REMOTE_ADDR']);

                $location = [
                    'countryCode' => $city->country->isoCode === null
                        ? 'N/A'
                        : $city->country->isoCode,
                    'regionCode' => $city->subdivisions[0]->isoCode === null
                        ? 'N/A'
                        : $city->subdivisions[0]->isoCode,
                    'latitude' => round($city->location->latitude, 3),
                    'longitude' => round($city->location->longitude, 3),
                ];
                // If things go wrong the show must go on and the user must be able to download the file
            } catch (Exception) {
            }

            $session->set('location', $location);
        }
    }
}

if (! function_exists('set_user_session_player')) {
    /**
     * Set user player in session variable, for analytic purposes
     */
    function set_user_session_player(): void
    {
        $session = Services::session();
        $session->start();

        if (! $session->has('player')) {
            $playerFound = null;
            $userAgent = $_SERVER['HTTP_USER_AGENT'];

            try {
                $playerFound = UserAgents::find($userAgent);
                // If things go wrong the show must go on and the user must be able to download the file
            } catch (Exception) {
            }

            if ($playerFound) {
                $session->set('player', $playerFound);
            } else {
                $session->set('player', [
                    'app' => '- unknown -',
                    'device' => '',
                    'os' => '',
                    'bot' => 0,
                ]);
                // Add to unknown list
                try {
                    $db = db_connect();
                    $procedureNameAnalyticsUnknownUseragents = $db->prefixTable('analytics_unknown_useragents');
                    $db->query("CALL {$procedureNameAnalyticsUnknownUseragents}(?)", [$userAgent]);
                    // If things go wrong the show must go on and the user must be able to download the file
                } catch (Exception) {
                }
            }
        }
    }
}

if (! function_exists('set_user_session_browser')) {
    /**
     * Set user browser in session variable, for analytic purposes
     *
     * FIXME: session key should be null instead of "Could not get browser name"
     */
    function set_user_session_browser(): void
    {
        $session = Services::session();
        $session->start();

        if (! $session->has('browser')) {
            $browserName = '- Other -';
            try {
                $whichbrowser = new Parser(getallheaders());
                $browserName = $whichbrowser->browser->name;
            } catch (Exception) {
                $browserName = '- Could not get browser name -';
            }

            if ($browserName === '') {
                $browserName = '- Could not get browser name -';
            }

            $session->set('browser', $browserName);
        }
    }
}

if (! function_exists('set_user_session_referer')) {
    /**
     * Set user referer in session variable, for analytic purposes
     */
    function set_user_session_referer(): void
    {
        $session = Services::session();
        $session->start();

        $newreferer = isset($_SERVER['HTTP_REFERER'])
            ? $_SERVER['HTTP_REFERER']
            : '- Direct -';
        $newreferer =
            parse_url($newreferer, PHP_URL_HOST) ===
            parse_url(current_url(false), PHP_URL_HOST)
                ? '- Direct -'
                : $newreferer;
        if (! $session->has('referer') || $newreferer !== '- Direct -') {
            $session->set('referer', $newreferer);
        }
    }
}

if (! function_exists('set_user_session_entry_page')) {
    /**
     * Set user entry page in session variable, for analytic purposes
     */
    function set_user_session_entry_page(): void
    {
        $session = Services::session();
        $session->start();

        $entryPage = $_SERVER['REQUEST_URI'];
        if (! $session->has('entryPage')) {
            $session->set('entryPage', $entryPage);
        }
    }
}

if (! function_exists('podcast_hit')) {
    /**
     * Counting podcast episode downloads for analytic purposes ✅ No IP address is ever stored on the server. ✅ Only
     * aggregate data is stored in the database. We follow IAB Podcast Measurement Technical Guidelines Version 2.0:
     * https://iabtechlab.com/standards/podcast-measurement-guidelines/
     * https://iabtechlab.com/wp-content/uploads/2017/12/Podcast_Measurement_v2-Dec-20-2017.pdf ✅ 24-hour window ✅
     * Castopod does not do pre-load ✅ IP deny list https://github.com/client9/ipcat ✅ User-agent Filtering
     * https://github.com/opawg/user-agents ✅ RSS User-agent https://github.com/opawg/podcast-rss-useragents ✅
     * Ignores 2 bytes range "Range: 0-1"  (performed by official Apple iOS Podcast app) ✅ In case of partial content,
     * adds up all requests to check >1mn was downloaded ✅ Identifying Uniques is done with a combination of IP
     * Address and User Agent
     *
     * @param integer $podcastId The podcast ID
     * @param integer $episodeId The Episode ID
     * @param integer $bytesThreshold The minimum total number of bytes that must be downloaded so that an episode is counted (>1mn)
     * @param integer $fileSize The podcast complete file size
     * @param double $duration The episode duration in seconds
     * @param int $publicationTime The episode's publication time as a UNIX timestamp
     * @param string $serviceName The name of the service that had fetched the RSS feed
     */
    function podcast_hit(
        int $podcastId,
        int $episodeId,
        int $bytesThreshold,
        int $fileSize,
        float $duration,
        int $publicationTime,
        string $serviceName
    ): void {
        $session = Services::session();
        $session->start();

        // We try to count (but if things went wrong the show should go on and the user should be able to download the file):
        try {
            // If the user IP is denied it's probably a bot:
            if ($session->get('denyListIp')) {
                $session->get('player')['bot'] = true;
            }

            //We get the HTTP header field `Range`:
            $httpRange = isset($_SERVER['HTTP_RANGE'])
                ? $_SERVER['HTTP_RANGE']
                : null;

            $salt = config('Analytics')
                ->salt;
            // We create a sha1 hash for this Salt+Current_Date+IP_Address+User_Agent+Episode_ID (used to count only once multiple episode downloads):
            $episodeListenerHashId =
                'Analytics_Episode_' .
                sha1(
                    $salt . '_' . date(
                        'Y-m-d'
                    ) . '_' . $_SERVER['REMOTE_ADDR'] . '_' . $_SERVER['HTTP_USER_AGENT'] . '_' . $episodeId
                );
            // The cache expires at midnight:
            $secondsToMidnight = strtotime('tomorrow') - time();
            $downloadedBytes = cache($episodeListenerHashId);
            if ($downloadedBytes === null) {
                // If it was never downloaded that means that zero bytes were downloaded:
                $downloadedBytes = 0;
            }

            // If the number of downloaded bytes was previously below the 1mn threshold we go on:
            // (Otherwise it means that this was already counted, therefore we don't do anything)
            if ($downloadedBytes < $bytesThreshold) {
                // If HTTP_RANGE is null we are downloading the complete file:
                if (! $httpRange) {
                    $downloadedBytes = $fileSize;
                } elseif ($httpRange !== 'bytes=0-1') {
                    // [0-1] bytes range requests are used (by Apple) to check that file exists and that 206 partial content is working.
                    // We don't count these requests.
                    // We calculate how many bytes are being downloaded based on HTTP_RANGE values:
                    $ranges = explode(',', substr($httpRange, 6));
                    foreach ($ranges as $range) {
                        $parts = explode('-', $range);
                        $downloadedBytes += array_key_exists(1, $parts)
                            ? $fileSize
                            : (int) $parts[1] -
                                (array_key_exists(0, $parts) ? 0 : (int) $parts[0]);
                    }
                }

                // We save the number of downloaded bytes for this user and this episode:
                cache()
                    ->save($episodeListenerHashId, $downloadedBytes, $secondsToMidnight);

                // If more that 1mn was downloaded, that's a hit, we send that to the database:
                if ($downloadedBytes >= $bytesThreshold) {
                    $db = db_connect();
                    $procedureName = $db->prefixTable('analytics_podcasts');

                    $age = intdiv(time() - $publicationTime, 86400);

                    // We create a sha1 hash for this Salt+Current_Date+IP_Address+User_Agent+Podcast_ID (used to count unique listeners):
                    $podcastListenerHashId =
                        'Analytics_Podcast_' .
                        sha1(
                            $salt . '_' . date(
                                'Y-m-d'
                            ) . '_' . $_SERVER['REMOTE_ADDR'] . '_' . $_SERVER['HTTP_USER_AGENT'] . '_' . $podcastId
                        );
                    $newListener = 1;
                    // Has this listener already downloaded an episode today:
                    $downloadsByUser = cache($podcastListenerHashId);
                    // We add one download
                    if ($downloadsByUser) {
                        $newListener = 0;
                        ++$downloadsByUser;
                    } else {
                        $downloadsByUser = 1;
                    }

                    // We save the download count for this user until midnight:
                    cache()
                        ->save($podcastListenerHashId, $downloadsByUser, $secondsToMidnight);

                    $db->query(
                        "CALL {$procedureName}(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);",
                        [
                            $podcastId,
                            $episodeId,
                            $session->get('location')['countryCode'],
                            $session->get('location')['regionCode'],
                            $session->get('location')['latitude'],
                            $session->get('location')['longitude'],
                            $serviceName,
                            $session->get('player')['app'],
                            $session->get('player')['device'],
                            $session->get('player')['os'],
                            $session->get('player')['bot'],
                            $fileSize,
                            $duration,
                            $age,
                            $newListener,
                        ],
                    );
                }
            }
        } catch (Exception $exception) {
            // If things go wrong the show must go on and the user must be able to download the file
            log_message('critical', $exception->getMessage());
        }
    }
}
