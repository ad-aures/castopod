<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use App\Entities\Actor;
use App\Entities\Location;
use App\Entities\Podcast;
use App\Entities\Post;
use App\Models\ActorModel;
use App\Models\CategoryModel;
use App\Models\EpisodeModel;
use App\Models\LanguageModel;
use App\Models\PodcastModel;
use App\Models\PostModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\I18n\Time;
use Modules\Analytics\Models\AnalyticsPodcastByCountryModel;
use Modules\Analytics\Models\AnalyticsPodcastByEpisodeModel;
use Modules\Analytics\Models\AnalyticsPodcastByHourModel;
use Modules\Analytics\Models\AnalyticsPodcastByPlayerModel;
use Modules\Analytics\Models\AnalyticsPodcastByRegionModel;
use Modules\Analytics\Models\AnalyticsPodcastModel;
use Modules\Analytics\Models\AnalyticsWebsiteByBrowserModel;
use Modules\Analytics\Models\AnalyticsWebsiteByEntryPageModel;
use Modules\Analytics\Models\AnalyticsWebsiteByRefererModel;
use Modules\Auth\Config\AuthGroups;
use Modules\Media\Entities\Image;
use Modules\Media\FileManagers\FileManagerInterface;
use Modules\Media\Models\MediaModel;

class PodcastController extends BaseController
{
    protected Podcast $podcast;

    public function _remap(string $method, string ...$params): mixed
    {
        if ($params === []) {
            return $this->{$method}();
        }

        if (
            ($podcast = (new PodcastModel())->getPodcastById((int) $params[0])) instanceof Podcast
        ) {
            $this->podcast = $podcast;
            return $this->{$method}();
        }

        throw PageNotFoundException::forPageNotFound();
    }

    public function list(): string
    {
        if (auth()->user()->can('podcasts.view')) {
            $data = [
                'podcasts' => (new PodcastModel())->findAll(),
            ];
        } else {
            $data = [
                'podcasts' => get_user_podcasts(auth()->user()),
            ];
        }

        return view('podcast/list', $data);
    }

