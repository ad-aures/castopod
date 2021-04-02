<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

/**
 * Encode Base64 for URLs
 */
function base64_url_encode($input)
{
    return strtr(base64_encode($input), '+/=', '._-');
}

/**
 * Decode Base64 from URL
 */
function base64_url_decode($input)
{
    return base64_decode(strtr($input, '._-', '+/='));
}

/**
 * Set user country in session variable, for analytics purpose
 */
function set_user_session_deny_list_ip()
{
    $session = \Config\Services::session();
    $session->start();

    if (!$session->has('denyListIp')) {
        $session->set(
            'denyListIp',
            \Podlibre\Ipcat\IpDb::find($_SERVER['REMOTE_ADDR']) != null,
        );
    }
}

/**
 * Set user country in session variable, for analytics purpose
 */
function set_user_session_location()
{
    $session = \Config\Services::session();
    $session->start();

    $location = [
        'countryCode' => 'N/A',
        'regionCode' => 'N/A',
        'latitude' => null,
        'longitude' => null,
    ];

    // Finds location:
    if (!$session->has('location')) {
        try {
            $cityReader = new \GeoIp2\Database\Reader(
                WRITEPATH . 'uploads/GeoLite2-City/GeoLite2-City.mmdb',
            );
            $city = $cityReader->city($_SERVER['REMOTE_ADDR']);

            $location = [
                'countryCode' => empty($city->country->isoCode)
                    ? 'N/A'
                    : $city->country->isoCode,
                'regionCode' => empty($city->subdivisions[0]->isoCode)
                    ? 'N/A'
                    : $city->subdivisions[0]->isoCode,
                'latitude' => round($city->location->latitude, 3),
                'longitude' => round($city->location->longitude, 3),
            ];
        } catch (\Exception $e) {
            // If things go wrong the show must go on and the user must be able to download the file
        }
        $session->set('location', $location);
    }
}

/**
 * Set user player in session variable, for analytics purpose
 */
function set_user_session_player()
{
    $session = \Config\Services::session();
    $session->start();

    if (!$session->has('player')) {
        $playerFound = null;
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        try {
            $playerFound = \Opawg\UserAgentsPhp\UserAgents::find($userAgent);
        } catch (\Exception $e) {
            // If things go wrong the show must go on and the user must be able to download the file
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
                $db = \Config\Database::connect();
                $procedureNameAnalyticsUnknownUseragents = $db->prefixTable(
                    'analytics_unknown_useragents',
                );
                $db->query("CALL $procedureNameAnalyticsUnknownUseragents(?)", [
                    $userAgent,
                ]);
            } catch (\Exception $e) {
                // If things go wrong the show must go on and the user must be able to download the file
            }
        }
    }
}

/**
 * Set user browser in session variable, for analytics purpose
 */
function set_user_session_browser()
{
    $session = \Config\Services::session();
    $session->start();

    if (!$session->has('browser')) {
        $browserName = '- Other -';
        try {
            $whichbrowser = new \WhichBrowser\Parser(getallheaders());
            $browserName = $whichbrowser->browser->name;
        } catch (\Exception $e) {
            $browserName = '- Could not get browser name -';
        }
        if ($browserName == null) {
            $browserName = '- Could not get browser name -';
        }
        $session->set('browser', $browserName);
    }
}

/**
 * Set user referer in session variable, for analytics purpose
 */
function set_user_session_referer()
{
    $session = \Config\Services::session();
    $session->start();

    $newreferer = isset($_SERVER['HTTP_REFERER'])
        ? $_SERVER['HTTP_REFERER']
        : '- Direct -';
    $newreferer =
        parse_url($newreferer, PHP_URL_HOST) ==
        parse_url(current_url(false), PHP_URL_HOST)
            ? '- Direct -'
            : $newreferer;
    if (!$session->has('referer') or $newreferer != '- Direct -') {
        $session->set('referer', $newreferer);
    }
}

/**
 * Set user entry page in session variable, for analytics purpose
 */
function set_user_session_entry_page()
{
    $session = \Config\Services::session();
    $session->start();

    $entryPage = $_SERVER['REQUEST_URI'];
    if (!$session->has('entryPage')) {
        $session->set('entryPage', $entryPage);
    }
}

function webpage_hit($podcast_id)
{
    $session = \Config\Services::session();
    $session->start();

    if (!$session->get('denyListIp')) {
        $db = \Config\Database::connect();

        $referer = $session->get('referer');
        $domain = empty(parse_url($referer, PHP_URL_HOST))
            ? '- Direct -'
            : parse_url($referer, PHP_URL_HOST);
        parse_str(parse_url($referer, PHP_URL_QUERY), $queries);
        $keywords = empty($queries['q']) ? null : $queries['q'];

        $procedureName = $db->prefixTable('analytics_website');
        $db->query("call $procedureName(?,?,?,?,?,?)", [
            $podcast_id,
            $session->get('browser'),
            $session->get('entryPage'),
            $referer,
            $domain,
            $keywords,
        ]);
    }
}

