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
use League\HTMLToMarkdown\HtmlConverter;

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
        return view('admin/podcast/analytics/listening-time', $data);
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
            'description' => $this->request->getPost('description'),
            'image' => $this->request->getFile('image'),
            'language' => $this->request->getPost('language'),
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
            'block' => $this->request->getPost('block') === 'yes',
            'complete' => $this->request->getPost('complete') === 'yes',
            'lock' => $this->request->getPost('lock') === 'yes',
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

    public function import()
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

        return view('admin/podcast/import', $data);
    }

    public function attemptImport()
    {
        helper(['media', 'misc']);

        $rules = [
            'imported_feed_url' => 'required|validate_url',
            'season_number' => 'is_natural_no_zero|permit_empty',
            'max_episodes' => 'is_natural_no_zero|permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }
        try {
            $feed = simplexml_load_file(
                $this->request->getPost('imported_feed_url')
            );
        } catch (\ErrorException $ex) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [
                    $ex->getMessage() .
                    ': <a href="' .
                    $this->request->getPost('imported_feed_url') .
                    '" rel="noreferrer noopener" target="_blank">' .
                    $this->request->getPost('imported_feed_url') .
                    ' ⎋</a>',
                ]);
        }
        $nsItunes = $feed->channel[0]->children(
            'http://www.itunes.com/dtds/podcast-1.0.dtd'
        );
        $nsPodcast = $feed->channel[0]->children(
            'https://github.com/Podcastindex-org/podcast-namespace/blob/main/docs/1.0.md'
        );

        if ((string) $nsPodcast->locked === 'yes') {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [lang('PodcastImport.lock_import')]);
        }

        $podcast = new \App\Entities\Podcast([
            'name' => $this->request->getPost('name'),
            'imported_feed_url' => $this->request->getPost('imported_feed_url'),
            'new_feed_url' => base_url(
                route_to('podcast_feed', $this->request->getPost('name'))
            ),
            'title' => $feed->channel[0]->title,
            'description' => $feed->channel[0]->description,
            'image' => download_file($nsItunes->image->attributes()),
            'language' => $this->request->getPost('language'),
            'category_id' => $this->request->getPost('category'),
            'parental_advisory' => empty($nsItunes->explicit)
                ? null
                : (in_array($nsItunes->explicit, ['yes', 'true'])
                    ? 'explicit'
                    : (in_array($nsItunes->explicit, ['no', 'false'])
                        ? 'clean'
                        : null)),
            'owner_name' => $nsItunes->owner->name,
            'owner_email' => $nsItunes->owner->email,
            'publisher' => $nsItunes->author,
            'type' => empty($nsItunes->type) ? 'episodic' : $nsItunes->type,
            'copyright' => $feed->channel[0]->copyright,
            'block' => empty($nsItunes->block)
                ? false
                : $nsItunes->block === 'yes',
            'complete' => empty($nsItunes->complete)
                ? false
                : $nsItunes->complete === 'yes',
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

        $converter = new HtmlConverter();

        $numberItems = $feed->channel[0]->item->count();
        $lastItem =
            !empty($this->request->getPost('max_episodes')) &&
            $this->request->getPost('max_episodes') < $numberItems
                ? $this->request->getPost('max_episodes')
                : $numberItems;

        $slugs = [];

        // For each Episode:
        for ($itemNumber = 1; $itemNumber <= $lastItem; $itemNumber++) {
            $item = $feed->channel[0]->item[$numberItems - $itemNumber];

            $nsItunes = $item->children(
                'http://www.itunes.com/dtds/podcast-1.0.dtd'
            );

            $slug = slugify(
                $this->request->getPost('slug_field') === 'title'
                    ? $item->title
                    : basename($item->link)
            );
            if (in_array($slug, $slugs)) {
                $slugNumber = 2;
                while (in_array($slug . '-' . $slugNumber, $slugs)) {
                    $slugNumber++;
                }
                $slug = $slug . '-' . $slugNumber;
            }
            $slugs[] = $slug;

            $newEpisode = new \App\Entities\Episode([
                'podcast_id' => $newPodcastId,
                'guid' => empty($item->guid) ? null : $item->guid,
                'title' => $item->title,
                'slug' => $slug,
                'enclosure' => download_file($item->enclosure->attributes()),
                'description' => $converter->convert(
                    $this->request->getPost('description_field') === 'summary'
                        ? $nsItunes->summary
                        : ($this->request->getPost('description_field') ===
                        'subtitle_summary'
                            ? $nsItunes->subtitle . "\n" . $nsItunes->summary
                            : $item->description)
                ),
                'image' => empty($nsItunes->image->attributes())
                    ? null
                    : download_file($nsItunes->image->attributes()),
                'parental_advisory' => empty($nsItunes->explicit)
                    ? null
                    : (in_array($nsItunes->explicit, ['yes', 'true'])
                        ? 'explicit'
                        : (in_array($nsItunes->explicit, ['no', 'false'])
                            ? 'clean'
                            : null)),
                'number' =>
                    $this->request->getPost('force_renumber') === 'yes'
                        ? $itemNumber
                        : $nsItunes->episode,
                'season_number' => empty(
                    $this->request->getPost('season_number')
                )
                    ? $nsItunes->season
                    : $this->request->getPost('season_number'),
                'type' => empty($nsItunes->episodeType)
                    ? 'full'
                    : $nsItunes->episodeType,
                'block' => empty($nsItunes->block)
                    ? false
                    : $nsItunes->block === 'yes',
                'created_by' => user(),
                'updated_by' => user(),
                'published_at' => strtotime($item->pubDate),
            ]);

            $episodeModel = new EpisodeModel();

            if (!$episodeModel->insert($newEpisode)) {
                // FIXME: What shall we do?
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $episodeModel->errors());
            }
        }

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
        $this->podcast->description = $this->request->getPost('description');

        $image = $this->request->getFile('image');
        if ($image->isValid()) {
            $this->podcast->image = $image;
        }
        $this->podcast->language = $this->request->getPost('language');
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
        $this->podcast->block = $this->request->getPost('block') === 'yes';
        $this->podcast->complete =
            $this->request->getPost('complete') === 'yes';
        $this->podcast->lock = $this->request->getPost('lock') === 'yes';
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
