<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */
namespace App\Controllers\Admin;

use App\Entities\UserPodcast;
use App\Models\CategoryModel;
use App\Models\LanguageModel;
use App\Models\PodcastModel;

class Podcast extends BaseController
{
    protected ?\App\Entities\Podcast $podcast;

    public function _remap($method, ...$params)
    {
        if (count($params) > 0) {
            $podcast_model = new PodcastModel();
            if (
                !($podcast = $podcast_model->where('name', $params[0])->first())
            ) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            $this->podcast = $podcast;
        }

        return $this->$method();
    }

    public function list()
    {
        $podcast_model = new PodcastModel();

        $data = ['all_podcasts' => $podcast_model->findAll()];

        return view('admin/podcast/list', $data);
    }

    public function create()
    {
        helper(['form', 'misc']);
        $podcast_model = new PodcastModel();

        if (
            !$this->validate([
                'title' => 'required',
                'name' => 'required|regex_match[[a-zA-Z0-9\_]{1,191}]',
                'description' => 'required|max_length[4000]',
                'image' =>
                    'uploaded[image]|is_image[image]|ext_in[image,jpg,png]',
                'owner_email' => 'required|valid_email',
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

            echo view('admin/podcast/create', $data);
        } else {
            $podcast = new \App\Entities\Podcast([
                'title' => $this->request->getVar('title'),
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),
                'episode_description_footer' => $this->request->getVar(
                    'episode_description_footer'
                ),
                'image' => $this->request->getFile('image'),
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

            $db = \Config\Database::connect();

            $db->transStart();

            $new_podcast_id = $podcast_model->insert($podcast, true);

            $user_podcast_model = new \App\Models\UserPodcastModel();
            $user_podcast_model->save([
                'user_id' => user()->id,
                'podcast_id' => $new_podcast_id,
            ]);

            $db->transComplete();

            return redirect()->route('podcast_list', [$podcast->name]);
        }
    }

    public function edit()
    {
        helper(['form', 'misc']);

        if (
            !$this->validate([
                'title' => 'required',
                'name' => 'required|regex_match[[a-zA-Z0-9\_]{1,191}]',
                'description' => 'required|max_length[4000]',
                'image' =>
                    'uploaded[image]|is_image[image]|ext_in[image,jpg,png]|permit_empty',
                'owner_email' => 'required|valid_email',
                'type' => 'required',
            ])
        ) {
            $languageModel = new LanguageModel();
            $categoryModel = new CategoryModel();
            $data = [
                'podcast' => $this->podcast,
                'languages' => $languageModel->findAll(),
                'categories' => $categoryModel->findAll(),
            ];

            echo view('admin/podcast/edit', $data);
        } else {
            $this->podcast->title = $this->request->getVar('title');
            $this->podcast->name = $this->request->getVar('name');
            $this->podcast->description = $this->request->getVar('description');
            $this->podcast->episode_description_footer = $this->request->getVar(
                'episode_description_footer'
            );

            $image = $this->request->getFile('image');
            if ($image->isValid()) {
                $this->podcast->image = $this->request->getFile('image');
            }
            $this->podcast->language = $this->request->getVar('language');
            $this->podcast->category = $this->request->getVar('category');
            $this->podcast->explicit =
                ($this->request->getVar('explicit') or false);
            $this->podcast->author_name = $this->request->getVar('author_name');
            $this->podcast->author_email = $this->request->getVar(
                'author_email'
            );
            $this->podcast->owner_name = $this->request->getVar('owner_name');
            $this->podcast->owner_email = $this->request->getVar('owner_email');
            $this->podcast->type = $this->request->getVar('type');
            $this->podcast->copyright = $this->request->getVar('copyright');
            $this->podcast->block = ($this->request->getVar('block') or false);
            $this->podcast->complete =
                ($this->request->getVar('complete') or false);
            $this->podcast->custom_html_head = $this->request->getVar(
                'custom_html_head'
            );

            $podcast_model = new PodcastModel();
            $podcast_model->save($this->podcast);

            return redirect()->route('podcast_list', [$this->podcast->name]);
        }
    }

    public function delete()
    {
        $podcast_model = new PodcastModel();
        $podcast_model->delete($this->podcast->id);

        return redirect()->route('podcast_list');
    }
}
