<?php

declare(strict_types=1);

/**
 * @copyright  2023 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Entities\Episode;
use App\Models\EpisodeModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;

class EpisodePreviewController extends BaseController
{
    protected Episode $episode;

    public function _remap(string $method, string ...$params): mixed
    {
        if (count($params) < 1) {
            throw PageNotFoundException::forPageNotFound();
        }

        // find episode by previewUUID
        $episode = (new EpisodeModel())->getEpisodeByPreviewId($params[0]);

        if (! $episode instanceof Episode) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->episode = $episode;

        if ($episode->publication_status === 'published') {
            // redirect to episode page
            return redirect()->route('episode', [$episode->podcast->handle, $episode->slug]);
        }

        unset($params[0]);

        return $this->{$method}(...$params);
    }

    public function index(): RedirectResponse | string
    {
        helper('form');

        return view('episode/preview-comments', [
            'podcast' => $this->episode->podcast,
            'episode' => $this->episode,
        ]);
    }

    public function activity(): RedirectResponse | string
    {
        helper('form');

        return view('episode/preview-activity', [
            'podcast' => $this->episode->podcast,
            'episode' => $this->episode,
        ]);
    }
}
