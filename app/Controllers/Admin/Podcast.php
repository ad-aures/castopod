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
use Config\Services;

class Podcast extends BaseController
{
    /**
     * @var \App\Entities\Podcast|null
     */
    protected $podcast;

    public function _remap($method, ...$params)
    {
        if (count($params) > 0) {
            if (!($this->podcast = (new PodcastModel())->find($params[0]))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }

        return $this->$method();
    }

    public function list()
    {
        if (!has_permission('podcasts-list')) {
            $data = [
                'podcasts' => (new PodcastModel())->getUserPodcasts(user()->id),
            ];
        } else {
            $data = ['podcasts' => (new PodcastModel())->findAll()];
        }

        return view('admin/podcast/list', $data);
    }

    public function view()
    {
        $data = ['podcast' => $this->podcast];

        replace_breadcrumb_params([0 => $this->podcast->title]);
        return view('admin/podcast/view', $data);
    }

    public function create()
    {
        helper(['form', 'misc']);

        $categories = (new CategoryModel())->findAll();
        $languages = (new LanguageModel())->findAll();
        $languageOptions = array_reduce(
            $languages,
            function ($result, $language) {
                $result[$language->code] = $language->native_name;
                return $result;
            },
            []
        );
        $categoryOptions = array_reduce(
            $categories,
            function ($result, $category) {
                $result[$category->code] = lang(
                    'Podcast.category_options.' . $category->code
                );
                return $result;
            },
            []
        );

        $data = [
            'languageOptions' => $languageOptions,
            'categoryOptions' => $categoryOptions,
            'browserLang' => get_browser_language(
                $this->request->getServer('HTTP_ACCEPT_LANGUAGE')
            ),
        ];

        return view('admin/podcast/create', $data);
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
            'explicit' => $this->request->getPost('explicit') == 'yes',
            'author' => $this->request->getPost('author'),
            'owner_name' => $this->request->getPost('owner_name'),
            'owner_email' => $this->request->getPost('owner_email'),
            'type' => $this->request->getPost('type'),
            'copyright' => $this->request->getPost('copyright'),
            'block' => $this->request->getPost('block') == 'yes',
            'complete' => $this->request->getPost('complete') == 'yes',
            'custom_html_head' => $this->request->getPost('custom_html_head'),
            'created_by' => user(),
            'updated_by' => user(),
        ]);

        $podcastModel = new PodcastModel();
        $db = \Config\Database::connect();

        $db->transStart();

        if (!($newPodcastId = $podcastModel->insert($podcast, true))) {
            $db->transComplete();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $podcastModel->errors());
        }

        $authorize = Services::authorization();
        $podcastAdminGroup = $authorize->group('podcast_admin');

        $podcastModel->addPodcastContributor(
            user()->id,
            $newPodcastId,
            $podcastAdminGroup->id
        );

        $db->transComplete();

        return redirect()->route('podcast-view', [$newPodcastId]);
    }

    public function edit()
    {
        helper('form');

        $categories = (new CategoryModel())->findAll();
        $languages = (new LanguageModel())->findAll();
        $languageOptions = array_reduce(
            $languages,
            function ($result, $language) {
                $result[$language->code] = $language->native_name;
                return $result;
            },
            []
        );
        $categoryOptions = array_reduce(
            $categories,
            function ($result, $category) {
                $result[$category->code] = lang(
                    'Podcast.category_options.' . $category->code
                );
                return $result;
            },
            []
        );

        $data = [
            'podcast' => $this->podcast,
            'languageOptions' => $languageOptions,
            'categoryOptions' => $categoryOptions,
        ];

        replace_breadcrumb_params([0 => $this->podcast->title]);
        return view('admin/podcast/edit', $data);
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
        $this->podcast->explicit = $this->request->getPost('explicit') == 'yes';
        $this->podcast->author = $this->request->getPost('author');
        $this->podcast->owner_name = $this->request->getPost('owner_name');
        $this->podcast->owner_email = $this->request->getPost('owner_email');
        $this->podcast->type = $this->request->getPost('type');
        $this->podcast->copyright = $this->request->getPost('copyright');
        $this->podcast->block = $this->request->getPost('block') == 'yes';
        $this->podcast->complete = $this->request->getPost('complete') == 'yes';
        $this->podcast->custom_html_head = $this->request->getPost(
            'custom_html_head'
        );
        $this->updated_by = user();

        $podcastModel = new PodcastModel();

        if (!$podcastModel->save($this->podcast)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $podcastModel->errors());
        }

        return redirect()->route('podcast-list');
    }

    public function delete()
    {
        (new PodcastModel())->delete($this->podcast->id);

        return redirect()->route('podcast-list');
    }
}
