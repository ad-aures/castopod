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
use Modules\Media\Entities\Image;
use Modules\Media\FileManagers\FileManagerInterface;
use Modules\Media\Models\MediaModel;

class PodcastController extends BaseController
{
    public function _remap(string $method, string ...$params): mixed
    {
        if ($params === []) {
            return $this->{$method}();
        }

        if (
            ($podcast = new PodcastModel()->getPodcastById((int) $params[0])) instanceof Podcast
        ) {
            return $this->{$method}($podcast);
        }

        throw PageNotFoundException::forPageNotFound();
    }

    public function list(): string
    {
        if (auth()->user()->can('podcasts.view')) {
            $data = [
                'podcasts' => new PodcastModel()
                    ->findAll(),
            ];
        } else {
            $data = [
                'podcasts' => get_user_podcasts(auth()->user()),
            ];
        }

        $this->setHtmlHead(lang('Podcast.all_podcasts'));
        return view('podcast/list', $data);
    }

    public function view(Podcast $podcast): string
    {
        $data = [
            'podcast' => $podcast,
        ];

        $this->setHtmlHead($podcast->title);
        replace_breadcrumb_params([
            0 => $podcast->at_handle,
        ]);
        return view('podcast/view', $data);
    }

    public function analyticsView(Podcast $podcast): string
    {
        $data = [
            'podcast' => $podcast,
        ];

        $this->setHtmlHead($podcast->title);
        replace_breadcrumb_params([
            0 => $podcast->at_handle,
        ]);
        return view('podcast/analytics/index', $data);
    }

    public function analyticsWebpagesView(Podcast $podcast): string
    {
        $data = [
            'podcast' => $podcast,
        ];

        $this->setHtmlHead($podcast->title);
        replace_breadcrumb_params([
            0 => $podcast->at_handle,
        ]);
        return view('podcast/analytics/webpages', $data);
    }

    public function analyticsLocationsView(Podcast $podcast): string
    {
        $data = [
            'podcast' => $podcast,
        ];

        $this->setHtmlHead($podcast->title);
        replace_breadcrumb_params([
            0 => $podcast->at_handle,
        ]);
        return view('podcast/analytics/locations', $data);
    }

    public function analyticsUniqueListenersView(Podcast $podcast): string
    {
        $data = [
            'podcast' => $podcast,
        ];

        $this->setHtmlHead($podcast->title);
        replace_breadcrumb_params([
            0 => $podcast->at_handle,
        ]);
        return view('podcast/analytics/unique_listeners', $data);
    }

    public function analyticsListeningTimeView(Podcast $podcast): string
    {
        $data = [
            'podcast' => $podcast,
        ];

        $this->setHtmlHead($podcast->title);
        replace_breadcrumb_params([
            0 => $podcast->at_handle,
        ]);
        return view('podcast/analytics/listening_time', $data);
    }

    public function analyticsTimePeriodsView(Podcast $podcast): string
    {
        $data = [
            'podcast' => $podcast,
        ];

        $this->setHtmlHead($podcast->title);
        replace_breadcrumb_params([
            0 => $podcast->at_handle,
        ]);
        return view('podcast/analytics/time_periods', $data);
    }

    public function analyticsPlayersView(Podcast $podcast): string
    {
        $data = [
            'podcast' => $podcast,
        ];

        $this->setHtmlHead($podcast->title);
        replace_breadcrumb_params([
            0 => $podcast->at_handle,
        ]);
        return view('podcast/analytics/players', $data);
    }

    public function createView(): string
    {
        helper(['form', 'misc']);

        $languageOptions = new LanguageModel()
            ->getLanguageOptions();
        $categoryOptions = new CategoryModel()
            ->getCategoryOptions();

        $data = [
            'languageOptions' => $languageOptions,
            'categoryOptions' => $categoryOptions,
            'browserLang'     => get_browser_language($this->request->getServer('HTTP_ACCEPT_LANGUAGE')),
        ];

        $this->setHtmlHead(lang('Podcast.create'));
        return view('podcast/create', $data);
    }

