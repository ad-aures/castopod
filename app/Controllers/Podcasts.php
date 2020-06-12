<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Entities\Podcast;
use App\Models\CategoryModel;
use App\Models\EpisodeModel;
use App\Models\LanguageModel;
use App\Models\PodcastModel;

class Podcasts extends BaseController
{
    public function create()
    {
        helper(['form', 'database', 'media', 'misc']);
        $podcast_model = new PodcastModel();

        if (
            !$this->validate([
                'title' => 'required',
                'name' => 'required|regex_match[^[a-z0-9\_]{1,191}$]',
                'description' => 'required|max_length[4000]',
                'image' =>
                    'uploaded[image]|is_image[image]|ext_in[image,jpg,png]|max_dims[image,3000,3000]',
                'owner_email' => 'required|valid_email|permit_empty',
                'type' => 'required',
            ])
        ) {
            $languageModel = new LanguageModel();
            $categoryModel = new CategoryModel();
            $data = [
                'languages' => $languageModel->findAll(),
                'categories' => $categoryModel->findAll(),
                'browser_lang' => get_browser_language(
                    $this->request->getServer('HTTP_ACCEPT_LANGUAGE')
                ),
                'podcast_types' => field_enums(
                    $podcast_model->prefixTable('podcasts'),
                    'type'
                ),
            ];

            echo view('podcasts/create', $data);
        } else {
            $image = $this->request->getFile('image');
            $podcast_name = $this->request->getVar('name');
            $image_path = save_podcast_media($image, $podcast_name, 'cover');

            $podcast = new Podcast([
                'title' => $this->request->getVar('title'),
                'name' => $podcast_name,
                'description' => $this->request->getVar('description'),
                'episode_description_footer' => $this->request->getVar(
                    'episode_description_footer'
                ),
                'image' => $image_path,
                'language' => $this->request->getVar('language'),
                'category' => $this->request->getVar('category'),
                'explicit' => $this->request->getVar('explicit') or false,
                'author' => $this->request->getVar('author'),
                'owner_name' => $this->request->getVar('owner_name'),
                'owner_email' => $this->request->getVar('owner_email'),
                'type' => $this->request->getVar('type'),
                'copyright' => $this->request->getVar('copyright'),
                'block' => $this->request->getVar('block') or false,
                'complete' => $this->request->getVar('complete') or false,
                'custom_html_head' => $this->request->getVar(
                    'custom_html_head'
                ),
            ]);

            $podcast_model->save($podcast);

            return redirect()->to(
                base_url(route_to('podcasts_view', '@' . $podcast_name))
            );
        }
    }

    public function view($slug)
    {
        $podcast_model = new PodcastModel();
        $episode_model = new EpisodeModel();

        $podcast_name = substr($slug, 1);

        $podcast = $podcast_model->where('name', $podcast_name)->first();
        $data = [
            'podcast' => $podcast,
            'episodes' => $episode_model
                ->where('podcast_id', $podcast->id)
                ->findAll(),
        ];

        return view('podcasts/view', $data);
    }
}
