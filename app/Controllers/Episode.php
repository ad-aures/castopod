<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Models\EpisodeModel;
use App\Models\PodcastModel;

class Episode extends BaseController
{
    protected \App\Entities\Podcast $podcast;
    protected ?\App\Entities\Episode $episode;

    public function _remap($method, ...$params)
    {
        $podcast_model = new PodcastModel();

        $this->podcast = $podcast_model->where('name', $params[0])->first();

        if (count($params) > 1) {
            $episode_model = new EpisodeModel();
            if (
                !($episode = $episode_model
                    ->where([
                        'podcast_id' => $this->podcast->id,
                        'slug' => $params[1],
                    ])
                    ->first())
            ) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            $this->episode = $episode;
        }

        return $this->$method();
    }

    public function create()
    {
        helper(['form']);

        if (
            !$this->validate([
                'enclosure' => 'uploaded[enclosure]|ext_in[enclosure,mp3,m4a]',
                'image' =>
                    'uploaded[image]|is_image[image]|ext_in[image,jpg,png]|permit_empty',
                'title' => 'required',
                'slug' => 'required|regex_match[[a-zA-Z0-9\-]{1,191}]',
                'description' => 'required',
                'type' => 'required',
            ])
        ) {
            $data = [
                'podcast' => $this->podcast,
            ];

            echo view('episode/create', $data);
        } else {
            $new_episode = new \App\Entities\Episode([
                'podcast_id' => $this->podcast->id,
                'title' => $this->request->getVar('title'),
                'slug' => $this->request->getVar('slug'),
                'enclosure' => $this->request->getFile('enclosure'),
                'pub_date' => $this->request->getVar('pub_date'),
                'description' => $this->request->getVar('description'),
                'image' => $this->request->getFile('image'),
                'explicit' => $this->request->getVar('explicit') or false,
                'number' => $this->request->getVar('episode_number'),
                'season_number' => $this->request->getVar('season_number')
                    ? $this->request->getVar('season_number')
                    : null,
                'type' => $this->request->getVar('type'),
                'author_name' => $this->request->getVar('author_name'),
                'author_email' => $this->request->getVar('author_email'),
                'block' => $this->request->getVar('block') or false,
            ]);

            $episode_model = new EpisodeModel();
            $episode_model->save($new_episode);

            return redirect()->to(
                base_url(
                    route_to(
                        'episode_view',
                        $this->podcast->name,
                        $new_episode->slug
                    )
                )
            );
        }
    }

    public function edit()
    {
        helper(['form']);

        if (
            !$this->validate([
                'enclosure' =>
                    'uploaded[enclosure]|ext_in[enclosure,mp3,m4a]|permit_empty',
                'image' =>
                    'uploaded[image]|is_image[image]|ext_in[image,jpg,png]|permit_empty',
                'title' => 'required',
                'slug' => 'required|regex_match[[a-zA-Z0-9\-]{1,191}]',
                'description' => 'required',
                'type' => 'required',
            ])
        ) {
            $data = [
                'podcast' => $this->podcast,
                'episode' => $this->episode,
            ];

            echo view('episode/edit', $data);
        } else {
            $this->episode->title = $this->request->getVar('title');
            $this->episode->slug = $this->request->getVar('slug');
            $this->episode->pub_date = $this->request->getVar('pub_date');
            $this->episode->description = $this->request->getVar('description');
            $this->episode->explicit =
                ($this->request->getVar('explicit') or false);
            $this->episode->number = $this->request->getVar('episode_number');
            $this->episode->season_number = $this->request->getVar(
                'season_number'
            )
                ? $this->request->getVar('season_number')
                : null;
            $this->episode->type = $this->request->getVar('type');
            $this->episode->author_name = $this->request->getVar('author_name');
            $this->episode->author_email = $this->request->getVar(
                'author_email'
            );
            $this->episode->block = ($this->request->getVar('block') or false);

            $enclosure = $this->request->getFile('enclosure');
            if ($enclosure->isValid()) {
                $this->episode->enclosure = $this->request->getFile(
                    'enclosure'
                );
            }
            $image = $this->request->getFile('image');
            if ($image) {
                $this->episode->image = $this->request->getFile('image');
            }

            $episode_model = new EpisodeModel();
            $episode_model->save($this->episode);

            return redirect()->to(
                base_url(
                    route_to(
                        'episode_view',
                        $this->podcast->name,
                        $this->episode->slug
                    )
                )
            );
        }
    }

    public function view()
    {
        // The page cache is set to a decade so it is deleted manually upon podcast update
        $this->cachePage(DECADE);

        self::triggerWebpageHit($this->podcast->id);

        $data = [
            'podcast' => $this->podcast,
            'episode' => $this->episode,
        ];
        return view('episode/view', $data);
    }

    public function delete()
    {
        $episode_model = new EpisodeModel();
        $episode_model->delete($this->episode->id);

        return redirect()->to(
            base_url(route_to('podcast_view', $this->podcast->name))
        );
    }
}
