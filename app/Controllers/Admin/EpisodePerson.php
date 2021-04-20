<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use App\Models\EpisodePersonModel;
use App\Models\PodcastModel;
use App\Models\EpisodeModel;
use App\Models\PersonModel;

class EpisodePerson extends BaseController
{
    /**
     * @var \App\Entities\Podcast
     */
    protected $podcast;

    /**
     * @var \App\Entities\Episode
     */
    protected $episode;

    public function _remap($method, ...$params)
    {
        if (count($params) > 1) {
            if (
                !($this->podcast = (new PodcastModel())->getPodcastById(
                    $params[0],
                ))
            ) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            if (
                !($this->episode = (new EpisodeModel())
                    ->where([
                        'id' => $params[1],
                        'podcast_id' => $params[0],
                    ])
                    ->first())
            ) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        unset($params[1]);
        unset($params[0]);

        return $this->$method(...$params);
    }

    public function index()
    {
        helper('form');

        $data = [
            'episode' => $this->episode,
            'podcast' => $this->podcast,
            'episodePersons' => (new EpisodePersonModel())->getEpisodePersons(
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

    public function attemptAdd()
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

        (new EpisodePersonModel())->addEpisodePersons(
            $this->podcast->id,
            $this->episode->id,
            $this->request->getPost('person'),
            $this->request->getPost('person_group_role'),
        );

        return redirect()->back();
    }

    public function remove($episodePersonId)
    {
        (new EpisodePersonModel())->removeEpisodePersons(
            $this->podcast->id,
            $this->episode->id,
            $episodePersonId,
        );

        return redirect()->back();
    }
}
