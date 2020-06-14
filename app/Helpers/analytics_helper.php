
<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

/**
 * Set user country in session variable, for analytics purpose
 */
function set_user_session_country()
{
    $session = \Config\Services::session();
    $session->start();
    $db = \Config\Database::connect();

    $country = 'N/A';

    // Finds country:
    if (!$session->has('country')) {
        try {
            $reader = new \GeoIp2\Database\Reader(
                WRITEPATH . 'uploads/GeoLite2-Country/GeoLite2-Country.mmdb'
            );
            $geoip = $reader->country($_SERVER['REMOTE_ADDR']);
            $country = $geoip->country->isoCode;
        } catch (\Exception $e) {
            // If things go wrong the show must go on and the user must be able to download the file
        }
        $session->set('country', $country);
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
        $session = \Config\Services::session();
        $session->start();

        $playerName = '- Unknown Player -';

        $useragent = $_SERVER['HTTP_USER_AGENT'];

        try {
            $jsonUserAgents = json_decode(
                file_get_contents(
                    WRITEPATH . 'uploads/user-agents/src/user-agents.json'
                ),
                true
            );

            //Search for current HTTP_USER_AGENT in json file:
            foreach ($jsonUserAgents as $player) {
                foreach ($player['user_agents'] as $useragentsRegexp) {
                    //Does the HTTP_USER_AGENT match this regexp:
                    if (preg_match("#{$useragentsRegexp}#", $useragent)) {
                        if (isset($player['bot'])) {
                            //It’s a bot!
                            $playerName = '- Bot -';
                        } else {
                            //It isn’t a bot, we store device/os/app:
                            $playerName =
                                (isset($player['device'])
                                    ? $player['device'] . '/'
                                    : '') .
                                (isset($player['os'])
                                    ? $player['os'] . '/'
                                    : '') .
                                (isset($player['app']) ? $player['app'] : '?');
                        }
                        //We found it!
                        break 2;
                    }
                }
            }
        } catch (\Exception $e) {
            // If things go wrong the show must go on and the user must be able to download the file
        }
        if ($playerName == '- Unknown Player -') {
            // Add to unknown list
            try {
                $db = \Config\Database::connect();
                $procedureNameAUU = $db->prefixTable(
                    'analytics_unknown_useragents'
                );
                $db->query("CALL $procedureNameAUU(?)", [$useragent]);
            } catch (\Exception $e) {
                // If things go wrong the show must go on and the user must be able to download the file
            }
        }
        $session->set('player', $playerName);
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
        ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST)
        : '- Direct -';
    $newreferer =
        $newreferer == parse_url(current_url(false), PHP_URL_HOST)
            ? '- Direct -'
            : $newreferer;
    if (!$session->has('referer') or $newreferer != '- Direct -') {
        $session->set('referer', $newreferer);
    }
}

function webpage_hit($postcast_id)
{
    $session = \Config\Services::session();
    $session->start();
    $db = \Config\Database::connect();

    $procedureName = $db->prefixTable('analytics_website');
    $db->query("call $procedureName(?,?,?,?)", [
        $postcast_id,
        $session->get('country'),
        $session->get('browser'),
        $session->get('referer'),
    ]);
}

function podcast_hit($p_podcast_id, $p_episode_id)
{
    $session = \Config\Services::session();
    $session->start();
    $first_time_for_this_episode = true;

    if ($session->has('episodes')) {
        if (in_array($p_episode_id, $session->get('episodes'))) {
            $first_time_for_this_episode = false;
        } else {
            $session->push('episodes', [$p_episode_id]);
        }
    } else {
        $session->set('episodes', [$p_episode_id]);
    }

    if ($first_time_for_this_episode) {
        $db = \Config\Database::connect();
        $procedureName = $db->prefixTable('analytics_podcasts');
        try {
            $db->query("CALL $procedureName(?,?,?,?);", [
                $p_podcast_id,
                $p_episode_id,
                $session->get('country'),
                $session->get('player'),
            ]);
        } catch (\Exception $e) {
            // If things go wrong the show must go on and the user must be able to download the file
        }
    }
}

