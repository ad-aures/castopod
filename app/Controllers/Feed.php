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

        $serviceSlug = '';
        try {
            $service = \Opawg\UserAgentsPhp\UserAgentsRSS::find(
                $_SERVER['HTTP_USER_AGENT'],
            );
            if ($service) {
                $serviceSlug = $service['slug'];
            }
        } catch (\Exception $e) {
            // If things go wrong the show must go on and the user must be able to download the file
            log_message('critical', $e);
        }

        $cacheName =
            "podcast#{$podcast->id}_feed" . ($service ? "_{$serviceSlug}" : '');

        if (!($found = cache($cacheName))) {
            $found = get_rss_feed($podcast, $serviceSlug);

            // The page cache is set to expire after next episode publication or a decade by default so it is deleted manually upon podcast update
            $secondsToNextUnpublishedEpisode = (new EpisodeModel())->getSecondsToNextUnpublishedEpisode(
                $podcast->id,
            );

            cache()->save(
                $cacheName,
                $found,
                $secondsToNextUnpublishedEpisode
                    ? $secondsToNextUnpublishedEpisode
                    : DECADE,
            );
        }
        return $this->response->setXML($found);
    }
}
