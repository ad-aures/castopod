<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Entities\Podcast;
use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use Modules\PremiumPodcasts\Entities\Subscription;
use Modules\PremiumPodcasts\Models\SubscriptionModel;
use Opawg\UserAgentsV2Php\UserAgentsRSS;

class FeedController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var IncomingRequest
     */
    protected $request;

    public function index(string $podcastHandle): ResponseInterface
    {
        helper(['rss', 'premium_podcasts', 'misc']);

        $podcast = (new PodcastModel())->where('handle', $podcastHandle)
            ->first();
        if (! $podcast instanceof Podcast) {
            throw PageNotFoundException::forPageNotFound();
        }

        $service = null;
        try {
            $service = UserAgentsRSS::find(service('superglobals')->server('HTTP_USER_AGENT'));
        } catch (Exception $exception) {
            // If things go wrong the show must go on and the user must be able to download the file
            log_message('critical', $exception->getMessage());
        }

        $serviceSlug = '';
        if ($service) {
            $serviceSlug = $service['slug'];
        }

        $subscription = null;
        $token = $this->request->getGet('token');
        if ($token) {
            $subscription = (new SubscriptionModel())->validateSubscription($podcastHandle, $token);
        }

        $cacheName = implode(
            '_',
            array_filter([
                "podcast#{$podcast->id}",
                'feed',
                $service ? $serviceSlug : null,
                $subscription instanceof Subscription ? 'unlocked' : null,
            ]),
        );

        if (! ($found = cache($cacheName))) {
            $found = get_rss_feed($podcast, $serviceSlug, $subscription, $token);

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