/**
 * Counting podcast episode downloads for analytics purposes
 * ✅ No IP address is ever stored on the server.
 * ✅ Only aggregate data is stored in the database.
 * We follow IAB Podcast Measurement Technical Guidelines Version 2.0:
 *   https://iabtechlab.com/standards/podcast-measurement-guidelines/
 *   https://iabtechlab.com/wp-content/uploads/2017/12/Podcast_Measurement_v2-Dec-20-2017.pdf
 *   ✅ Rolling 24-hour window
 *   ✅ Castopod does not do pre-load
 *   ✅ IP deny list https://github.com/client9/ipcat
 *   ✅ User-agent Filtering https://github.com/opawg/user-agents
 *   ✅ RSS User-agent https://github.com/opawg/podcast-rss-useragents
 *   ✅ Ignores 2 bytes range "Range: 0-1"  (performed by official Apple iOS Podcast app)
 *   ✅ In case of partial content, adds up all requests to check >1mn was downloaded
 *   ✅ Identifying Uniques is done with a combination of IP Address and User Agent
 * @param int $podcastId The podcast ID
 * @param int $episodeId The Episode ID
 * @param int $bytesThreshold The minimum total number of bytes that must be downloaded so that an episode is counted (>1mn)
 * @param int $fileSize The podcast complete file size
 * @param string $serviceName The name of the service that had fetched the RSS feed
 *
 * @return void
 */
function podcast_hit(
    $podcastId,
    $episodeId,
    $bytesThreshold,
    $fileSize,
    $duration,
    $publicationDate,
    $serviceName
) {
    $session = \Config\Services::session();
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

        // We create a sha1 hash for this IP_Address+User_Agent+Episode_ID (used to count only once multiple episode downloads):
        $episodeHashId =
            '_IpUaEp_' .
            sha1(
                $_SERVER['REMOTE_ADDR'] .
                    '_' .
                    $_SERVER['HTTP_USER_AGENT'] .
                    '_' .
                    $episodeId,
            );
        // Was this episode downloaded in the past 24h:
        $downloadedBytes = cache($episodeHashId);
        // Rolling window is 24 hours (86400 seconds):
        $rollingTTL = 86400;
        if ($downloadedBytes) {
            // In case it was already downloaded, TTL should be adjusted (rolling window is 24h since 1st download):
            $rollingTTL =
                cache()->getMetadata($episodeHashId)['expire'] - time();
        } else {
            // If it was never downloaded that means that zero byte were downloaded:
            $downloadedBytes = 0;
        }
        // If the number of downloaded bytes was previously below the 1mn threshold we go on:
        // (Otherwise it means that this was already counted, therefore we don't do anything)
        if ($downloadedBytes < $bytesThreshold) {
            // If HTTP_RANGE is null we are downloading the complete file:
            if (!$httpRange) {
                $downloadedBytes = $fileSize;
            } else {
                // [0-1] bytes range requests are used (by Apple) to check that file exists and that 206 partial content is working.
                // We don't count these requests:
                if ($httpRange != 'bytes=0-1') {
                    // We calculate how many bytes are being downloaded based on HTTP_RANGE values:
                    $ranges = explode(',', substr($httpRange, 6));
                    foreach ($ranges as $range) {
                        $parts = explode('-', $range);
                        $downloadedBytes += empty($parts[1])
                            ? $fileSize
                            : $parts[1] - (empty($parts[0]) ? 0 : $parts[0]);
                    }
                }
            }
            // We save the number of downloaded bytes for this user and this episode:
            cache()->save($episodeHashId, $downloadedBytes, $rollingTTL);

            // If more that 1mn was downloaded, that's a hit, we send that to the database:
            if ($downloadedBytes >= $bytesThreshold) {
                $db = \Config\Database::connect();
                $procedureName = $db->prefixTable('analytics_podcasts');

                $age = intdiv(time() - $publicationDate, 86400);

                // We create a sha1 hash for this IP_Address+User_Agent+Podcast_ID (used to count unique listeners):
                $listenerHashId =
                    '_IpUaPo_' .
                    sha1(
                        $_SERVER['REMOTE_ADDR'] .
                            '_' .
                            $_SERVER['HTTP_USER_AGENT'] .
                            '_' .
                            $podcastId,
                    );
                $newListener = 1;
                // Has this listener already downloaded an episode today:
                $downloadsByUser = cache($listenerHashId);
                // We add one download
                if ($downloadsByUser) {
                    $newListener = 0;
                    $downloadsByUser++;
                } else {
                    $downloadsByUser = 1;
                }
                // Listener count is calculated from 00h00 to 23h59:
                $midnightTTL = strtotime('tomorrow') - time();
                // We save the download count for this user until midnight:
                cache()->save($listenerHashId, $downloadsByUser, $midnightTTL);

                $db->query(
                    "CALL $procedureName(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);",
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
    } catch (\Exception $e) {
        // If things go wrong the show must go on and the user must be able to download the file
        log_message('critical', $e);
    }
}
