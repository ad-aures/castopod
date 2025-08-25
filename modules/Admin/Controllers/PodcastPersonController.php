<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use App\Entities\Podcast;
use App\Models\PersonModel;
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;

class PodcastPersonController extends BaseController
{
    protected Podcast $podcast;

    public function _remap(string $method, string ...$params): mixed
    {
        if ($params === []) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (
            ($podcast = new PodcastModel()->getPodcastById((int) $params[0])) instanceof Podcast
        ) {
            unset($params[0]);
            return $this->{$method}($podcast, ...$params);
        }

        throw PageNotFoundException::forPageNotFound();
    }

    public function index(Podcast $podcast): string
    {
        helper('form');

        $data = [
            'podcast'        => $podcast,
            'podcastPersons' => new PersonModel()
                ->getPodcastPersons($podcast->id),
            'personOptions' => new PersonModel()
                ->getPersonOptions(),
            'taxonomyOptions' => new PersonModel()
                ->getTaxonomyOptions(),
        ];

        $this->setHtmlHead(lang('Person.podcast_form.title'));
        replace_breadcrumb_params([
            0 => $podcast->at_handle,
        ]);
        return view('podcast/persons', $data);
    }

    public function createAction(Podcast $podcast): RedirectResponse
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

        new PersonModel()
            ->addPodcastPersons($podcast->id, $validData['persons'], $this->request->getPost('roles') ?? []);

        return redirect()->back();
    }

    public function deleteAction(Podcast $podcast, string $personId): RedirectResponse
    {
        new PersonModel()
            ->removePersonFromPodcast($podcast->id, (int) $personId);

        return redirect()->back();
    }
}
