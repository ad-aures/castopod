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
use App\Models\EpisodeModel;
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
            if (
                !($this->podcast = (new PodcastModel())->getPodcastById(
                    $params[0]
                ))
            ) {
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

    public function viewAnalytics()
    {
        $data = ['podcast' => $this->podcast];

        replace_breadcrumb_params([0 => $this->podcast->title]);
        return view('admin/podcast/analytics/index', $data);
    }

    public function viewAnalyticsWebpages()
    {
        $data = ['podcast' => $this->podcast];

        replace_breadcrumb_params([0 => $this->podcast->title]);
        return view('admin/podcast/analytics/webpages', $data);
    }

    public function viewAnalyticsLocations()
    {
        $data = ['podcast' => $this->podcast];

        replace_breadcrumb_params([0 => $this->podcast->title]);
        return view('admin/podcast/analytics/locations', $data);
    }

    public function viewAnalyticsUniqueListeners()
    {
        $data = ['podcast' => $this->podcast];

        replace_breadcrumb_params([0 => $this->podcast->title]);
        return view('admin/podcast/analytics/unique_listeners', $data);
    }

    public function viewAnalyticsListeningTime()
    {
        $data = ['podcast' => $this->podcast];

        replace_breadcrumb_params([0 => $this->podcast->title]);
        return view('admin/podcast/analytics/listening_time', $data);
    }

    public function viewAnalyticsTimePeriods()
    {
        $data = ['podcast' => $this->podcast];

        replace_breadcrumb_params([0 => $this->podcast->title]);
        return view('admin/podcast/analytics/time_periods', $data);
    }

    public function viewAnalyticsPlayers()
    {
        $data = ['podcast' => $this->podcast];

        replace_breadcrumb_params([0 => $this->podcast->title]);
        return view('admin/podcast/analytics/players', $data);
    }

    public function create()
    {
        helper(['form', 'misc']);

        $languageOptions = (new LanguageModel())->getLanguageOptions();
        $categoryOptions = (new CategoryModel())->getCategoryOptions();

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
            'image' =>
                'uploaded[image]|is_image[image]|ext_in[image,jpg,png]|min_dims[image,1400,1400]|is_image_squared[image]',
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
            'description_markdown' => $this->request->getPost('description'),
            'image' => $this->request->getFile('image'),
            'language_code' => $this->request->getPost('language'),
            'category_id' => $this->request->getPost('category'),
            'parental_advisory' =>
                $this->request->getPost('parental_advisory') !== 'undefined'
                    ? $this->request->getPost('parental_advisory')
                    : null,
            'owner_name' => $this->request->getPost('owner_name'),
            'owner_email' => $this->request->getPost('owner_email'),
            'publisher' => $this->request->getPost('publisher'),
            'type' => $this->request->getPost('type'),
            'copyright' => $this->request->getPost('copyright'),
            'location' => $this->request->getPost('location_name'),
            'payment_pointer' => $this->request->getPost('payment_pointer'),
            'custom_rss_string' => $this->request->getPost('custom_rss'),
            'partner_id' => $this->request->getPost('partner_id'),
            'partner_link_url' => $this->request->getPost('partner_link_url'),
            'partner_image_url' => $this->request->getPost('partner_image_url'),
            'is_blocked' => $this->request->getPost('block') === 'yes',
            'is_completed' => $this->request->getPost('complete') === 'yes',
            'is_locked' => $this->request->getPost('lock') === 'yes',
            'created_by' => user(),
            'updated_by' => user(),
        ]);

        $podcastModel = new PodcastModel();
        $db = \Config\Database::connect();

        $db->transStart();

        if (!($newPodcastId = $podcastModel->insert($podcast, true))) {
            $db->transRollback();
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

        // set Podcast categories
        (new CategoryModel())->setPodcastCategories(
            $newPodcastId,
            $this->request->getPost('other_categories')
        );

        $db->transComplete();

        return redirect()->route('podcast-view', [$newPodcastId]);
    }

    public function edit()
    {
        helper('form');

        $languageOptions = (new LanguageModel())->getLanguageOptions();
        $categoryOptions = (new CategoryModel())->getCategoryOptions();

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
                'is_image[image]|ext_in[image,jpg,png]|min_dims[image,1400,1400]|is_image_squared[image]',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->podcast->title = $this->request->getPost('title');
        $this->podcast->name = $this->request->getPost('name');
        $this->podcast->description_markdown = $this->request->getPost(
            'description'
        );

        $image = $this->request->getFile('image');
        if ($image->isValid()) {
            $this->podcast->image = $image;
        }
        $this->podcast->language_code = $this->request->getPost('language');
        $this->podcast->category_id = $this->request->getPost('category');
        $this->podcast->parental_advisory =
            $this->request->getPost('parental_advisory') !== 'undefined'
                ? $this->request->getPost('parental_advisory')
                : null;
        $this->podcast->publisher = $this->request->getPost('publisher');
        $this->podcast->owner_name = $this->request->getPost('owner_name');
        $this->podcast->owner_email = $this->request->getPost('owner_email');
        $this->podcast->type = $this->request->getPost('type');
        $this->podcast->copyright = $this->request->getPost('copyright');
        $this->podcast->location = $this->request->getPost('location_name');
        $this->podcast->payment_pointer = $this->request->getPost(
            'payment_pointer'
        );
        $this->podcast->custom_rss_string = $this->request->getPost(
            'custom_rss'
        );
        $this->podcast->partner_id = $this->request->getPost('partner_id');
        $this->podcast->partner_link_url = $this->request->getPost(
            'partner_link_url'
        );
        $this->podcast->partner_image_url = $this->request->getPost(
            'partner_image_url'
        );
        $this->podcast->is_blocked = $this->request->getPost('block') === 'yes';
        $this->podcast->is_completed =
            $this->request->getPost('complete') === 'yes';
        $this->podcast->is_locked = $this->request->getPost('lock') === 'yes';
        $this->updated_by = user();

        $db = \Config\Database::connect();
        $db->transStart();

        $podcastModel = new PodcastModel();
        if (!$podcastModel->update($this->podcast->id, $this->podcast)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $podcastModel->errors());
        }

        // set Podcast categories
        (new CategoryModel())->setPodcastCategories(
            $this->podcast->id,
            $this->request->getPost('other_categories')
        );

        $db->transComplete();

        return redirect()->route('podcast-view', [$this->podcast->id]);
    }

    public function latestEpisodes(int $limit, int $podcast_id)
    {
        $episodes = (new EpisodeModel())
            ->where('podcast_id', $podcast_id)
            ->orderBy('created_at', 'desc')
            ->findAll($limit);

        return view('admin/podcast/latest_episodes', ['episodes' => $episodes]);
    }

    public function delete()
    {
        (new PodcastModel())->delete($this->podcast->id);

        return redirect()->route('podcast-list');
    }
}
