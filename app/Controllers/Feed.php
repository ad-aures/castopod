<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Models\EpisodeModel;
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
            $found = get_rss_feed($podcast, $service ? $service['name'] : '');

            // The page cache is set to expire after next episode publication or a decade by default so it is deleted manually upon podcast update
            $secondsToNextUnpublishedEpisode = (new EpisodeModel())->getSecondsToNextUnpublishedEpisode(
                $podcast->id
            );

            cache()->save(
                $cacheName,
                $found,
                $secondsToNextUnpublishedEpisode
                    ? $secondsToNextUnpublishedEpisode
                    : DECADE
            );
        }
        return $this->response->setXML($found);
    }
}
