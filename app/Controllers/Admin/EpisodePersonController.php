<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Models\EpisodeModel;
use App\Models\PersonModel;
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;

class EpisodePersonController extends BaseController
{
    protected Podcast $podcast;

    protected Episode $episode;

    public function _remap(string $method, string ...$params): mixed
    {
        if (count($params) < 2) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (
            ($this->podcast = (new PodcastModel())->getPodcastById((int) $params[0],)) &&
            ($this->episode = (new EpisodeModel())
                ->where([
                    'id' => $params[1],
                    'podcast_id' => $params[0],
                ])
                ->first())
        ) {
            unset($params[1]);
            unset($params[0]);

            return $this->{$method}(...$params);
        }

        throw PageNotFoundException::forPageNotFound();
    }

    public function index(): string
    {
        helper('form');

        $data = [
            'episode' => $this->episode,
            'podcast' => $this->podcast,
            'personOptions' => (new PersonModel())->getPersonOptions(),
            'taxonomyOptions' => (new PersonModel())->getTaxonomyOptions(),
        ];
        replace_breadcrumb_params([
            0 => $this->podcast->title,
            1 => $this->episode->title,
        ]);
        return view('admin/episode/persons', $data);
    }

    public function attemptAdd(): RedirectResponse
    {
        $rules = [
            'persons' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        (new PersonModel())->addEpisodePersons(
            $this->podcast->id,
            $this->episode->id,
            $this->request->getPost('persons'),
            $this->request->getPost('roles') ?? [],
        );

        return redirect()->back();
    }

    public function remove(int $personId): RedirectResponse
    {
        (new PersonModel())->removePersonFromEpisode($this->podcast->id, $this->episode->id, $personId);

        return redirect()->back();
    }
}
