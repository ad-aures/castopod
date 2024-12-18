<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Models\EpisodeModel;
use App\Models\PersonModel;
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;

class EpisodePersonController extends BaseController
{
    public function _remap(string $method, string ...$params): mixed
    {
        if ($params === []) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (count($params) === 1) {
            if (! ($podcast = (new PodcastModel())->getPodcastById((int) $params[0])) instanceof Podcast) {
                throw PageNotFoundException::forPageNotFound();
            }

            return $this->{$method}($podcast);
        }

        if (
            ! ($episode = (new EpisodeModel())->getEpisodeById((int) $params[1]) instanceof Episode)
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        unset($params[0]);
        unset($params[1]);

        return $this->{$method}($episode, ...$params);
    }

    public function index(Episode $episode): string
    {
        helper('form');

        $data = [
            'episode'         => $episode,
            'podcast'         => $episode->podcast,
            'personOptions'   => (new PersonModel())->getPersonOptions(),
            'taxonomyOptions' => (new PersonModel())->getTaxonomyOptions(),
        ];

        $this->setHtmlHead(lang('Person.episode_form.title'));
        replace_breadcrumb_params([
            0 => $episode->podcast->at_handle,
            1 => $episode->title,
        ]);
        return view('episode/persons', $data);
    }

    public function createAction(Episode $episode): RedirectResponse
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

        $validData = $this->validator->getValidated();

        (new PersonModel())->addEpisodePersons(
            $episode->podcast_id,
            $episode->id,
            $validData['persons'],
            $this->request->getPost('roles') ?? [],
        );

        return redirect()->back();
    }

    public function deleteAction(Episode $episode, string $personId): RedirectResponse
    {
        (new PersonModel())->removePersonFromEpisode($episode->podcast_id, $episode->id, (int) $personId);

        return redirect()->back();
    }
}
