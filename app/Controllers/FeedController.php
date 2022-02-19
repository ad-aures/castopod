<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use Opawg\UserAgentsPhp\UserAgentsRSS;

class FeedController extends Controller
{
    public function index(string $podcastHandle): ResponseInterface
    {
        helper('rss');

        $podcast = (new PodcastModel())->where('handle', $podcastHandle)
            ->first();
        if (! $podcast) {
            throw PageNotFoundException::forPageNotFound();
        }

        $service = null;
        try {
            $service = UserAgentsRSS::find($_SERVER['HTTP_USER_AGENT']);
        } catch (Exception $exception) {
            // If things go wrong the show must go on and the user must be able to download the file
            log_message('critical', $exception->getMessage());
        }

        $serviceSlug = '';
        if ($service) {
            $serviceSlug = $service['slug'];
        }

        $cacheName =
            "podcast#{$podcast->id}_feed" . ($service ? "_{$serviceSlug}" : '');

        if (! ($found = cache($cacheName))) {
            $found = get_rss_feed($podcast, $serviceSlug);

            // The page cache is set to expire after next episode publication or a decade by default so it is deleted manually upon podcast update
            $secondsToNextUnpublishedEpisode = (new EpisodeModel())->getSecondsToNextUnpublishedEpisode(
                $podcast->id,
            );

            cache()
                ->save(
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
