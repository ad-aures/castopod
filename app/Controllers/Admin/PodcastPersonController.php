<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RedirectResponse;
use App\Entities\Podcast;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\PodcastModel;
use App\Models\PersonModel;

class PodcastPersonController extends BaseController
{
    /**
     * @var Podcast
     */
    protected $podcast;

    public function _remap(string $method, string ...$params): mixed
    {
        if (count($params) === 0) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (
            ($this->podcast = (new PodcastModel())->getPodcastById(
                (int) $params[0],
            )) !== null
        ) {
            unset($params[0]);
            return $this->$method(...$params);
        }

        throw PageNotFoundException::forPageNotFound();
    }

    public function index(): string
    {
        helper('form');

        $data = [
            'podcast' => $this->podcast,
            'podcastPersons' => (new PersonModel())->getPodcastPersons(
                $this->podcast->id,
            ),
            'personOptions' => (new PersonModel())->getPersonOptions(),
            'taxonomyOptions' => (new PersonModel())->getTaxonomyOptions(),
        ];
        replace_breadcrumb_params([
            0 => $this->podcast->title,
        ]);
        return view('admin/podcast/person', $data);
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

        (new PersonModel())->addPodcastPersons(
            $this->podcast->id,
            $this->request->getPost('person'),
            $this->request->getPost('person_group_role'),
        );

        return redirect()->back();
    }

    public function remove(int $podcastPersonId): RedirectResponse
    {
        (new PersonModel())->removePodcastPersons(
            $this->podcast->id,
            $podcastPersonId,
        );

        return redirect()->back();
    }
}
