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
use Modules\Analytics\Config\Analytics;
use Psr\Log\LoggerInterface;

class EpisodeAnalyticsController extends Controller
{
    public mixed $config;

    /**
     * An array of helpers to be loaded automatically upon class instantiation. These helpers will be available to all
     * other controllers that extend Analytics.
     *
     * @var string[]
     */
    protected $helpers = ['analytics'];

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

        $this->config = config('Analytics');
    }

    /**
     * @deprecated Replaced by EpisodeController::audio method
     */
    public function hit(string $base64EpisodeData, string ...$audioPath): RedirectResponse
    {
        $episodeData = unpack(
            'IpodcastId/IepisodeId/IbytesThreshold/IfileSize/Iduration/IpublicationDate',
            base64_url_decode($base64EpisodeData),
        );

        if ($episodeData === false) {
            throw PageNotFoundException::forPageNotFound();
        }

        $episode = (new EpisodeModel())->getEpisodeById($episodeData['episodeId']);

        if (! $episode instanceof Episode) {
            throw PageNotFoundException::forPageNotFound();
        }

        return redirect()->route(
            'episode-audio',
            [$episode->podcast->handle, $episode->slug, $episode->audio->file_extension]
        );
    }
}
