<?php namespace App\Controllers;
/**
 * Class Analytics
 * Creates Analytics controller
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use CodeIgniter\Controller;

class Analytics extends Controller
{
    function __construct()
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

        // Finds player:
        if (!$session->has('player')) {
            $playerName = '-unknown-';
            $error = '';

            try {
                $useragent = $_SERVER['HTTP_USER_AGENT'];
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
                                $playerName = '-bot-';
                            } else {
                                //It isn’t a bot, we store device/os/app:
                                $playerName =
                                    (isset($player['device'])
                                        ? $player['device'] . '/'
                                        : '') .
                                    (isset($player['os'])
                                        ? $player['os'] . '/'
                                        : '') .
                                    (isset($player['app'])
                                        ? $player['app']
                                        : '?');
                            }
                            //We found it!
                            break 2;
                        }
                    }
                }
            } catch (\Exception $e) {
                // If things go wrong the show must go on and the user must be able to download the file
            }
            if ($playerName == '-unknown-') {
                // Add to unknown list
                try {
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

    // Add one hit to this episode:
    public function hit($p_podcast_id, $p_episode_id, ...$filename)
    {
        $session = \Config\Services::session();
        $db = \Config\Database::connect();
        $procedureName = $db->prefixTable('analytics_podcasts');
        $p_country_code = $session->get('country');
        $p_player = $session->get('player');
        try {
            $db->query("CALL $procedureName(?,?,?,?);", [
                $p_podcast_id,
                $p_episode_id,
                $p_country_code,
                $p_player,
            ]);
        } catch (\Exception $e) {
            // If things go wrong the show must go on and the user must be able to download the file
        }
        return redirect()->to(media_url(implode('/', $filename)));
    }
}
