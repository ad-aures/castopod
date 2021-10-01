<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use App\Entities\Episode;
use App\Entities\EpisodeComment;
use App\Entities\Image;
use App\Entities\Location;
use App\Entities\Podcast;
use App\Entities\Post;
use App\Models\EpisodeCommentModel;
use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use App\Models\PostModel;
use App\Models\SoundbiteModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\I18n\Time;

class EpisodeController extends BaseController
{
    protected Podcast $podcast;

    protected Episode $episode;

    public function _remap(string $method, string ...$params): mixed
    {
        if (
            ($podcast = (new PodcastModel())->getPodcastById((int) $params[0])) === null
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->podcast = $podcast;

        if (count($params) > 1) {
            if (
                ! ($episode = (new EpisodeModel())
                    ->where([
                        'id' => $params[1],
                        'podcast_id' => $params[0],
                    ])
                    ->first())
            ) {
                throw PageNotFoundException::forPageNotFound();
            }

            $this->episode = $episode;

            unset($params[1]);
            unset($params[0]);
        }

        return $this->{$method}(...$params);
    }

    public function list(): string
    {
        $episodes = (new EpisodeModel())
            ->where('podcast_id', $this->podcast->id)
            ->orderBy('created_at', 'desc');

        $data = [
            'podcast' => $this->podcast,
            'episodes' => $episodes->paginate(10),
            'pager' => $episodes->pager,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
        ]);
        return view('episode/list', $data);
    }

