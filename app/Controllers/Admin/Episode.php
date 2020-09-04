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
    /**
     * @var \App\Entities\Podcast
     */
    protected $podcast;

    /**
     * @var \App\Entities\Episode|null
     */
    protected $episode;

    public function _remap($method, ...$params)
    {
        $this->podcast = (new PodcastModel())->getPodcastById($params[0]);

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

        replace_breadcrumb_params([
            0 => $this->podcast->title,
        ]);
        return view('admin/episode/list', $data);
    }

    public function view()
    {
        $data = ['episode' => $this->episode];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
            1 => $this->episode->title,
        ]);
        return view('admin/episode/view', $data);
    }

    public function create()
    {
        helper(['form']);

        $data = [
            'podcast' => $this->podcast,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
        ]);
        return view('admin/episode/create', $data);
    }

    public function attemptCreate()
    {
        $rules = [
            'enclosure' => 'uploaded[enclosure]|ext_in[enclosure,mp3,m4a]',
            'image' =>
                'uploaded[image]|is_image[image]|ext_in[image,jpg,png]|permit_empty',
            'publication_date' => 'valid_date[Y-m-d]|permit_empty',
            'publication_time' =>
                'regex_match[/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/]|permit_empty',
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
            'description' => $this->request->getPost('description'),
            'image' => $this->request->getFile('image'),
            'explicit' => $this->request->getPost('explicit') == 'yes',
            'number' => $this->request->getPost('episode_number'),
            'season_number' => $this->request->getPost('season_number'),
            'type' => $this->request->getPost('type'),
            'block' => $this->request->getPost('block') == 'yes',
            'created_by' => user(),
            'updated_by' => user(),
        ]);
        $newEpisode->setPublishedAt(
            $this->request->getPost('publication_date'),
            $this->request->getPost('publication_time')
        );

        $episodeModel = new EpisodeModel();

        if (!$episodeModel->save($newEpisode)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        return redirect()->route('episode-list', [$this->podcast->id]);
    }

    public function edit()
    {
        helper(['form']);

        $data = [
            'episode' => $this->episode,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
            1 => $this->episode->title,
        ]);
        return view('admin/episode/edit', $data);
    }

    public function attemptEdit()
    {
        $rules = [
            'enclosure' =>
                'uploaded[enclosure]|ext_in[enclosure,mp3,m4a]|permit_empty',
            'image' =>
                'uploaded[image]|is_image[image]|ext_in[image,jpg,png]|permit_empty',
            'publication_date' => 'valid_date[Y-m-d]|permit_empty',
            'publication_time' =>
                'regex_match[/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/]|permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->episode->title = $this->request->getPost('title');
        $this->episode->slug = $this->request->getPost('slug');
        $this->episode->description = $this->request->getPost('description');
        $this->episode->explicit = $this->request->getPost('explicit') == 'yes';
        $this->episode->number = $this->request->getPost('episode_number');
        $this->episode->season_number = $this->request->getPost('season_number')
            ? $this->request->getPost('season_number')
            : null;
        $this->episode->type = $this->request->getPost('type');
        $this->episode->block = $this->request->getPost('block') == 'yes';
        $this->episode->setPublishedAt(
            $this->request->getPost('publication_date'),
            $this->request->getPost('publication_time')
        );
        $this->episode->updated_by = user();

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

        return redirect()->route('episode-list', [$this->podcast->id]);
    }

    public function delete()
    {
        (new EpisodeModel())->delete($this->episode->id);

        return redirect()->route('episode-list', [$this->podcast->id]);
    }
}
