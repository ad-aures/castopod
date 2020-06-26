<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */
namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\EpisodeModel;
use App\Models\LanguageModel;
use App\Models\PodcastModel;

class Podcast extends BaseController
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
            ];

            echo view('podcast/create', $data);
        } else {
            $image = $this->request->getFile('image');
            $podcast_name = $this->request->getVar('name');
            $image_path = save_podcast_media($image, $podcast_name, 'cover');

            $podcast = new \App\Entities\Podcast([
                'title' => $this->request->getVar('title'),
                'name' => $podcast_name,
                'description' => $this->request->getVar('description'),
                'episode_description_footer' => $this->request->getVar(
                    'episode_description_footer'
                ),
                'image_uri' => $image_path,
                'language' => $this->request->getVar('language'),
                'category' => $this->request->getVar('category'),
                'explicit' => $this->request->getVar('explicit') or false,
                'author_name' => $this->request->getVar('author_name'),
                'author_email' => $this->request->getVar('author_email'),
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
                base_url(route_to('podcast_view', $podcast->name))
            );
        }
    }

    public function view($podcast_name)
    {
        $podcast_model = new PodcastModel();
        $episode_model = new EpisodeModel();

        $podcast = $podcast_model->where('name', $podcast_name)->first();
        $data = [
            'podcast' => $podcast,
            'episodes' => $episode_model
                ->where('podcast_id', $podcast->id)
                ->findAll(),
        ];
        self::triggerWebpageHit($podcast->id);

        return view('podcast/view', $data);
    }
}
