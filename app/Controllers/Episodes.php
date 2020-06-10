<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Models\EpisodeModel;
use App\Models\PodcastModel;

class Episodes extends BaseController
{
    public function create($podcast_slug)
    {
        helper(['form', 'database', 'file']);

        $episode_model = new EpisodeModel();
        $podcast_model = new PodcastModel();
        $podcast_name = substr($podcast_slug, 1);
        $podcast = $podcast_model->where('name', $podcast_name)->first();

        if (
            !$this->validate([
                'episode_file' =>
                    'uploaded[episode_file]|ext_in[episode_file,mp3,m4a]',
                'title' => 'required',
                'slug' => 'required',
                'description' => 'required',
            ])
        ) {
            $data = [
                'podcast' => $podcast,
                'episode_types' => field_enums(
                    $episode_model->prefixTable('episodes'),
                    'type'
                ),
            ];

            echo view('episodes/create', $data);
        } else {
            $episode_slug = $this->request->getVar('slug');

            $episode_file = $this->request->getFile('episode_file');
            $episode_file_metadata = get_file_metadata($episode_file);
            $episode_file_name =
                $episode_slug . '.' . $episode_file->getExtension();
            $episode_path = save_podcast_media(
                $episode_file,
                $podcast_name,
                $episode_file_name
            );

            $image = $this->request->getFile('image');
            $image_path = '';
            if ($image->isValid()) {
                $image_name = $episode_slug . '.' . $image->getExtension();
                $image_path = save_podcast_media(
                    $image,
                    $podcast_name,
                    $image_name
                );
            }

            $episode_model->save([
                'podcast_id' => $podcast->id,
                'title' => $this->request->getVar('title'),
                'slug' => $episode_slug,
                'enclosure_url' => $episode_path,
                'enclosure_length' => $episode_file->getSize(),
                'enclosure_type' => $episode_file_metadata['mime_type'],
                'guid' => $podcast_slug . '/' . $episode_slug,
                'pub_date' => $this->request->getVar('pub_date'),
                'description' => $this->request->getVar('description'),
                'duration' => $episode_file_metadata['playtime_seconds'],
                'image' => $image_path,
                'explicit' => $this->request->getVar('explicit') or false,
                'episode_number' =>
                    $this->request->getVar('episode_number') or null,
                'season_number' =>
                    $this->request->getVar('season_number') or null,
                'type' => $this->request->getVar('type'),
                'block' => $this->request->getVar('block') or false,
            ]);

            return redirect()->to(
                base_url(
                    route_to(
                        'episodes_view',
                        '/@' . $podcast_name,
                        $episode_slug
                    )
                )
            );
        }
    }

    public function view($podcast_slug, $episode_slug)
    {
        $podcast_model = new PodcastModel();
        $episode_model = new EpisodeModel();

        $data = [
            'podcast' => $podcast_model
                ->where('name', substr($podcast_slug, 1))
                ->first(),
            'episode' => $episode_model->where('slug', $episode_slug)->first(),
        ];

        return view('episodes/view.php', $data);
    }
}
