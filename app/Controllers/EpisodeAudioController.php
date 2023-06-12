<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Modules\Analytics\Config\Analytics;
use Modules\PremiumPodcasts\Entities\Subscription;
use Modules\PremiumPodcasts\Models\SubscriptionModel;
use Psr\Log\LoggerInterface;

class EpisodeAudioController extends Controller
{
    /**
     * An array of helpers to be loaded automatically upon class instantiation. These helpers will be available to all
     * other controllers that extend Analytics.
     *
     * @var string[]
     */
    protected $helpers = ['analytics'];

    protected Podcast $podcast;

    protected Episode $episode;

    protected Analytics $analyticsConfig;

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

        $this->analyticsConfig = config('Analytics');
    }

    public function _remap(string $method, string ...$params): mixed
    {
        if (count($params) < 2) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (
            ! ($podcast = (new PodcastModel())->getPodcastByHandle($params[0])) instanceof Podcast
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->podcast = $podcast;

        if (
            ! ($episode = (new EpisodeModel())->getEpisodeBySlug($params[0], $params[1])) instanceof Episode
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->episode = $episode;

        unset($params[1]);
        unset($params[0]);

        return $this->{$method}(...$params);
    }

    public function index(): RedirectResponse | ResponseInterface
    {
        // check if episode is premium?
        $subscription = null;

        // check if podcast is already unlocked before any token validation
        if ($this->episode->is_premium && ($subscription = service('premium_podcasts')->subscription(
            $this->episode->podcast->handle
        )) === null) {
            // look for token as GET parameter
            if (($token = $this->request->getGet('token')) === null) {
                return $this->response->setStatusCode(401)
                    ->setJSON([
                        'errors' => [
                            'status' => 401,
                            'title'  => 'Unauthorized',
                            'detail' => 'Episode is premium, you must provide a token to unlock it.',
                        ],
                    ]);
            }

            // check if there's a valid subscription for the provided token
            if (! ($subscription = (new SubscriptionModel())->validateSubscription(
                $this->episode->podcast->handle,
                $token
            )) instanceof Subscription) {
                return $this->response->setStatusCode(401, 'Invalid token!')
                    ->setJSON([
                        'errors' => [
                            'status' => 401,
                            'title'  => 'Unauthorized',
                            'detail' => 'Invalid token!',
                        ],
                    ]);
            }
        }

        $session = Services::session();
        $session->start();

        $serviceName = '';
        if ($this->request->getGet('_from')) {
            $serviceName = $this->request->getGet('_from');
        } elseif ($session->get('embed_domain') !== null) {
            $serviceName = $session->get('embed_domain');
        } elseif ($session->get('referer') !== null && $session->get('referer') !== '- Direct -') {
            $serviceName = parse_url((string) $session->get('referer'), PHP_URL_HOST);
        }

        $audioFileSize = $this->episode->audio->file_size;
        $audioFileHeaderSize = $this->episode->audio->header_size;
        $audioDuration = $this->episode->audio->duration;

        // bytes_threshold: number of bytes that must be downloaded for an episode to be counted in download analytics
        // - if audio is less than or equal to 60s, then take the audio file_size
        // - if audio is more than 60s, then take the audio file_header_size + 60s
        $bytesThreshold = $audioDuration <= 60
        ? $audioFileSize
        : $audioFileHeaderSize +
        (int) floor((($audioFileSize - $audioFileHeaderSize) / $audioDuration) * 60);

        podcast_hit(
            $this->episode->podcast_id,
            $this->episode->id,
            $bytesThreshold,
            $audioFileSize,
            $audioDuration,
            $this->episode->published_at->getTimestamp(),
            $serviceName,
            $subscription !== null ? $subscription->id : null
        );

        return redirect()->to($this->analyticsConfig->getAudioUrl($this->episode, $this->request->getGet()));
    }
}
