<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Controllers;

use App\Entities\Episode;
use App\Models\EpisodeModel;
use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Modules\Analytics\Config\Analytics;
use Modules\PremiumPodcasts\Models\SubscriptionModel;
use Psr\Log\LoggerInterface;

class EpisodeAnalyticsController extends Controller
{
    /**
     * An array of helpers to be loaded automatically upon class instantiation. These helpers will be available to all
     * other controllers that extend Analytics.
     *
     * @var string[]
     */
    protected $helpers = ['analytics'];

    protected Analytics $config;

    /**
     * Constructor.
     */
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ): void {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        set_user_session_deny_list_ip();
        set_user_session_location();
        set_user_session_player();

        $this->config = config('Analytics');
    }

    public function hit(string $base64EpisodeData, string ...$audioPath): RedirectResponse|ResponseInterface
    {
        $session = Services::session();
        $session->start();

        $serviceName = '';
        if ($this->request->getGet('_from')) {
            $serviceName = $this->request->getGet('_from');
        } elseif ($session->get('embed_domain') !== null) {
            $serviceName = $session->get('embed_domain');
        } elseif ($session->get('referer') !== null && $session->get('referer') !== '- Direct -') {
            $serviceName = parse_url($session->get('referer'), PHP_URL_HOST);
        }

        $episodeData = unpack(
            'IpodcastId/IepisodeId/IbytesThreshold/IfileSize/Iduration/IpublicationDate',
            base64_url_decode($base64EpisodeData),
        );

        if (! $episodeData) {
            throw PageNotFoundException::forPageNotFound();
        }

        // check if episode is premium?
        $episode = (new EpisodeModel())->getEpisodeById($episodeData['episodeId']);

        if (! $episode instanceof Episode) {
            return $this->response->setStatusCode(404);
        }

        $subscription = null;

        // check if podcast is already unlocked before any token validation
        if ($episode->is_premium && ($subscription = service('premium_podcasts')->subscription(
            $episode->podcast->handle
        )) === null) {
            // look for token as GET parameter
            if (($token = $this->request->getGet('token')) === null) {
                return $this->response->setStatusCode(
                    401,
                    'Episode is premium, you must provide a token to unlock it.'
                );
            }

            // check if there's a valid subscription for the provided token
            if (($subscription = (new SubscriptionModel())->validateSubscription(
                $episode->podcast->handle,
                $token
            )) === null) {
                return $this->response->setStatusCode(401, 'Invalid token!');
            }
        }

        podcast_hit(
            $episodeData['podcastId'],
            $episodeData['episodeId'],
            $episodeData['bytesThreshold'],
            $episodeData['fileSize'],
            $episodeData['duration'],
            $episodeData['publicationDate'],
            $serviceName,
            $subscription !== null ? $subscription->id : null
        );

        return redirect()->to($this->config->getAudioUrl($episode->audio->file_path));
    }
}