    public function view(): string
    {
        $data = [
            'podcast' => $this->podcast,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
        ]);
        return view('podcast/view', $data);
    }

    public function viewAnalytics(): string
    {
        $data = [
            'podcast' => $this->podcast,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
        ]);
        return view('podcast/analytics/index', $data);
    }

    public function viewAnalyticsWebpages(): string
    {
        $data = [
            'podcast' => $this->podcast,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
        ]);
        return view('podcast/analytics/webpages', $data);
    }

    public function viewAnalyticsLocations(): string
    {
        $data = [
            'podcast' => $this->podcast,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
        ]);
        return view('podcast/analytics/locations', $data);
    }

    public function viewAnalyticsUniqueListeners(): string
    {
        $data = [
            'podcast' => $this->podcast,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
        ]);
        return view('podcast/analytics/unique_listeners', $data);
    }

    public function viewAnalyticsListeningTime(): string
    {
        $data = [
            'podcast' => $this->podcast,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
        ]);
        return view('podcast/analytics/listening_time', $data);
    }

    public function viewAnalyticsTimePeriods(): string
    {
        $data = [
            'podcast' => $this->podcast,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
        ]);
        return view('podcast/analytics/time_periods', $data);
    }

    public function viewAnalyticsPlayers(): string
    {
        $data = [
            'podcast' => $this->podcast,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
        ]);
        return view('podcast/analytics/players', $data);
    }

    public function create(): string
    {
        helper(['form', 'misc']);

        $languageOptions = (new LanguageModel())->getLanguageOptions();
        $categoryOptions = (new CategoryModel())->getCategoryOptions();

        $data = [
            'languageOptions' => $languageOptions,
            'categoryOptions' => $categoryOptions,
            'browserLang'     => get_browser_language($this->request->getServer('HTTP_ACCEPT_LANGUAGE')),
        ];

        return view('podcast/create', $data);
    }

    public function attemptCreate(): RedirectResponse
    {
        $rules = [
            'cover'  => 'uploaded[cover]|is_image[cover]|ext_in[cover,jpg,jpeg,png]|min_dims[cover,1400,1400]|is_image_ratio[cover,1,1]',
            'banner' => 'is_image[banner]|ext_in[banner,jpg,jpeg,png]|min_dims[banner,1500,500]|is_image_ratio[banner,3,1]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $db = db_connect();
        $db->transStart();

        $newPodcast = new Podcast([
            'created_by'           => user_id(),
            'updated_by'           => user_id(),
            'title'                => $this->request->getPost('title'),
            'handle'               => $this->request->getPost('handle'),
            'cover'                => $this->request->getFile('cover'),
            'banner'               => $this->request->getFile('banner'),
            'description_markdown' => $this->request->getPost('description'),
            'language_code'        => $this->request->getPost('language'),
            'category_id'          => $this->request->getPost('category'),
            'parental_advisory'    => $this->request->getPost('parental_advisory') !== 'undefined'
                    ? $this->request->getPost('parental_advisory')
                    : null,
            'owner_name'                       => $this->request->getPost('owner_name'),
            'owner_email'                      => $this->request->getPost('owner_email'),
            'is_owner_email_removed_from_feed' => $this->request->getPost('is_owner_email_removed_from_feed') === 'yes',
            'publisher'                        => $this->request->getPost('publisher'),
            'type'                             => $this->request->getPost('type'),
            'copyright'                        => $this->request->getPost('copyright'),
            'location'                         => $this->request->getPost('location_name') === '' ? null : new Location(
                $this->request->getPost('location_name')
            ),
            'custom_rss_string'     => $this->request->getPost('custom_rss'),
            'is_blocked'            => $this->request->getPost('block') === 'yes',
            'is_completed'          => $this->request->getPost('complete') === 'yes',
            'is_locked'             => $this->request->getPost('lock') === 'yes',
            'is_premium_by_default' => $this->request->getPost('premium_by_default') === 'yes',
            'published_at'          => null,
        ]);

        $podcastModel = new PodcastModel();
        if (! ($newPodcastId = $podcastModel->insert($newPodcast, true))) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $podcastModel->errors());
        }

        // generate podcast roles and permissions
        // before setting current user as podcast admin
        config(AuthGroups::class)
            ->generatePodcastAuthorizations($newPodcastId);
        add_podcast_group(auth()->user(), (int) $newPodcastId, setting('AuthGroups.mostPowerfulPodcastGroup'));

        // set Podcast categories
        (new CategoryModel())->setPodcastCategories(
            (int) $newPodcastId,
            $this->request->getPost('other_categories') ?? [],
        );

        // OP3
        service('settings')
            ->set('Analytics.enableOP3', $this->request->getPost('enable_op3') === 'yes', 'podcast:' . $newPodcastId);

        $db->transComplete();

        return redirect()->route('podcast-view', [$newPodcastId])->with(
            'message',
            lang('Podcast.messages.createSuccess')
        );
    }

    public function edit(): string
    {
        helper('form');

        $languageOptions = (new LanguageModel())->getLanguageOptions();
        $categoryOptions = (new CategoryModel())->getCategoryOptions();

        $data = [
            'podcast'         => $this->podcast,
            'languageOptions' => $languageOptions,
            'categoryOptions' => $categoryOptions,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
        ]);
        return view('podcast/edit', $data);
    }

    public function attemptEdit(): RedirectResponse
    {
        $rules = [
            'cover'  => 'is_image[cover]|ext_in[cover,jpg,jpeg,png]|min_dims[cover,1400,1400]|is_image_ratio[cover,1,1]',
            'banner' => 'is_image[banner]|ext_in[banner,jpg,jpeg,png]|min_dims[banner,1500,500]|is_image_ratio[banner,3,1]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->podcast->updated_by = (int) user_id();

        $this->podcast->title = $this->request->getPost('title');
        $this->podcast->description_markdown = $this->request->getPost('description');
        $this->podcast->setCover($this->request->getFile('cover'));
        $this->podcast->setBanner($this->request->getFile('banner'));

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
        $this->podcast->location = $this->request->getPost('location_name') === '' ? null : new Location(
            $this->request->getPost('location_name')
        );
        $this->podcast->custom_rss_string = $this->request->getPost('custom_rss');
        $this->podcast->new_feed_url = $this->request->getPost('new_feed_url') === '' ? null : $this->request->getPost(
            'new_feed_url'
        );

        $this->podcast->is_blocked = $this->request->getPost('block') === 'yes';
        $this->podcast->is_completed =
            $this->request->getPost('complete') === 'yes';
        $this->podcast->is_locked = $this->request->getPost('lock') === 'yes';
        $this->podcast->is_premium_by_default = $this->request->getPost('premium_by_default') === 'yes';

        // republish on websub hubs upon edit
        $this->podcast->is_published_on_hubs = false;

        $db = db_connect();

        $db->transStart();

        $podcastModel = new PodcastModel();
        if (! $podcastModel->update($this->podcast->id, $this->podcast)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $podcastModel->errors());
        }

        // set Podcast categories
        (new CategoryModel())->setPodcastCategories(
            $this->podcast->id,
            $this->request->getPost('other_categories') ?? [],
        );

        // enable/disable OP3?
        service('settings')
            ->set(
                'Analytics.enableOP3',
                $this->request->getPost('enable_op3') === 'yes',
                'podcast:' . $this->podcast->id
            );

        $db->transComplete();

        return redirect()->route('podcast-edit', [$this->podcast->id])->with(
            'message',
            lang('Podcast.messages.editSuccess')
        );
    }

    public function monetizationOther(): string
    {
        helper('form');

        $data = [
            'podcast' => $this->podcast,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
        ]);
        return view('podcast/monetization_other', $data);
    }

    public function monetizationOtherAction(): RedirectResponse
    {
        if (
            ($partnerId = $this->request->getPost('partner_id')) === '' ||
            ($partnerLinkUrl = $this->request->getPost('partner_link_url')) === '' ||
            ($partnerImageUrl = $this->request->getPost('partner_image_url')) === '') {
            $partnerId = null;
            $partnerLinkUrl = null;
            $partnerImageUrl = null;
        }

        $this->podcast->payment_pointer = $this->request->getPost(
            'payment_pointer'
        ) === '' ? null : $this->request->getPost('payment_pointer');

        $this->podcast->partner_id = $partnerId;
        $this->podcast->partner_link_url = $partnerLinkUrl;
        $this->podcast->partner_image_url = $partnerImageUrl;

        $podcastModel = new PodcastModel();
        if (! $podcastModel->update($this->podcast->id, $this->podcast)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $podcastModel->errors());
        }

        return redirect()->route('podcast-monetization-other', [$this->podcast->id])->with(
            'message',
            lang('Podcast.messages.editSuccess')
        );
    }

    public function deleteBanner(): RedirectResponse
    {
        if (! $this->podcast->banner instanceof Image) {
            return redirect()->back();
        }

        $db = db_connect();

        $db->transStart();

        $mediaModel = new MediaModel();
        if (! $mediaModel->deleteMedia($this->podcast->banner)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $mediaModel->errors());
        }

        (new PodcastModel())->clearCache([
            'id' => $this->podcast->id,
        ]);

        // remove banner url from actor
        $actor = (new ActorModel())->getActorById($this->podcast->actor_id);

        if ($actor instanceof Actor) {
            $actor->cover_image_url = null;
            $actor->cover_image_mimetype = null;

            (new ActorModel())->update($actor->id, $actor);
        }

        $db->transComplete();

        return redirect()->back();
    }

    public function latestEpisodes(int $limit, int $podcastId): string
    {
        $episodes = (new EpisodeModel())
            ->where('podcast_id', $podcastId)
            ->orderBy('-`published_at`', '', false)
            ->orderBy('created_at', 'desc')
            ->findAll($limit);

        return view('podcast/latest_episodes', [
            'episodes' => $episodes,
            'podcast'  => (new PodcastModel())->getPodcastById($podcastId),
        ]);
    }

    public function delete(): string
    {
        helper(['form']);

        $data = [
            'podcast' => $this->podcast,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
        ]);
        return view('podcast/delete', $data);
    }

    public function attemptDelete(): RedirectResponse
    {
        $rules = [
            'understand' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $db = db_connect();

        $db->transStart();

        //delete podcast episodes
        $podcastEpisodes = (new EpisodeModel())->where('podcast_id', $this->podcast->id)
            ->findAll();

        foreach ($podcastEpisodes as $podcastEpisode) {
            $episodeModel = new EpisodeModel();

            if (! $episodeModel->delete($podcastEpisode->id)) {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $episodeModel->errors());
            }

            $episodeMediaList = [$podcastEpisode->transcript, $podcastEpisode->chapters, $podcastEpisode->audio];

            //only delete episode cover if different from podcast's
            if ($podcastEpisode->cover_id !== null) {
                $episodeMediaList[] = $podcastEpisode->cover;
            }

            $mediaModel = new MediaModel();

            foreach ($episodeMediaList as $episodeMedia) {
                if ($episodeMedia !== null && ! $mediaModel->delete($episodeMedia->id)) {
                    $db->transRollback();
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('error', lang('Podcast.messages.deleteEpisodeMediaError', [
                            'episode_slug' => $podcastEpisode->slug,
                            'type'         => $episodeMedia->type,
                        ]));
                }
            }
        }

        //delete podcast
        $podcastModel = new PodcastModel();

        if (! $podcastModel->delete($this->podcast->id)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $podcastModel->errors());
        }

        //delete podcast media
        $podcastMediaList = [
            [
                'type' => 'cover',
                'file' => $this->podcast->cover,
            ],
        ];

        if ($this->podcast->banner_id !== null) {
            $podcastMediaList[] =
            [
                'type' => 'banner',
                'file' => $this->podcast->banner,
            ];
        }

        $mediaModel = new MediaModel();

        foreach ($podcastMediaList as $podcastMedia) {
            if ($podcastMedia['file'] instanceof Image && ! $mediaModel->delete($podcastMedia['file']->id)) {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', lang('Podcast.messages.deletePodcastMediaError', [
                        'type' => $podcastMedia['type'],
                    ]));
            }
        }

        //delete podcast actor
        $actorModel = new ActorModel();

        if (! $actorModel->delete($this->podcast->actor_id)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $actorModel->errors());
        }

        //delete podcast analytics
        $analyticsModels = [
            new AnalyticsPodcastModel(),
            new AnalyticsPodcastByCountryModel(),
            new AnalyticsPodcastByEpisodeModel(),
            new AnalyticsPodcastByHourModel(),
            new AnalyticsPodcastByPlayerModel(),
            new AnalyticsPodcastByRegionModel(),
            new AnalyticsWebsiteByBrowserModel(),
            new AnalyticsWebsiteByEntryPageModel(),
            new AnalyticsWebsiteByRefererModel(),
        ];
        foreach ($analyticsModels as $analyticsModel) {
            if (! $analyticsModel->where([
                'podcast_id' => $this->podcast->id,
            ])->delete()) {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $analyticsModel->errors());
            }
        }

        $db->transComplete();

        /** @var FileManagerInterface $fileManager */
        $fileManager = service('file_manager');

        //delete podcast media files and folder
        $folder = 'podcasts/' . $this->podcast->handle;
        if (! $fileManager->deleteAll($folder)) {
            return redirect()->route('podcast-list')
                ->with('message', lang('Podcast.messages.deleteSuccess', [
                    'podcast_handle' => $this->podcast->handle,
                ]))
                ->with('warning', lang('Podcast.messages.deletePodcastMediaFolderError', [
                    'folder_path' => $folder,
                ]));
        }

        return redirect()->route('podcast-list')
            ->with('message', lang('Podcast.messages.deleteSuccess', [
                'podcast_handle' => $this->podcast->handle,
            ]));
    }

    public function publish(): string | RedirectResponse
    {
        helper(['form']);

        $data = [
            'podcast' => $this->podcast,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
        ]);

        return view('podcast/publish', $data);
    }

    public function attemptPublish(): RedirectResponse
    {
        if ($this->podcast->publication_status !== 'not_published') {
            return redirect()->route('podcast-view', [$this->podcast->id])->with(
                'error',
                lang('Podcast.messages.publishError')
            );
        }

        $rules = [
            'publication_method'         => 'required',
            'scheduled_publication_date' => 'valid_date[Y-m-d H:i]|permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        $db = db_connect();
        $db->transStart();

        $publishMethod = $validData['publication_method'];
        if ($publishMethod === 'schedule') {
            $scheduledPublicationDate = $validData['scheduled_publication_date'];
            if ($scheduledPublicationDate) {
                $this->podcast->published_at = Time::createFromFormat(
                    'Y-m-d H:i',
                    $scheduledPublicationDate,
                    $this->request->getPost('client_timezone'),
                )->setTimezone(app_timezone());
            } else {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', lang('Podcast.messages.scheduleDateError'));
            }
        } else {
            $this->podcast->published_at = Time::now();
        }

        $message = $this->request->getPost('message');
        // only create post if message is not empty
        if ($message !== '') {
            $newPost = new Post([
                'actor_id'   => $this->podcast->actor_id,
                'message'    => $message,
                'created_by' => user_id(),
            ]);

            $newPost->published_at = $this->podcast->published_at;

            $postModel = new PostModel();
            if (! $postModel->addPost($newPost)) {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $postModel->errors());
            }
        }

        $episodes = (new EpisodeModel())
            ->where('podcast_id', $this->podcast->id)
            ->where('published_at !=', null)
            ->findAll();

        foreach ($episodes as $episode) {
            $episode->published_at = $this->podcast->published_at->addSeconds(1);

            $episodeModel = new EpisodeModel();
            if (! $episodeModel->update($episode->id, $episode)) {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $episodeModel->errors());
            }

            $post = (new PostModel())->where('episode_id', $episode->id)
                ->first();

            if ($post instanceof Post) {
                $post->published_at = $episode->published_at;
                $postModel = new PostModel();
                if (! $postModel->update($post->id, $post)) {
                    $db->transRollback();
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('errors', $postModel->errors());
                }
            }
        }

        $podcastModel = new PodcastModel();
        if (! $podcastModel->update($this->podcast->id, $this->podcast)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $podcastModel->errors());
        }

        $db->transComplete();

        return redirect()->route('podcast-view', [$this->podcast->id]);
    }

    public function publishEdit(): string | RedirectResponse
    {
        helper(['form']);

        $data = [
            'podcast' => $this->podcast,
            'post'    => (new PostModel())
                ->where([
                    'actor_id'   => $this->podcast->actor_id,
                    'episode_id' => null,
                ])
                ->first(),
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
        ]);

        return view('podcast/publish_edit', $data);
    }

    public function attemptPublishEdit(): RedirectResponse
    {
        if ($this->podcast->publication_status !== 'scheduled') {
            return redirect()->route('podcast-view', [$this->podcast->id])->with(
                'error',
                lang('Podcast.messages.publishEditError')
            );
        }

        $rules = [
            'publication_method'         => 'required',
            'scheduled_publication_date' => 'valid_date[Y-m-d H:i]|permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        $db = db_connect();
        $db->transStart();

        $publishMethod = $validData['publication_method'];
        if ($publishMethod === 'schedule') {
            $scheduledPublicationDate = $validData['scheduled_publication_date'];
            if ($scheduledPublicationDate) {
                $this->podcast->published_at = Time::createFromFormat(
                    'Y-m-d H:i',
                    $scheduledPublicationDate,
                    $this->request->getPost('client_timezone'),
                )->setTimezone(app_timezone());
            } else {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', lang('Podcast.messages.scheduleDateError'));
            }
        } else {
            $this->podcast->published_at = Time::now();
        }

        $post = (new PostModel())
            ->where([
                'actor_id'   => $this->podcast->actor_id,
                'episode_id' => null,
            ])
            ->first();

        $newPostMessage = $this->request->getPost('message');

        if ($post instanceof Post) {
            if ($newPostMessage !== '') {
                // edit post if post exists and message is not empty
                $post->message = $newPostMessage;
                $post->published_at = $this->podcast->published_at;

                $postModel = new PostModel();
                if (! $postModel->editPost($post)) {
                    $db->transRollback();
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('errors', $postModel->errors());
                }
            } else {
                // remove post if post exists and message is empty
                $postModel = new PostModel();
                $post = $postModel
                    ->where([
                        'actor_id'   => $this->podcast->actor_id,
                        'episode_id' => null,
                    ])
                    ->first();
                $postModel->removePost($post);
            }
        } elseif ($newPostMessage !== '') {
            // create post if there is no post and message is not empty
            $newPost = new Post([
                'actor_id'   => $this->podcast->actor_id,
                'message'    => $newPostMessage,
                'created_by' => user_id(),
            ]);

            $newPost->published_at = $this->podcast->published_at;

            $postModel = new PostModel();
            if (! $postModel->addPost($newPost)) {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $postModel->errors());
            }
        }

        $episodes = (new EpisodeModel())
            ->where('podcast_id', $this->podcast->id)
            ->where('published_at !=', null)
            ->findAll();

        foreach ($episodes as $episode) {
            $episode->published_at = $this->podcast->published_at->addSeconds(1);

            $episodeModel = new EpisodeModel();
            if (! $episodeModel->update($episode->id, $episode)) {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $episodeModel->errors());
            }

            $post = (new PostModel())->where('episode_id', $episode->id)
                ->first();

            if ($post instanceof Post) {
                $post->published_at = $episode->published_at;
                $postModel = new PostModel();
                if (! $postModel->update($post->id, $post)) {
                    $db->transRollback();
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('errors', $postModel->errors());
                }
            }
        }

        $podcastModel = new PodcastModel();
        if (! $podcastModel->update($this->podcast->id, $this->podcast)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $podcastModel->errors());
        }

        $db->transComplete();

        return redirect()->route('podcast-view', [$this->podcast->id]);
    }

    public function publishCancel(): RedirectResponse
    {
        if ($this->podcast->publication_status !== 'scheduled') {
            return redirect()->route('podcast-view', [$this->podcast->id]);
        }

        $db = db_connect();
        $db->transStart();

        $postModel = new PostModel();
        $post = $postModel
            ->where([
                'actor_id'   => $this->podcast->actor_id,
                'episode_id' => null,
            ])
            ->first();
        if ($post instanceof Post) {
            $postModel->removePost($post);
        }

        $episodes = (new EpisodeModel())
            ->where('podcast_id', $this->podcast->id)
            ->where('published_at !=', null)
            ->findAll();

        foreach ($episodes as $episode) {
            $episode->published_at = null;

            $episodeModel = new EpisodeModel();
            if (! $episodeModel->update($episode->id, $episode)) {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $episodeModel->errors());
            }

            $postModel = new PostModel();
            $post = $postModel->where('episode_id', $episode->id)
                ->first();
            $postModel->removePost($post);
        }

        $this->podcast->published_at = null;

        $podcastModel = new PodcastModel();
        if (! $podcastModel->update($this->podcast->id, $this->podcast)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $podcastModel->errors());
        }

        $db->transComplete();

        return redirect()->route('podcast-view', [$this->podcast->id])->with(
            'message',
            lang('Podcast.messages.publishCancelSuccess')
        );
    }
}
