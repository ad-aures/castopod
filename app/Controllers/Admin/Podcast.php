<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */
namespace App\Controllers\Admin;

use App\Models\CategoryModel;
use App\Models\LanguageModel;
use App\Models\PodcastModel;

class Podcast extends BaseController
{
    protected ?\App\Entities\Podcast $podcast;

    public function _remap($method, ...$params)
    {
        if (count($params) > 0) {
            switch ($method) {
                case 'edit':
                    if (
                        !has_permission('podcasts-edit') ||
                        !has_permission("podcasts:$params[0]-edit")
                    ) {
                        throw new \RuntimeException(
                            lang('Auth.notEnoughPrivilege')
                        );
                    }
                case 'delete':
                    if (
                        !has_permission('podcasts-delete') ||
                        !has_permission("podcasts:$params[0]-delete")
                    ) {
                        throw new \RuntimeException(
                            lang('Auth.notEnoughPrivilege')
                        );
                    }
                case 'listContributors':
                case 'addContributor':
                case 'editContributor':
                case 'deleteContributor':
                    if (
                        !has_permission('podcasts-manage_contributors') ||
                        !has_permission(
                            "podcasts:$params[0]-manage_contributors"
                        )
                    ) {
                        throw new \RuntimeException(
                            lang('Auth.notEnoughPrivilege')
                        );
                    }
            }

            $podcast_model = new PodcastModel();
            if (!($this->podcast = $podcast_model->find($params[0]))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }

        return $this->$method();
    }

    public function myPodcasts()
    {
        $data = [
            'all_podcasts' => (new PodcastModel())->getUserPodcasts(user()->id),
        ];

        return view('admin/podcast/list', $data);
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
    }

    public function attemptCreate()
    {
        $rules = [
            'image' => 'uploaded[image]|is_image[image]|ext_in[image,jpg,png]',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $podcast = new \App\Entities\Podcast([
            'title' => $this->request->getPost('title'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'episode_description_footer' => $this->request->getPost(
                'episode_description_footer'
            ),
            'image' => $this->request->getFile('image'),
            'language' => $this->request->getPost('language'),
            'category' => $this->request->getPost('category'),
            'explicit' => (bool) $this->request->getPost('explicit'),
            'author_name' => $this->request->getPost('author_name'),
            'author_email' => $this->request->getPost('author_email'),
            'owner' => user(),
            'owner_name' => $this->request->getPost('owner_name'),
            'owner_email' => $this->request->getPost('owner_email'),
            'type' => $this->request->getPost('type'),
            'copyright' => $this->request->getPost('copyright'),
            'block' => (bool) $this->request->getPost('block'),
            'complete' => (bool) $this->request->getPost('complete'),
            'custom_html_head' => $this->request->getPost('custom_html_head'),
        ]);

        $podcast_model = new PodcastModel();
        $db = \Config\Database::connect();

        $db->transStart();

        if (!($new_podcast_id = $podcast_model->insert($podcast, true))) {
            $db->transComplete();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $podcast_model->errors());
        }

        $podcast_model->addContributorToPodcast(user()->id, $new_podcast_id);

        $db->transComplete();

        return redirect()->route('podcast_list');
    }

    public function edit()
    {
        helper('form');

        $languageModel = new LanguageModel();
        $categoryModel = new CategoryModel();
        $data = [
            'podcast' => $this->podcast,
            'languages' => $languageModel->findAll(),
            'categories' => $categoryModel->findAll(),
        ];

        echo view('admin/podcast/edit', $data);
    }

    public function attemptEdit()
    {
        $rules = [
            'image' =>
                'uploaded[image]|is_image[image]|ext_in[image,jpg,png]|permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->podcast->title = $this->request->getPost('title');
        $this->podcast->name = $this->request->getPost('name');
        $this->podcast->description = $this->request->getPost('description');
        $this->podcast->episode_description_footer = $this->request->getPost(
            'episode_description_footer'
        );

        $image = $this->request->getFile('image');
        if ($image->isValid()) {
            $this->podcast->image = $image;
        }
        $this->podcast->language = $this->request->getPost('language');
        $this->podcast->category = $this->request->getPost('category');
        $this->podcast->explicit = (bool) $this->request->getPost('explicit');
        $this->podcast->author_name = $this->request->getPost('author_name');
        $this->podcast->author_email = $this->request->getPost('author_email');
        $this->podcast->owner_name = $this->request->getPost('owner_name');
        $this->podcast->owner_email = $this->request->getPost('owner_email');
        $this->podcast->type = $this->request->getPost('type');
        $this->podcast->copyright = $this->request->getPost('copyright');
        $this->podcast->block = (bool) $this->request->getPost('block');
        $this->podcast->complete = (bool) $this->request->getPost('complete');
        $this->podcast->custom_html_head = $this->request->getPost(
            'custom_html_head'
        );

        $podcast_model = new PodcastModel();

        if (!$podcast_model->save($this->podcast)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $podcast_model->errors());
        }

        return redirect()->route('podcast_list');
    }

    public function delete()
    {
        $podcast_model = new PodcastModel();
        $podcast_model->delete($this->podcast->id);

        return redirect()->route('podcast_list');
    }
}
