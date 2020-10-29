<?php

/**
 * Class Analytics
 * Creates Analytics controller
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use CodeIgniter\Controller;

class Analytics extends Controller
{
    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend Analytics.
     *
     * @var array
     */
    protected $helpers = ['analytics'];

    /**
     * Constructor.
     */
    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.:
        // $this->session = \Config\Services::session();

        set_user_session_deny_list_ip();
        set_user_session_location();
        set_user_session_player();
    }

    // Add one hit to this episode:
    public function hit($base64EpisodeData, ...$filename)
    {
        helper('media', 'analytics');

        $serviceName = isset($_GET['_from']) ? $_GET['_from'] : '';

        $episodeData = unpack(
            'IpodcastId/IepisodeId/IbytesThreshold/IfileSize/Iduration/IpublicationDate',
            base64_url_decode($base64EpisodeData)
        );

        podcast_hit(
            $episodeData['podcastId'],
            $episodeData['episodeId'],
            $episodeData['bytesThreshold'],
            $episodeData['fileSize'],
            $episodeData['duration'],
            $episodeData['publicationDate'],
            $serviceName
        );
        return redirect()->to(media_base_url($filename));
    }
}
