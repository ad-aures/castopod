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
use Deprecated;

class EpisodeAnalyticsController extends Controller
{
    #[Deprecated(message: 'Replaced by EpisodeAudioController::index method')]
    public function hit(string $base64EpisodeData, string ...$audioPath): RedirectResponse
    {
        $episodeData = unpack(
            'IpodcastId/IepisodeId/IbytesThreshold/IfileSize/Iduration/IpublicationDate',
            base64_url_decode($base64EpisodeData),
        );

        if ($episodeData === false) {
            throw PageNotFoundException::forPageNotFound();
        }

        $episode = new EpisodeModel()
            ->getEpisodeById($episodeData['episodeId']);

        if (! $episode instanceof Episode) {
            throw PageNotFoundException::forPageNotFound();
        }

        return redirect()->route(
            'episode-audio',
            [$episode->podcast->handle, $episode->slug, $episode->audio->file_extension],
        );
    }
}
