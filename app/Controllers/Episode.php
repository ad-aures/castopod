<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Models\EpisodeModel;
use App\Models\PodcastModel;

helper('podcast');

class Episode extends BaseController
{
    public function create($podcast_name)
    {
        helper(['form', 'database', 'media', 'id3']);

        $episode_model = new EpisodeModel();
        $podcast_model = new PodcastModel();

        $podcast = $podcast_model->where('name', $podcast_name)->first();

        if (
            !$this->validate([
                'episode_file' =>
                    'uploaded[episode_file]|ext_in[episode_file,mp3,m4a]',
                'title' => 'required',
                'slug' => 'required',
                'description' => 'required',
                'type' => 'required',
            ])
        ) {
            $data = [
                'podcast' => $podcast,
            ];

            echo view('episode/create', $data);
        } else {
            $episode_slug = $this->request->getVar('slug');

            $episode_file = $this->request->getFile('episode_file');
            $episode_file_metadata = get_file_tags($episode_file);

            $image = $this->request->getFile('image');

            // By default, the episode's image path is set to the podcast's
            $image_path = $podcast->image_uri;

            // check whether the user has inputted an image and store it
            if ($image->isValid()) {
                $image_path = save_podcast_media(
                    $image,
                    $podcast_name,
                    $episode_slug
                );
            } elseif ($APICdata = $episode_file_metadata['attached_picture']) {
                // if the user didn't input an image,
                // check if the uploaded audio file has an attached cover and store it
                $cover_image = new \CodeIgniter\Files\File('episode_cover');
                file_put_contents($cover_image, $APICdata);

                $image_path = save_podcast_media(
                    $cover_image,
                    $podcast_name,
                    $episode_slug
                );
            }

            $episode_path = save_podcast_media(
                $episode_file,
                $podcast_name,
                $episode_slug
            );

            $episode = new \App\Entities\Episode([
                'podcast_id' => $podcast->id,
                'title' => $this->request->getVar('title'),
                'slug' => $episode_slug,
                'enclosure_uri' => $episode_path,
                'enclosure_length' => $episode_file->getSize(),
                'enclosure_type' => $episode_file_metadata['mime_type'],
                'pub_date' => $this->request->getVar('pub_date'),
                'description' => $this->request->getVar('description'),
                'duration' => $episode_file_metadata['playtime_seconds'],
                'image_uri' => $image_path,
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

            $episode_model->save($episode);

            $episode_file = write_file_tags($podcast, $episode);

            return redirect()->to(
                base_url(route_to('episode_view', $podcast_name, $episode_slug))
            );
        }
    }

    public function view($podcast_name, $episode_slug)
    {
        $podcast_model = new PodcastModel();
        $episode_model = new EpisodeModel();

        $podcast = $podcast_model->where('name', $podcast_name)->first();
        $episode = $episode_model->where('slug', $episode_slug)->first();

        $data = [
            'podcast' => $podcast,
            'episode' => $episode,
        ];
        self::triggerWebpageHit($data['podcast']->id);

        return view('episode/view.php', $data);
    }
}