    public function createAction(): RedirectResponse
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
            'owner_name'  => $this->request->getPost('owner_name'),
            'owner_email' => $this->request->getPost('owner_email'),
            'publisher'   => $this->request->getPost('publisher'),
            'type'        => $this->request->getPost('type'),
            'copyright'   => $this->request->getPost('copyright'),
            'location'    => $this->request->getPost('location_name') === '' ? null : new Location(
                $this->request->getPost('location_name'),
            ),
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
        config('AuthGroups')
            ->generatePodcastAuthorizations($newPodcastId);
        add_podcast_group(auth()->user(), (int) $newPodcastId, setting('AuthGroups.mostPowerfulPodcastGroup'));

        // set Podcast categories
        new CategoryModel()
            ->setPodcastCategories((int) $newPodcastId, $this->request->getPost('other_categories') ?? []);

        $db->transComplete();

        return redirect()->route('podcast-view', [$newPodcastId])->with(
            'message',
            lang('Podcast.messages.createSuccess'),
        );
    }

    public function editView(Podcast $podcast): string
    {
        helper('form');

        $languageOptions = new LanguageModel()
            ->getLanguageOptions();
        $categoryOptions = new CategoryModel()
            ->getCategoryOptions();

        $data = [
            'podcast'         => $podcast,
            'languageOptions' => $languageOptions,
            'categoryOptions' => $categoryOptions,
        ];

        $this->setHtmlHead(lang('Podcast.edit'));
        replace_breadcrumb_params([
            0 => $podcast->at_handle,
        ]);
        return view('podcast/edit', $data);
    }

    public function editAction(Podcast $podcast): RedirectResponse
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

        $podcast->updated_by = (int) user_id();

        $podcast->title = $this->request->getPost('title');
        $podcast->description_markdown = $this->request->getPost('description');
        $podcast->setCover($this->request->getFile('cover'));
        $podcast->setBanner($this->request->getFile('banner'));

        $podcast->language_code = $this->request->getPost('language');
        $podcast->category_id = $this->request->getPost('category');
        $podcast->parental_advisory =
            $this->request->getPost('parental_advisory') !== 'undefined'
                ? $this->request->getPost('parental_advisory')
                : null;
        $podcast->publisher = $this->request->getPost('publisher');
        $podcast->owner_name = $this->request->getPost('owner_name');
        $podcast->owner_email = $this->request->getPost('owner_email');
        $podcast->type = $this->request->getPost('type');
        $podcast->copyright = $this->request->getPost('copyright');
        $podcast->location = $this->request->getPost('location_name') === '' ? null : new Location(
            $this->request->getPost('location_name'),
        );
        $podcast->new_feed_url = $this->request->getPost('new_feed_url') === '' ? null : $this->request->getPost(
            'new_feed_url',
        );

        $podcast->is_blocked = $this->request->getPost('block') === 'yes';
        $podcast->is_completed =
            $this->request->getPost('complete') === 'yes';
        $podcast->is_locked = $this->request->getPost('lock') === 'yes';
        $podcast->is_premium_by_default = $this->request->getPost('premium_by_default') === 'yes';

        // republish on websub hubs upon edit
        $podcast->is_published_on_hubs = false;

        $db = db_connect();

        $db->transStart();

        $podcastModel = new PodcastModel();
        if (! $podcastModel->update($podcast->id, $podcast)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $podcastModel->errors());
        }

        // set Podcast categories
        new CategoryModel()
            ->setPodcastCategories($podcast->id, $this->request->getPost('other_categories') ?? []);

        // New feed url redirect
        service('settings')
            ->set(
                'Podcast.redirect_to_new_feed',
                $this->request->getPost('redirect_to_new_feed') === 'yes',
                'podcast:' . $podcast->id,
            );

        $db->transComplete();

        return redirect()->route('podcast-edit', [$podcast->id])->with(
            'message',
            lang('Podcast.messages.editSuccess'),
        );
    }

    public function deleteBannerAction(Podcast $podcast): RedirectResponse
    {
        if (! $podcast->banner instanceof Image) {
            return redirect()->back();
        }

        $db = db_connect();

        $db->transStart();

        $mediaModel = new MediaModel();
        if (! $mediaModel->deleteMedia($podcast->banner)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $mediaModel->errors());
        }

        new PodcastModel()
            ->clearCache([
                'id' => $podcast->id,
            ]);

        // remove banner url from actor
        $actor = new ActorModel()
            ->getActorById($podcast->actor_id);

        if ($actor instanceof Actor) {
            $actor->cover_image_url = null;
            $actor->cover_image_mimetype = null;

            new ActorModel()
                ->update($actor->id, $actor);
        }

        $db->transComplete();

        return redirect()->back();
    }

    public function latestEpisodesView(int $limit, int $podcastId): string
    {
        $episodes = new EpisodeModel()
            ->where('podcast_id', $podcastId)
            ->orderBy('-`published_at`', '', false)
            ->orderBy('created_at', 'desc')
            ->findAll($limit);

        return view('podcast/latest_episodes', [
            'episodes' => $episodes,
            'podcast'  => new PodcastModel()
                ->getPodcastById($podcastId),
        ]);
    }

    public function deleteView(Podcast $podcast): string
    {
        helper(['form']);

        $data = [
            'podcast' => $podcast,
        ];

        $this->setHtmlHead(lang('Podcast.delete'));
        replace_breadcrumb_params([
            0 => $podcast->at_handle,
        ]);
        return view('podcast/delete', $data);
    }

    public function deleteAction(Podcast $podcast): RedirectResponse
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
        $podcastEpisodes = new EpisodeModel()
            ->where('podcast_id', $podcast->id)
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

        if (! $podcastModel->delete($podcast->id)) {
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
                'file' => $podcast->cover,
            ],
        ];

        if ($podcast->banner_id !== null) {
            $podcastMediaList[] =
            [
                'type' => 'banner',
                'file' => $podcast->banner,
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

        if (! $actorModel->delete($podcast->actor_id)) {
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
                'podcast_id' => $podcast->id,
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
        $folder = 'podcasts/' . $podcast->handle;
        if (! $fileManager->deleteAll($folder)) {
            return redirect()->route('podcast-list')
                ->with('message', lang('Podcast.messages.deleteSuccess', [
                    'podcast_handle' => $podcast->handle,
                ]))
                ->with('warning', lang('Podcast.messages.deletePodcastMediaFolderError', [
                    'folder_path' => $folder,
                ]));
        }

        return redirect()->route('podcast-list')
            ->with('message', lang('Podcast.messages.deleteSuccess', [
                'podcast_handle' => $podcast->handle,
            ]));
    }

    public function publishView(Podcast $podcast): string | RedirectResponse
    {
        helper(['form']);

        $data = [
            'podcast' => $podcast,
        ];

        $this->setHtmlHead(lang('Podcast.publish'));
        replace_breadcrumb_params([
            0 => $podcast->at_handle,
        ]);
        return view('podcast/publish', $data);
    }

    public function publishAction(Podcast $podcast): RedirectResponse
    {
        if ($podcast->publication_status !== 'not_published') {
            return redirect()->route('podcast-view', [$podcast->id])->with(
                'error',
                lang('Podcast.messages.publishError'),
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
                $podcast->published_at = Time::createFromFormat(
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
            $podcast->published_at = Time::now();
        }

        $message = $this->request->getPost('message');
        // only create post if message is not empty
        if ($message !== '') {
            $newPost = new Post([
                'actor_id'   => $podcast->actor_id,
                'message'    => $message,
                'created_by' => user_id(),
            ]);

            $newPost->published_at = $podcast->published_at;

            $postModel = new PostModel();
            if (! $postModel->addPost($newPost)) {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $postModel->errors());
            }
        }

        $episodes = new EpisodeModel()
            ->where('podcast_id', $podcast->id)
            ->where('published_at !=')
            ->findAll();

        foreach ($episodes as $episode) {
            $episode->published_at = $podcast->published_at->addSeconds(1);

            $episodeModel = new EpisodeModel();
            if (! $episodeModel->update($episode->id, $episode)) {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $episodeModel->errors());
            }

            $post = new PostModel()
                ->where('episode_id', $episode->id)
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
        if (! $podcastModel->update($podcast->id, $podcast)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $podcastModel->errors());
        }

        $db->transComplete();

        return redirect()->route('podcast-view', [$podcast->id]);
    }

    public function publishEditView(Podcast $podcast): string | RedirectResponse
    {
        helper(['form']);

        $data = [
            'podcast' => $podcast,
            'post'    => new PostModel()
                ->where([
                    'actor_id'   => $podcast->actor_id,
                    'episode_id' => null,
                ])
                ->first(),
        ];

        $this->setHtmlHead(lang('Podcast.publish_edit'));
        replace_breadcrumb_params([
            0 => $podcast->at_handle,
        ]);
        return view('podcast/publish_edit', $data);
    }

    public function publishEditAction(Podcast $podcast): RedirectResponse
    {
        if ($podcast->publication_status !== 'scheduled') {
            return redirect()->route('podcast-view', [$podcast->id])->with(
                'error',
                lang('Podcast.messages.publishEditError'),
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
                $podcast->published_at = Time::createFromFormat(
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
            $podcast->published_at = Time::now();
        }

        $post = new PostModel()
            ->where([
                'actor_id'   => $podcast->actor_id,
                'episode_id' => null,
            ])
            ->first();

        $newPostMessage = $this->request->getPost('message');

        if ($post instanceof Post) {
            if ($newPostMessage !== '') {
                // edit post if post exists and message is not empty
                $post->message = $newPostMessage;
                $post->published_at = $podcast->published_at;

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
                        'actor_id'   => $podcast->actor_id,
                        'episode_id' => null,
                    ])
                    ->first();
                $postModel->removePost($post);
            }
        } elseif ($newPostMessage !== '') {
            // create post if there is no post and message is not empty
            $newPost = new Post([
                'actor_id'   => $podcast->actor_id,
                'message'    => $newPostMessage,
                'created_by' => user_id(),
            ]);

            $newPost->published_at = $podcast->published_at;

            $postModel = new PostModel();
            if (! $postModel->addPost($newPost)) {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $postModel->errors());
            }
        }

        $episodes = new EpisodeModel()
            ->where('podcast_id', $podcast->id)
            ->where('published_at !=')
            ->findAll();

        foreach ($episodes as $episode) {
            $episode->published_at = $podcast->published_at->addSeconds(1);

            $episodeModel = new EpisodeModel();
            if (! $episodeModel->update($episode->id, $episode)) {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $episodeModel->errors());
            }

            $post = new PostModel()
                ->where('episode_id', $episode->id)
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
        if (! $podcastModel->update($podcast->id, $podcast)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $podcastModel->errors());
        }

        $db->transComplete();

        return redirect()->route('podcast-view', [$podcast->id]);
    }

    public function publishCancelAction(Podcast $podcast): RedirectResponse
    {
        if ($podcast->publication_status !== 'scheduled') {
            return redirect()->route('podcast-view', [$podcast->id]);
        }

        $db = db_connect();
        $db->transStart();

        $postModel = new PostModel();
        $post = $postModel
            ->where([
                'actor_id'   => $podcast->actor_id,
                'episode_id' => null,
            ])
            ->first();
        if ($post instanceof Post) {
            $postModel->removePost($post);
        }

        $episodes = new EpisodeModel()
            ->where('podcast_id', $podcast->id)
            ->where('published_at !=')
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

        $podcast->published_at = null;

        $podcastModel = new PodcastModel();
        if (! $podcastModel->update($podcast->id, $podcast)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $podcastModel->errors());
        }

        $db->transComplete();

        return redirect()->route('podcast-view', [$podcast->id])->with(
            'message',
            lang('Podcast.messages.publishCancelSuccess'),
        );
    }
}
