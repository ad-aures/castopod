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
use App\Entities\Location;
use App\Entities\Podcast;
use App\Entities\Post;
use App\Models\EpisodeCommentModel;
use App\Models\EpisodeModel;
use App\Models\MediaModel;
use App\Models\PodcastModel;
use App\Models\PostModel;
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
            'cover' =>
                'is_image[cover]|ext_in[cover,jpg,png]|min_dims[cover,1400,1400]|is_image_ratio[cover,1,1]',
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

        $db = db_connect();
        $db->transStart();

        $newEpisode = new Episode([
            'podcast_id' => $this->podcast->id,
            'title' => $this->request->getPost('title'),
            'slug' => $this->request->getPost('slug'),
            'guid' => null,
            'audio' => $this->request->getFile('audio_file'),
            'cover' => $this->request->getFile('cover'),
            'description_markdown' => $this->request->getPost('description'),
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
                ? (int) $this->request->getPost('episode_number')
                : null,
            'season_number' => $this->request->getPost('season_number')
                ? (int) $this->request->getPost('season_number')
                : null,
            'type' => $this->request->getPost('type'),
            'is_blocked' => $this->request->getPost('block') === 'yes',
            'custom_rss_string' => $this->request->getPost('custom_rss'),
            'created_by' => user_id(),
            'updated_by' => user_id(),
            'published_at' => null,
        ]);

        $transcriptChoice = $this->request->getPost('transcript-choice');
        if ($transcriptChoice === 'upload-file') {
            $newEpisode->setTranscript($this->request->getFile('transcript_file'));
        } elseif ($transcriptChoice === 'remote-url') {
            $newEpisode->transcript_remote_url = $this->request->getPost(
                'transcript_remote_url'
            ) === '' ? null : $this->request->getPost('transcript_remote_url');
        }

        $chaptersChoice = $this->request->getPost('chapters-choice');
        if ($chaptersChoice === 'upload-file') {
            $newEpisode->setChapters($this->request->getFile('chapters_file'));
        } elseif ($chaptersChoice === 'remote-url') {
            $newEpisode->chapters_remote_url = $this->request->getPost(
                'chapters_remote_url'
            ) === '' ? null : $this->request->getPost('chapters_remote_url');
        }

        $episodeModel = new EpisodeModel();
        if (! ($newEpisodeId = $episodeModel->insert($newEpisode, true))) {
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

        return redirect()->route('episode-view', [$this->podcast->id, $newEpisodeId])->with(
            'message',
            lang('Episode.messages.createSuccess')
        );
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
            'cover' =>
                'is_image[cover]|ext_in[cover,jpg,png]|min_dims[cover,1400,1400]|is_image_ratio[cover,1,1]',
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
        $this->episode->setAudio($this->request->getFile('audio_file'));
        $this->episode->setCover($this->request->getFile('cover'));

        $transcriptChoice = $this->request->getPost('transcript-choice');
        if ($transcriptChoice === 'upload-file') {
            $transcriptFile = $this->request->getFile('transcript_file');
            if ($transcriptFile !== null && $transcriptFile->isValid()) {
                $this->episode->setTranscript($transcriptFile);
                $this->episode->transcript_remote_url = null;
            }
        } elseif ($transcriptChoice === 'remote-url') {
            if (
                ($transcriptRemoteUrl = $this->request->getPost('transcript_remote_url')) &&
                (($transcriptFile = $this->episode->transcript_id) !== null)
            ) {
                (new MediaModel())->deleteMedia($this->episode->transcript);
            }
            $this->episode->transcript_remote_url = $transcriptRemoteUrl === '' ? null : $transcriptRemoteUrl;
        }

        $chaptersChoice = $this->request->getPost('chapters-choice');
        if ($chaptersChoice === 'upload-file') {
            $chaptersFile = $this->request->getFile('chapters_file');
            if ($chaptersFile !== null && $chaptersFile->isValid()) {
                $this->episode->setChapters($chaptersFile);
                $this->episode->chapters_remote_url = null;
            }
        } elseif ($chaptersChoice === 'remote-url') {
            if (
                ($chaptersRemoteUrl = $this->request->getPost('chapters_remote_url')) &&
                (($chaptersFile = $this->episode->chapters) !== null)
            ) {
                (new MediaModel())->deleteMedia($this->episode->chapters);
            }
            $this->episode->chapters_remote_url = $chaptersRemoteUrl === '' ? null : $chaptersRemoteUrl;
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

        return redirect()->route('episode-edit', [$this->podcast->id, $this->episode->id])->with(
            'message',
            lang('Episode.messages.editSuccess')
        );
    }

    public function transcriptDelete(): RedirectResponse
    {
        if ($this->episode->transcript === null) {
            return redirect()->back();
        }

        $mediaModel = new MediaModel();
        if (! $mediaModel->deleteMedia($this->episode->transcript)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $mediaModel->errors());
        }

        return redirect()->back();
    }

    public function chaptersDelete(): RedirectResponse
    {
        if ($this->episode->chapters === null) {
            return redirect()->back();
        }

        $mediaModel = new MediaModel();
        if (! $mediaModel->deleteMedia($this->episode->chapters)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $mediaModel->errors());
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

        $episodeModel = new EpisodeModel();
        if ($this->episode->published_at !== null) {
            // if episode is published, set episode published_at to null to unpublish before deletion
            $this->episode->published_at = null;

            if (! $episodeModel->update($this->episode->id, $this->episode)) {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $episodeModel->errors());
            }
        }

        $episodeModel->delete($this->episode->id);

        $db->transComplete();

        return redirect()->route('episode-list', [$this->podcast->id]);
    }

    public function embed(): string
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
        return view('episode/embed', $data);
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
