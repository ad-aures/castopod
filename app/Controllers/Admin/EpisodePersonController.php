<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RedirectResponse;
use App\Entities\Podcast;
use App\Entities\Episode;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\PodcastModel;
use App\Models\EpisodeModel;
use App\Models\PersonModel;

class EpisodePersonController extends BaseController
{
    protected Podcast $podcast;
    protected Episode $episode;

    public function _remap(string $method, string ...$params): mixed
    {
        if (count($params) <= 2) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (
            ($this->podcast = (new PodcastModel())->getPodcastById(
                (int) $params[0],
            )) &&
            ($this->episode = (new EpisodeModel())
                ->where([
                    'id' => $params[1],
                    'podcast_id' => $params[0],
                ])
                ->first())
        ) {
            unset($params[1]);
            unset($params[0]);

            return $this->$method(...$params);
        }

        throw PageNotFoundException::forPageNotFound();
    }

    public function index(): string
    {
        helper('form');

        $data = [
            'episode' => $this->episode,
            'podcast' => $this->podcast,
            'episodePersons' => (new PersonModel())->getEpisodePersons(
                $this->podcast->id,
                $this->episode->id,
            ),
            'personOptions' => (new PersonModel())->getPersonOptions(),
            'taxonomyOptions' => (new PersonModel())->getTaxonomyOptions(),
        ];
        replace_breadcrumb_params([
            0 => $this->podcast->title,
            1 => $this->episode->title,
        ]);
        return view('admin/episode/person', $data);
    }

    public function attemptAdd(): RedirectResponse
    {
        $rules = [
            'person' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        (new PersonModel())->addEpisodePersons(
            $this->podcast->id,
            $this->episode->id,
            $this->request->getPost('person'),
            $this->request->getPost('person_group_role'),
        );

        return redirect()->back();
    }

    public function remove(int $episodePersonId): RedirectResponse
    {
        (new PersonModel())->removeEpisodePersons(
            $this->podcast->id,
            $this->episode->id,
            $episodePersonId,
        );

        return redirect()->back();
    }
}
