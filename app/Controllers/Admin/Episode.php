<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use App\Models\EpisodeModel;
use App\Models\PodcastModel;

class Episode extends BaseController
{
    protected \App\Entities\Podcast $podcast;
    protected ?\App\Entities\Episode $episode;

    public function _remap($method, ...$params)
    {
        $this->podcast = (new PodcastModel())->find($params[0]);

        if (count($params) > 1) {
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
        }

        return $this->$method();
    }

    public function list()
    {
        $data = [
            'podcast' => $this->podcast,
        ];

        return view('admin/episode/list', $data);
    }

    public function view()
    {
        $data = ['episode' => $this->episode];

        return view('admin/episode/view', $data);
    }

    public function create()
    {
        helper(['form']);

        $data = [
            'podcast' => $this->podcast,
        ];

        echo view('admin/episode/create', $data);
    }

    public function attemptCreate()
    {
        $rules = [
            'enclosure' => 'uploaded[enclosure]|ext_in[enclosure,mp3,m4a]',
            'image' =>
                'uploaded[image]|is_image[image]|ext_in[image,jpg,png]|permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $newEpisode = new \App\Entities\Episode([
            'podcast_id' => $this->podcast->id,
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'enclosure' => $this->request->getFile('enclosure'),
            'pub_date' => $this->request->getPost('pub_date'),
            'description' => $this->request->getPost('description'),
            'image' => $this->request->getFile('image'),
            'explicit' => (bool) $this->request->getPost('explicit'),
            'number' => $this->request->getPost('episode_number'),
            'season_number' => $this->request->getPost('season_number'),
            'type' => $this->request->getPost('type'),
            'author_name' => $this->request->getPost('author_name'),
            'author_email' => $this->request->getPost('author_email'),
            'block' => (bool) $this->request->getPost('block'),
        ]);

        $episodeModel = new EpisodeModel();

        if (!$episodeModel->save($newEpisode)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        return redirect()->route('episode_list', [$this->podcast->id]);
    }

    public function edit()
    {
        helper(['form']);

        $data = [
            'episode' => $this->episode,
        ];

        echo view('admin/episode/edit', $data);
    }

    public function attemptEdit()
    {
        $rules = [
            'enclosure' =>
                'uploaded[enclosure]|ext_in[enclosure,mp3,m4a]|permit_empty',
            'image' =>
                'uploaded[image]|is_image[image]|ext_in[image,jpg,png]|permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->episode->title = $this->request->getPost('title');
        $this->episode->slug = $this->request->getPost('slug');
        $this->episode->pub_date = $this->request->getPost('pub_date');
        $this->episode->description = $this->request->getPost('description');
        $this->episode->explicit = (bool) $this->request->getPost('explicit');
        $this->episode->number = $this->request->getPost('episode_number');
        $this->episode->season_number = $this->request->getPost('season_number')
            ? $this->request->getPost('season_number')
            : null;
        $this->episode->type = $this->request->getPost('type');
        $this->episode->author_name = $this->request->getPost('author_name');
        $this->episode->author_email = $this->request->getPost('author_email');
        $this->episode->block = (bool) $this->request->getPost('block');

        $enclosure = $this->request->getFile('enclosure');
        if ($enclosure->isValid()) {
            $this->episode->enclosure = $enclosure;
        }
        $image = $this->request->getFile('image');
        if ($image) {
            $this->episode->image = $image;
        }

        $episodeModel = new EpisodeModel();

        if (!$episodeModel->save($this->episode)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        return redirect()->route('episode_list', [$this->podcast->id]);
    }

    public function delete()
    {
        (new EpisodeModel())->delete($this->episode->id);

        return redirect()->route('episode_list', [$this->podcast->id]);
    }
}
