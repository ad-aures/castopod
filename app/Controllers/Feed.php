<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Models\PodcastModel;
use CodeIgniter\Controller;

class Feed extends Controller
{
    public function index($podcastName)
    {
        helper('rss');

        $podcast = (new PodcastModel())->where('name', $podcastName)->first();
        if (!$podcast) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $service = null;
        try {
            $service = \Opawg\UserAgentsPhp\UserAgentsRSS::find(
                $_SERVER['HTTP_USER_AGENT']
            );
        } catch (\Exception $e) {
            // If things go wrong the show must go on and the user must be able to download the file
            log_message('critical', $e);
        }
        $cacheName =
            "podcast{$podcast->id}_feed" .
            ($service ? "_{$service['slug']}" : '');
        if (!($found = cache($cacheName))) {
            $found = get_rss_feed(
                $podcast,
                $service ? '?s=' . urlencode($service['name']) : ''
            );
            cache()->save($cacheName, $found, DECADE);
        }
        return $this->response->setXML($found);
    }
}