    public function view(): string
    {
        $data = [
            'podcast' => $this->podcast,
            'episode' => $this->episode,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
            1 => $this->episode->title,
        ]);
        return view('episode/view', $data);
    }

    public function create(): string
    {
        helper(['form']);

        $data = [
            'podcast' => $this->podcast,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
        ]);
        return view('episode/create', $data);
    }

    public function attemptCreate(): RedirectResponse
    {
        $rules = [
            'audio_file' => 'uploaded[audio_file]|ext_in[audio_file,mp3,m4a]',
            'image' =>
                'is_image[image]|ext_in[image,jpg,png]|min_dims[image,1400,1400]|is_image_squared[image]',
            'transcript_file' =>
                'ext_in[transcript,txt,html,srt,json]|permit_empty',
            'chapters_file' => 'ext_in[chapters,json]|permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $image = null;
        $imageFile = $this->request->getFile('image');
        if ($imageFile !== null && $imageFile->isValid()) {
            $image = new Image($imageFile);
        }

        $newEpisode = new Episode([
            'podcast_id' => $this->podcast->id,
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'guid' => null,
            'audio_file' => $this->request->getFile('audio_file'),
            'description_markdown' => $this->request->getPost('description'),
            'image' => $image,
            'location' => $this->request->getPost('location_name') === '' ? null : new Location($this->request->getPost(
                'location_name'
            )),
            'transcript' => $this->request->getFile('transcript'),
            'chapters' => $this->request->getFile('chapters'),
            'parental_advisory' =>
                $this->request->getPost('parental_advisory') !== 'undefined'
                    ? $this->request->getPost('parental_advisory')
                    : null,
            'number' => $this->request->getPost('episode_number')
                ? $this->request->getPost('episode_number')
                : null,
            'season_number' => $this->request->getPost('season_number')
                ? $this->request->getPost('season_number')
                : null,
            'type' => $this->request->getPost('type'),
            'is_blocked' => $this->request->getPost('block') === 'yes',
            'custom_rss_string' => $this->request->getPost('custom_rss'),
            'created_by' => user_id(),
            'updated_by' => user_id(),
            'published_at' => null,
        ]);

        $transcriptChoice = $this->request->getPost('transcript-choice');
        if (
            $transcriptChoice === 'upload-file'
            && ($transcriptFile = $this->request->getFile('transcript_file'))
            && $transcriptFile->isValid()
        ) {
            $newEpisode->transcript_file = $transcriptFile;
        } elseif ($transcriptChoice === 'remote-url') {
            $newEpisode->transcript_file_remote_url = $this->request->getPost(
                'transcript_file_remote_url'
            ) === '' ? null : $this->request->getPost('transcript_file_remote_url');
        }

        $chaptersChoice = $this->request->getPost('chapters-choice');
        if (
            $chaptersChoice === 'upload-file'
            && ($chaptersFile = $this->request->getFile('chapters_file'))
            && $chaptersFile->isValid()
        ) {
            $newEpisode->chapters_file = $chaptersFile;
        } elseif ($chaptersChoice === 'remote-url') {
            $newEpisode->chapters_file_remote_url = $this->request->getPost(
                'chapters_file_remote_url'
            ) === '' ? null : $this->request->getPost('chapters_file_remote_url');
        }

        $episodeModel = new EpisodeModel();

        if (! ($newEpisodeId = $episodeModel->insert($newEpisode, true))) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        // update podcast's episode_description_footer_markdown if changed
        $this->podcast->episode_description_footer_markdown = $this->request->getPost(
            'description_footer'
        ) === '' ? null : $this->request->getPost('description_footer');

        if ($this->podcast->hasChanged('episode_description_footer_markdown')) {
            $podcastModel = new PodcastModel();

            if (! $podcastModel->update($this->podcast->id, $this->podcast)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $podcastModel->errors());
            }
        }

        return redirect()->route('episode-view', [$this->podcast->id, $newEpisodeId]);
    }

    public function edit(): string
    {
        helper(['form']);

        $data = [
            'podcast' => $this->podcast,
            'episode' => $this->episode,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
            1 => $this->episode->title,
        ]);
        return view('episode/edit', $data);
    }

    public function attemptEdit(): RedirectResponse
    {
        $rules = [
            'audio_file' =>
                'uploaded[audio_file]|ext_in[audio_file,mp3,m4a]|permit_empty',
            'image' =>
                'is_image[image]|ext_in[image,jpg,png]|min_dims[image,1400,1400]|is_image_squared[image]',
            'transcript_file' =>
                'ext_in[transcript_file,txt,html,srt,json]|permit_empty',
            'chapters_file' => 'ext_in[chapters_file,json]|permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->episode->title = $this->request->getPost('title');
        $this->episode->slug = $this->request->getPost('slug');
        $this->episode->description_markdown = $this->request->getPost('description');
        $this->episode->location = $this->request->getPost('location_name') === '' ? null : new Location(
            $this->request->getPost('location_name')
        );
        $this->episode->parental_advisory =
            $this->request->getPost('parental_advisory') !== 'undefined'
                ? $this->request->getPost('parental_advisory')
                : null;
        $this->episode->number = $this->request->getPost('episode_number')
            ? $this->request->getPost('episode_number')
            : null;
        $this->episode->season_number = $this->request->getPost('season_number')
            ? $this->request->getPost('season_number')
            : null;
        $this->episode->type = $this->request->getPost('type');
        $this->episode->is_blocked = $this->request->getPost('block') === 'yes';
        $this->episode->custom_rss_string = $this->request->getPost('custom_rss');

        $this->episode->updated_by = (int) user_id();

        $audioFile = $this->request->getFile('audio_file');
        if ($audioFile !== null && $audioFile->isValid()) {
            $this->episode->audio_file = $audioFile;
        }

        $imageFile = $this->request->getFile('image');
        if ($imageFile !== null && $imageFile->isValid()) {
            $this->episode->image = new Image($imageFile);
        }

        $transcriptChoice = $this->request->getPost('transcript-choice');
        if ($transcriptChoice === 'upload-file') {
            $transcriptFile = $this->request->getFile('transcript_file');
            if ($transcriptFile !== null && $transcriptFile->isValid()) {
                $this->episode->transcript_file = $transcriptFile;
                $this->episode->transcript_file_remote_url = null;
            }
        } elseif ($transcriptChoice === 'remote-url') {
            if (
                ($transcriptFileRemoteUrl = $this->request->getPost('transcript_file_remote_url')) &&
                (($transcriptFile = $this->episode->transcript_file) !== null)
            ) {
                unlink((string) $transcriptFile);
                $this->episode->transcript_file_path = null;
            }
            $this->episode->transcript_file_remote_url = $transcriptFileRemoteUrl === '' ? null : $transcriptFileRemoteUrl;
        }

        $chaptersChoice = $this->request->getPost('chapters-choice');
        if ($chaptersChoice === 'upload-file') {
            $chaptersFile = $this->request->getFile('chapters_file');
            if ($chaptersFile !== null && $chaptersFile->isValid()) {
                $this->episode->chapters_file = $chaptersFile;
                $this->episode->chapters_file_remote_url = null;
            }
        } elseif ($chaptersChoice === 'remote-url') {
            if (
                ($chaptersFileRemoteUrl = $this->request->getPost('chapters_file_remote_url')) &&
                (($chaptersFile = $this->episode->chapters_file) !== null)
            ) {
                unlink((string) $chaptersFile);
                $this->episode->chapters_file_path = null;
            }
            $this->episode->chapters_file_remote_url = $chaptersFileRemoteUrl === '' ? null : $chaptersFileRemoteUrl;
        }

        $db = db_connect();
        $db->transStart();

        $episodeModel = new EpisodeModel();

        if (! $episodeModel->update($this->episode->id, $this->episode)) {
            $db->transRollback();

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        // update podcast's episode_description_footer_markdown if changed
        $this->podcast->episode_description_footer_markdown = $this->request->getPost(
            'description_footer'
        ) === '' ? null : $this->request->getPost('description_footer');

        if ($this->podcast->hasChanged('episode_description_footer_markdown')) {
            $podcastModel = new PodcastModel();
            if (! $podcastModel->update($this->podcast->id, $this->podcast)) {
                $db->transRollback();

                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $podcastModel->errors());
            }
        }

        $db->transComplete();

        return redirect()->route('episode-view', [$this->podcast->id, $this->episode->id]);
    }

    public function transcriptDelete(): RedirectResponse
    {
        unlink((string) $this->episode->transcript_file);
        $this->episode->transcript_file_path = null;

        $episodeModel = new EpisodeModel();

        if (! $episodeModel->update($this->episode->id, $this->episode)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        return redirect()->back();
    }

    public function chaptersDelete(): RedirectResponse
    {
        unlink((string) $this->episode->chapters_file);
        $this->episode->chapters_file_path = null;

        $episodeModel = new EpisodeModel();

        if (! $episodeModel->update($this->episode->id, $this->episode)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        return redirect()->back();
    }

    public function publish(): string | RedirectResponse
    {
        if ($this->episode->publication_status === 'not_published') {
            helper(['form']);

            $data = [
                'podcast' => $this->podcast,
                'episode' => $this->episode,
            ];

            replace_breadcrumb_params([
                0 => $this->podcast->title,
                1 => $this->episode->title,
            ]);
            return view('episode/publish', $data);
        }

        return redirect()->route('episode-view', [$this->podcast->id, $this->episode->id])->with(
            'error',
            lang('Episode.publish_error')
        );
    }

    public function attemptPublish(): RedirectResponse
    {
        $rules = [
            'publication_method' => 'required',
            'scheduled_publication_date' =>
                'valid_date[Y-m-d H:i]|permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $db = db_connect();
        $db->transStart();

        $newPost = new Post([
            'actor_id' => $this->podcast->actor_id,
            'episode_id' => $this->episode->id,
            'message' => $this->request->getPost('message'),
            'created_by' => user_id(),
        ]);

        $publishMethod = $this->request->getPost('publication_method');
        if ($publishMethod === 'schedule') {
            $scheduledPublicationDate = $this->request->getPost('scheduled_publication_date');
            if ($scheduledPublicationDate) {
                $this->episode->published_at = Time::createFromFormat(
                    'Y-m-d H:i',
                    $scheduledPublicationDate,
                    $this->request->getPost('client_timezone'),
                )->setTimezone('UTC');
            } else {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Schedule date must be set!');
            }
        } else {
            $this->episode->published_at = Time::now();
        }

        $newPost->published_at = $this->episode->published_at;

        $postModel = new PostModel();
        if (! $postModel->addPost($newPost)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $postModel->errors());
        }

        $episodeModel = new EpisodeModel();
        if (! $episodeModel->update($this->episode->id, $this->episode)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        $db->transComplete();

        return redirect()->route('episode-view', [$this->podcast->id, $this->episode->id]);
    }

    public function publishEdit(): string | RedirectResponse
    {
        if ($this->episode->publication_status === 'scheduled') {
            helper(['form']);

            $data = [
                'podcast' => $this->podcast,
                'episode' => $this->episode,
                'post' => (new PostModel())
                    ->where([
                        'actor_id' => $this->podcast->actor_id,
                        'episode_id' => $this->episode->id,
                    ])
                    ->first(),
            ];

            replace_breadcrumb_params([
                0 => $this->podcast->title,
                1 => $this->episode->title,
            ]);
            return view('episode/publish_edit', $data);
        }

        return redirect()->route('episode-view', [$this->podcast->id, $this->episode->id])->with(
            'error',
            lang('Episode.publish_edit_error')
        );
    }

    public function attemptPublishEdit(): RedirectResponse
    {
        $rules = [
            'post_id' => 'required',
            'publication_method' => 'required',
            'scheduled_publication_date' =>
                'valid_date[Y-m-d H:i]|permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $db = db_connect();
        $db->transStart();

        $publishMethod = $this->request->getPost('publication_method');
        if ($publishMethod === 'schedule') {
            $scheduledPublicationDate = $this->request->getPost('scheduled_publication_date');
            if ($scheduledPublicationDate) {
                $this->episode->published_at = Time::createFromFormat(
                    'Y-m-d H:i',
                    $scheduledPublicationDate,
                    $this->request->getPost('client_timezone'),
                )->setTimezone('UTC');
            } else {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Schedule date must be set!');
            }
        } else {
            $this->episode->published_at = Time::now();
        }

        $post = (new PostModel())->getPostById($this->request->getPost('post_id'));

        if ($post !== null) {
            $post->message = $this->request->getPost('message');
            $post->published_at = $this->episode->published_at;

            $postModel = new PostModel();
            if (! $postModel->editPost($post)) {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $postModel->errors());
            }
        }

        $episodeModel = new EpisodeModel();
        if (! $episodeModel->update($this->episode->id, $this->episode)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        $db->transComplete();

        return redirect()->route('episode-view', [$this->podcast->id, $this->episode->id]);
    }

    public function publishCancel(): RedirectResponse
    {
        if ($this->episode->publication_status === 'scheduled') {
            $db = db_connect();
            $db->transStart();

            $postModel = new PostModel();
            $post = $postModel
                ->where([
                    'actor_id' => $this->podcast->actor_id,
                    'episode_id' => $this->episode->id,
                ])
                ->first();
            $postModel->removePost($post);

            $this->episode->published_at = null;

            $episodeModel = new EpisodeModel();
            if (! $episodeModel->update($this->episode->id, $this->episode)) {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $episodeModel->errors());
            }

            $db->transComplete();

            return redirect()->route('episode-view', [$this->podcast->id, $this->episode->id]);
        }

        return redirect()->route('episode-view', [$this->podcast->id, $this->episode->id])->with(
            'error',
            lang('Episode.publish_cancel_error')
        );
    }

    public function unpublish(): string | RedirectResponse
    {
        if ($this->episode->publication_status === 'published') {
            helper(['form']);

            $data = [
                'podcast' => $this->podcast,
                'episode' => $this->episode,
            ];

            replace_breadcrumb_params([
                0 => $this->podcast->title,
                1 => $this->episode->title,
            ]);
            return view('episode/unpublish', $data);
        }

        return redirect()->route('episode-view', [$this->podcast->id, $this->episode->id])->with(
            'error',
            lang('Episode.unpublish_error')
        );
    }

    public function attemptUnpublish(): RedirectResponse
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

        $allPostsLinkedToEpisode = (new PostModel())
            ->where([
                'episode_id' => $this->episode->id,
            ])
            ->findAll();
        foreach ($allPostsLinkedToEpisode as $post) {
            (new PostModel())->removePost($post);
        }

        // set episode published_at to null to unpublish
        $this->episode->published_at = null;

        $episodeModel = new EpisodeModel();
        if (! $episodeModel->update($this->episode->id, $this->episode)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        $db->transComplete();

        return redirect()->route('episode-view', [$this->podcast->id, $this->episode->id]);
    }

    public function delete(): string
    {
        helper(['form']);

        $data = [
            'podcast' => $this->podcast,
            'episode' => $this->episode,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
            1 => $this->episode->title,
        ]);
        return view('episode/delete', $data);
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

        $allPostsLinkedToEpisode = (new PostModel())
            ->where([
                'episode_id' => $this->episode->id,
            ])
            ->findAll();
        foreach ($allPostsLinkedToEpisode as $post) {
            (new PostModel())->removePost($post);
        }

        // set episode published_at to null to unpublish before deletion
        $this->episode->published_at = null;

        $episodeModel = new EpisodeModel();
        if (! $episodeModel->update($this->episode->id, $this->episode)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        $episodeModel->delete($this->episode->id);

        $db->transComplete();

        return redirect()->route('episode-list', [$this->podcast->id]);
    }

    public function soundbitesEdit(): string
    {
        helper(['form']);

        $data = [
            'podcast' => $this->podcast,
            'episode' => $this->episode,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
            1 => $this->episode->title,
        ]);
        return view('episode/soundbites', $data);
    }

    public function soundbitesAttemptEdit(): RedirectResponse
    {
        $soundbites = $this->request->getPost('soundbites');
        $rules = [
            'soundbites.0.start_time' =>
                'permit_empty|required_with[soundbites.0.duration]|decimal|greater_than_equal_to[0]',
            'soundbites.0.duration' =>
                'permit_empty|required_with[soundbites.0.start_time]|decimal|greater_than_equal_to[0]',
        ];
        foreach (array_keys($soundbites) as $soundbite_id) {
            $rules += [
                "soundbites.{$soundbite_id}.start_time" => 'required|decimal|greater_than_equal_to[0]',
                "soundbites.{$soundbite_id}.duration" => 'required|decimal|greater_than_equal_to[0]',
            ];
        }

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        foreach ($soundbites as $soundbite_id => $soundbite) {
            $data = [
                'podcast_id' => $this->podcast->id,
                'episode_id' => $this->episode->id,
                'start_time' => (float) $soundbite['start_time'],
                'duration' => (float) $soundbite['duration'],
                'label' => $soundbite['label'],
                'updated_by' => user_id(),
            ];
            if ($soundbite_id === 0) {
                $data += [
                    'created_by' => user_id(),
                ];
            } else {
                $data += [
                    'id' => $soundbite_id,
                ];
            }

            $soundbiteModel = new SoundbiteModel();
            if (! $soundbiteModel->save($data)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $soundbiteModel->errors());
            }
        }

        return redirect()->route('soundbites-edit', [$this->podcast->id, $this->episode->id]);
    }

    public function soundbiteDelete(string $soundbiteId): RedirectResponse
    {
        (new SoundbiteModel())->deleteSoundbite($this->podcast->id, $this->episode->id, (int) $soundbiteId);

        return redirect()->route('soundbites-edit', [$this->podcast->id, $this->episode->id]);
    }

    public function embeddablePlayer(): string
    {
        helper(['form']);

        $data = [
            'podcast' => $this->podcast,
            'episode' => $this->episode,
            'themes' => EpisodeModel::$themes,
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
            1 => $this->episode->title,
        ]);
        return view('episode/embeddable_player', $data);
    }

    public function attemptCommentCreate(): RedirectResponse
    {
        $rules = [
            'message' => 'required|max_length[500]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $message = $this->request->getPost('message');

        $newComment = new EpisodeComment([
            'actor_id' => interact_as_actor_id(),
            'episode_id' => $this->episode->id,
            'message' => $message,
            'created_at' => new Time('now'),
            'created_by' => user_id(),
        ]);

        $commentModel = new EpisodeCommentModel();
        if (
            ! $commentModel->addComment($newComment, true)
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $commentModel->errors());
        }

        // Comment has been successfully created
        return redirect()->back();
    }

    public function attemptCommentReply(string $commentId): RedirectResponse
    {
        $rules = [
            'message' => 'required|max_length[500]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $message = $this->request->getPost('message');

        $newReply = new EpisodeComment([
            'actor_id' => interact_as_actor_id(),
            'episode_id' => $this->episode->id,
            'message' => $message,
            'in_reply_to_id' => $commentId,
            'created_at' => new Time('now'),
            'created_by' => user_id(),
        ]);

        $commentModel = new EpisodeCommentModel();
        if (
            ! $commentModel->addComment($newReply, true)
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $commentModel->errors());
        }

        // Reply has been successfully created
        return redirect()->back();
    }
}
