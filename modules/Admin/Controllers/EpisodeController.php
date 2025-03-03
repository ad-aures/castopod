<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
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
use App\Models\PodcastModel;
use App\Models\PostModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\I18n\Time;
use Modules\Media\Entities\Chapters;
use Modules\Media\Entities\Transcript;
use Modules\Media\Models\MediaModel;

class EpisodeController extends BaseController
{
    protected Podcast $podcast;

    protected Episode $episode;

    public function _remap(string $method, string ...$params): mixed
    {
        if ($params === []) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (count($params) === 1) {
            if (! ($podcast = (new PodcastModel())->getPodcastById((int) $params[0])) instanceof Podcast) {
                throw PageNotFoundException::forPageNotFound();
            }

            return $this->{$method}($podcast);
        }

        if (
            ! ($episode = (new EpisodeModel())->getEpisodeById((int) $params[1])) instanceof Episode
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        unset($params[0]);
        unset($params[1]);

        return $this->{$method}($episode, ...$params);
    }

    public function list(Podcast $podcast): string
    {
        /** @var ?string $query */
        $query = $this->request->getGet('q');

        $episodeModel = new EpisodeModel();
        if ($query !== null && $query !== '') {
            // Default value for MySQL Full-Text Search's minimum length of words is 4.
            // Use LIKE operator as a fallback.
            if (strlen($query) < 4) {
                $episodes = $episodeModel
                    ->where('podcast_id', $podcast->id)
                    ->like('title', $episodeModel->db->escapeLikeString($query))
                    ->orLike('description_markdown', $episodeModel->db->escapeLikeString($query))
                    ->orLike('slug', $episodeModel->db->escapeLikeString($query))
                    ->orLike('location_name', $episodeModel->db->escapeLikeString($query))
                    ->orderBy('-`published_at`', '', false)
                    ->orderBy('created_at', 'desc');
            } else {
                $episodes = $episodeModel
                    ->where('podcast_id', $podcast->id)
                    ->where(
                        "MATCH (title, description_markdown, slug, location_name) AGAINST ('{$episodeModel->db->escapeString(
                            $query,
                        )}')",
                    );
            }
        } else {
            $episodes = $episodeModel
                ->where('podcast_id', $podcast->id)
                ->orderBy('-`published_at`', '', false)
                ->orderBy('created_at', 'desc');
        }

        helper('form');
        $data = [
            'podcast'  => $podcast,
            'episodes' => $episodes->paginate(10),
            'pager'    => $episodes->pager,
            'query'    => $query,
        ];

        $this->setHtmlHead(lang('Episode.all_podcast_episodes'));
        replace_breadcrumb_params([
            0 => $podcast->at_handle,
        ]);
        return view('episode/list', $data);
    }

    public function view(Episode $episode): string
    {
        $data = [
            'podcast' => $episode->podcast,
            'episode' => $episode,
        ];

        $this->setHtmlHead($episode->title);
        replace_breadcrumb_params([
            0 => $episode->podcast->at_handle,
            1 => $episode->title,
        ]);
        return view('episode/view', $data);
    }

    public function createView(Podcast $podcast): string
    {
        helper(['form']);

        $currentSeasonNumber = (new EpisodeModel())->getCurrentSeasonNumber($podcast->id);
        $data = [
            'podcast'             => $podcast,
            'currentSeasonNumber' => $currentSeasonNumber,
            'nextEpisodeNumber'   => (new EpisodeModel())->getNextEpisodeNumber($podcast->id, $currentSeasonNumber),
        ];

        $this->setHtmlHead(lang('Episode.create'));
        replace_breadcrumb_params([
            0 => $podcast->at_handle,
        ]);
        return view('episode/create', $data);
    }

    public function createAction(Podcast $podcast): RedirectResponse
    {
        $rules = [
            'title'           => 'required',
            'slug'            => 'required|max_length[128]',
            'audio_file'      => 'uploaded[audio_file]|ext_in[audio_file,mp3,m4a]',
            'cover'           => 'is_image[cover]|ext_in[cover,jpg,jpeg,png]|min_dims[cover,1400,1400]|is_image_ratio[cover,1,1]',
            'transcript_file' => 'ext_in[transcript_file,srt,vtt]',
            'chapters_file'   => 'ext_in[chapters_file,json]|is_json[chapters_file]',
        ];

        if ($podcast->type === 'serial' && $this->request->getPost('type') === 'full') {
            $rules['episode_number'] = 'required';
        }

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        if ((new EpisodeModel())
            ->where([
                'slug'       => $validData['slug'],
                'podcast_id' => $podcast->id,
            ])
            ->first() instanceof Episode) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', lang('Episode.messages.sameSlugError'));
        }

        $newEpisode = new Episode([
            'created_by'           => user_id(),
            'updated_by'           => user_id(),
            'podcast_id'           => $podcast->id,
            'title'                => $this->request->getPost('title'),
            'slug'                 => $this->request->getPost('slug'),
            'guid'                 => null,
            'audio'                => $this->request->getFile('audio_file'),
            'cover'                => $this->request->getFile('cover'),
            'description_markdown' => $this->request->getPost('description'),
            'location'             => $this->request->getPost('location_name') === '' ? null : new Location(
                $this->request->getPost('location_name'),
            ),
            'transcript'        => $this->request->getFile('transcript'),
            'chapters'          => $this->request->getFile('chapters'),
            'parental_advisory' => $this->request->getPost('parental_advisory') !== 'undefined'
                    ? $this->request->getPost('parental_advisory')
                    : null,
            'number' => $this->request->getPost('episode_number')
                ? (int) $this->request->getPost('episode_number')
                : null,
            'season_number' => $this->request->getPost('season_number')
                ? (int) $this->request->getPost('season_number')
                : null,
            'type'         => $this->request->getPost('type'),
            'is_blocked'   => $this->request->getPost('block') === 'yes',
            'is_premium'   => $this->request->getPost('premium') === 'yes',
            'published_at' => null,
        ]);

        $transcriptChoice = $this->request->getPost('transcript-choice');
        if ($transcriptChoice === 'upload-file') {
            $newEpisode->setTranscript($this->request->getFile('transcript_file'));
        } elseif ($transcriptChoice === 'remote-url') {
            $newEpisode->transcript_remote_url = $this->request->getPost(
                'transcript_remote_url',
            ) === '' ? null : $this->request->getPost('transcript_remote_url');
        }

        $chaptersChoice = $this->request->getPost('chapters-choice');
        if ($chaptersChoice === 'upload-file') {
            $newEpisode->setChapters($this->request->getFile('chapters_file'));
        } elseif ($chaptersChoice === 'remote-url') {
            $newEpisode->chapters_remote_url = $this->request->getPost(
                'chapters_remote_url',
            ) === '' ? null : $this->request->getPost('chapters_remote_url');
        }

        $episodeModel = new EpisodeModel();
        if (! ($newEpisodeId = $episodeModel->insert($newEpisode, true))) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        return redirect()->route('episode-view', [$podcast->id, $newEpisodeId])->with(
            'message',
            lang('Episode.messages.createSuccess'),
        );
    }

    public function editView(Episode $episode): string
    {
        helper(['form']);

        $data = [
            'podcast' => $episode->podcast,
            'episode' => $episode,
        ];

        $this->setHtmlHead(lang('Episode.edit'));
        replace_breadcrumb_params([
            0 => $episode->podcast->at_handle,
            1 => $episode->title,
        ]);
        return view('episode/edit', $data);
    }

    public function editAction(Episode $episode): RedirectResponse
    {
        $rules = [
            'title'           => 'required',
            'slug'            => 'required|max_length[128]',
            'audio_file'      => 'ext_in[audio_file,mp3,m4a]',
            'cover'           => 'is_image[cover]|ext_in[cover,jpg,jpeg,png]|min_dims[cover,1400,1400]|is_image_ratio[cover,1,1]',
            'transcript_file' => 'ext_in[transcript_file,srt,vtt]',
            'chapters_file'   => 'ext_in[chapters_file,json]|is_json[chapters_file]',
        ];

        if ($episode->podcast->type === 'serial' && $this->request->getPost('type') === 'full') {
            $rules['episode_number'] = 'required';
        }

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        $episode->title = $this->request->getPost('title');
        $episode->slug = $validData['slug'];
        $episode->description_markdown = $this->request->getPost('description');
        $episode->location = $this->request->getPost('location_name') === '' ? null : new Location(
            $this->request->getPost('location_name'),
        );
        $episode->parental_advisory =
            $this->request->getPost('parental_advisory') !== 'undefined'
                ? $this->request->getPost('parental_advisory')
                : null;
        $episode->number = $this->request->getPost('episode_number') ?: null;
        $episode->season_number = $this->request->getPost('season_number') ?: null;
        $episode->type = $this->request->getPost('type');
        $episode->is_blocked = $this->request->getPost('block') === 'yes';
        $episode->is_premium = $this->request->getPost('premium') === 'yes';

        $episode->updated_by = (int) user_id();
        $episode->setAudio($this->request->getFile('audio_file'));
        $episode->setCover($this->request->getFile('cover'));

        // republish on websub hubs upon edit
        $episode->is_published_on_hubs = false;

        $transcriptChoice = $this->request->getPost('transcript-choice');
        if ($transcriptChoice === 'upload-file') {
            $transcriptFile = $this->request->getFile('transcript_file');
            if ($transcriptFile instanceof UploadedFile && $transcriptFile->isValid()) {
                $episode->setTranscript($transcriptFile);
                $episode->transcript_remote_url = null;
            }
        } elseif ($transcriptChoice === 'remote-url') {
            if (
                ($transcriptRemoteUrl = $this->request->getPost('transcript_remote_url')) &&
                (($transcriptFile = $episode->transcript_id) !== null)
            ) {
                (new MediaModel())->deleteMedia($episode->transcript);
            }

            $episode->transcript_remote_url = $transcriptRemoteUrl === '' ? null : $transcriptRemoteUrl;
        }

        $chaptersChoice = $this->request->getPost('chapters-choice');
        if ($chaptersChoice === 'upload-file') {
            $chaptersFile = $this->request->getFile('chapters_file');
            if ($chaptersFile instanceof UploadedFile && $chaptersFile->isValid()) {
                $episode->setChapters($chaptersFile);
                $episode->chapters_remote_url = null;
            }
        } elseif ($chaptersChoice === 'remote-url') {
            if (
                ($chaptersRemoteUrl = $this->request->getPost('chapters_remote_url')) &&
                (($chaptersFile = $episode->chapters) instanceof Chapters)
            ) {
                (new MediaModel())->deleteMedia($episode->chapters);
            }

            $episode->chapters_remote_url = $chaptersRemoteUrl === '' ? null : $chaptersRemoteUrl;
        }

        $episodeModel = new EpisodeModel();
        if (! $episodeModel->update($episode->id, $episode)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        return redirect()->route('episode-edit', [$episode->podcast_id, $episode->id])->with(
            'message',
            lang('Episode.messages.editSuccess'),
        );
    }

    public function transcriptDelete(Episode $episode): RedirectResponse
    {
        if (! $episode->transcript instanceof Transcript) {
            return redirect()->back();
        }

        $mediaModel = new MediaModel();
        if (! $mediaModel->deleteMedia($episode->transcript)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $mediaModel->errors());
        }

        return redirect()->back();
    }

    public function chaptersDelete(Episode $episode): RedirectResponse
    {
        if (! $episode->chapters instanceof Chapters) {
            return redirect()->back();
        }

        $mediaModel = new MediaModel();
        if (! $mediaModel->deleteMedia($episode->chapters)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $mediaModel->errors());
        }

        return redirect()->back();
    }

    public function publishView(Episode $episode): string | RedirectResponse
    {
        if ($episode->publication_status === 'not_published') {
            helper(['form']);

            $data = [
                'podcast' => $episode->podcast,
                'episode' => $episode,
            ];

            $this->setHtmlHead(lang('Episode.publish'));
            replace_breadcrumb_params([
                0 => $episode->podcast->at_handle,
                1 => $episode->title,
            ]);
            return view('episode/publish', $data);
        }

        return redirect()->route('episode-view', [$episode->podcast_id, $episode->id])->with(
            'error',
            lang('Episode.publish_error'),
        );
    }

    public function publishAction(Episode $episode): RedirectResponse
    {
        if ($episode->podcast->publication_status === 'published') {
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
        }

        $db = db_connect();
        $db->transStart();

        $newPost = new Post([
            'actor_id'   => $episode->podcast->actor_id,
            'episode_id' => $episode->id,
            'message'    => $this->request->getPost('message'),
            'created_by' => user_id(),
        ]);

        if ($episode->podcast->publication_status === 'published') {
            $publishMethod = $this->request->getPost('publication_method');
            if ($publishMethod === 'schedule') {
                $scheduledPublicationDate = $this->request->getPost('scheduled_publication_date');
                if ($scheduledPublicationDate) {
                    $episode->published_at = Time::createFromFormat(
                        'Y-m-d H:i',
                        $scheduledPublicationDate,
                        $this->request->getPost('client_timezone'),
                    )->setTimezone(app_timezone());
                } else {
                    $db->transRollback();
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('error', lang('Episode.messages.scheduleDateError'));
                }
            } else {
                $episode->published_at = Time::now();
            }
        } elseif ($episode->podcast->publication_status === 'scheduled') {
            // podcast publication date has already been set
            $episode->published_at = $episode->podcast->published_at->addSeconds(1);
        } else {
            $episode->published_at = Time::now();
        }

        $newPost->published_at = $episode->published_at;

        $postModel = new PostModel();
        if (! $postModel->addPost($newPost)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $postModel->errors());
        }

        $episodeModel = new EpisodeModel();
        if (! $episodeModel->update($episode->id, $episode)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        $db->transComplete();

        return redirect()->route('episode-view', [$episode->podcast_id, $episode->id])->with(
            'message',
            lang('Episode.messages.publishSuccess', [
                'publication_status' => $episode->publication_status,
            ]),
        );
    }

    public function publishEditView(Episode $episode): string | RedirectResponse
    {
        if (in_array($episode->publication_status, ['scheduled', 'with_podcast'], true)) {
            helper(['form']);

            $data = [
                'podcast' => $episode->podcast,
                'episode' => $episode,
                'post'    => (new PostModel())
                    ->where([
                        'actor_id'   => $episode->podcast->actor_id,
                        'episode_id' => $episode->id,
                    ])
                    ->first(),
            ];

            $this->setHtmlHead(lang('Episode.publish_edit'));
            replace_breadcrumb_params([
                0 => $episode->podcast->at_handle,
                1 => $episode->title,
            ]);
            return view('episode/publish_edit', $data);
        }

        return redirect()->route('episode-view', [$episode->podcast_id, $episode->id])->with(
            'error',
            lang('Episode.publish_edit_error'),
        );
    }

    public function publishEditAction(Episode $episode): RedirectResponse
    {
        if ($episode->podcast->publication_status === 'published') {
            $rules = [
                'post_id'                    => 'required',
                'publication_method'         => 'required',
                'scheduled_publication_date' => 'valid_date[Y-m-d H:i]|permit_empty',
            ];

            if (! $this->validate($rules)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
            }
        }

        $db = db_connect();
        $db->transStart();

        if ($episode->podcast->publication_status === 'published') {
            $publishMethod = $this->request->getPost('publication_method');
            if ($publishMethod === 'schedule') {
                $scheduledPublicationDate = $this->request->getPost('scheduled_publication_date');
                if ($scheduledPublicationDate) {
                    $episode->published_at = Time::createFromFormat(
                        'Y-m-d H:i',
                        $scheduledPublicationDate,
                        $this->request->getPost('client_timezone'),
                    )->setTimezone(app_timezone());
                } else {
                    $db->transRollback();
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('error', lang('Episode.messages.scheduleDateError'));
                }
            } else {
                $episode->published_at = Time::now();
            }
        } elseif ($episode->podcast->publication_status === 'scheduled') {
            // podcast publication date has already been set
            $episode->published_at = $episode->podcast->published_at->addSeconds(1);
        } else {
            $episode->published_at = Time::now();
        }

        $post = (new PostModel())->getPostById($this->request->getPost('post_id'));

        if ($post instanceof Post) {
            $post->message = $this->request->getPost('message');
            $post->published_at = $episode->published_at;

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
        if (! $episodeModel->update($episode->id, $episode)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        $db->transComplete();

        return redirect()->route('episode-view', [$episode->podcast_id, $episode->id])->with(
            'message',
            lang('Episode.messages.publishSuccess', [
                'publication_status' => $episode->publication_status,
            ]),
        );
    }

    public function publishCancelAction(Episode $episode): RedirectResponse
    {
        if (in_array($episode->publication_status, ['scheduled', 'with_podcast'], true)) {
            $db = db_connect();
            $db->transStart();

            $postModel = new PostModel();
            $post = $postModel
                ->where([
                    'actor_id'   => $episode->podcast->actor_id,
                    'episode_id' => $episode->id,
                ])
                ->first();
            $postModel->removePost($post);

            $episode->published_at = null;

            $episodeModel = new EpisodeModel();
            if (! $episodeModel->update($episode->id, $episode)) {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $episodeModel->errors());
            }

            $db->transComplete();

            return redirect()->route('episode-view', [$episode->podcast_id, $episode->id])->with(
                'message',
                lang('Episode.messages.publishCancelSuccess'),
            );
        }

        return redirect()->route('episode-view', [$episode->podcast_id, $episode->id]);
    }

    public function publishDateEditView(Episode $episode): string|RedirectResponse
    {
        // only accessible if episode is already published
        if ($episode->publication_status !== 'published') {
            return redirect()->route('episode-view', [$episode->podcast_id, $episode->id])->with(
                'error',
                lang('Episode.publish_date_edit_error'),
            );
        }

        helper('form');

        $data = [
            'podcast' => $episode->podcast,
            'episode' => $episode,
        ];

        $this->setHtmlHead(lang('Episode.publish_date_edit'));
        replace_breadcrumb_params([
            0 => $episode->podcast->title,
            1 => $episode->title,
        ]);
        return view('episode/publish_date_edit', $data);
    }

    /**
     * Allows to set an episode's publication date to a past date
     *
     * Prevents setting a future date as it does not make sense to set a future published date to an already published
     * episode. This also prevents any side-effects from occurring.
     */
    public function publishDateEditAction(Episode $episode): RedirectResponse
    {
        $rules = [
            'new_publication_date' => 'valid_date[Y-m-d H:i]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        $newPublicationDate = $validData['new_publication_date'];

        $newPublicationDate = Time::createFromFormat(
            'Y-m-d H:i',
            $newPublicationDate,
            $this->request->getPost('client_timezone'),
        )->setTimezone(app_timezone());

        if ($newPublicationDate->isAfter(Time::now())) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', lang('Episode.publish_date_edit_future_error'));
        }

        $episode->published_at = $newPublicationDate;

        $episodeModel = new EpisodeModel();
        if (! $episodeModel->update($episode->id, $episode)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        return redirect()->route('episode-view', [$episode->podcast_id, $episode->id])->with(
            'message',
            lang('Episode.publish_date_edit_success'),
        );
    }

    public function unpublishView(Episode $episode): string | RedirectResponse
    {
        if ($episode->publication_status !== 'published') {
            return redirect()->route('episode-view', [$episode->podcast_id, $episode->id])->with(
                'error',
                lang('Episode.unpublish_error'),
            );
        }

        helper(['form']);

        $data = [
            'podcast' => $episode->podcast,
            'episode' => $episode,
        ];

        $this->setHtmlHead(lang('Episode.unpublish'));
        replace_breadcrumb_params([
            0 => $episode->podcast->title,
            1 => $episode->title,
        ]);
        return view('episode/unpublish', $data);
    }

    public function unpublishAction(Episode $episode): RedirectResponse
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
                'episode_id'     => $episode->id,
                'in_reply_to_id' => null,
                'reblog_of_id'   => null,
            ])
            ->findAll();
        foreach ($allPostsLinkedToEpisode as $post) {
            (new PostModel())->removePost($post);
        }

        $allCommentsLinkedToEpisode = (new EpisodeCommentModel())
            ->where([
                'episode_id'     => $episode->id,
                'in_reply_to_id' => null,
            ])
            ->findAll();
        foreach ($allCommentsLinkedToEpisode as $comment) {
            (new EpisodeCommentModel())->removeComment($comment);
        }

        // set episode published_at to null to unpublish
        $episode->published_at = null;

        $episodeModel = new EpisodeModel();
        if (! $episodeModel->update($episode->id, $episode)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        // set podcast is_published_on_hubs to false to trigger websub push
        (new PodcastModel())->update($episode->podcast_id, [
            'is_published_on_hubs' => 0,
        ]);

        $db->transComplete();

        return redirect()->route('episode-view', [$episode->podcast_id, $episode->id]);
    }

    public function deleteView(Episode $episode): string
    {
        helper(['form']);

        $data = [
            'podcast' => $episode->podcast,
            'episode' => $episode,
        ];

        $this->setHtmlHead(lang('Episode.delete'));
        replace_breadcrumb_params([
            0 => $episode->podcast->at_handle,
            1 => $episode->title,
        ]);
        return view('episode/delete', $data);
    }

    public function deleteAction(Episode $episode): RedirectResponse
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

        if ($episode->published_at instanceof Time) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', lang('Episode.messages.deletePublishedEpisodeError'));
        }

        $db = db_connect();

        $db->transStart();

        $episodeModel = new EpisodeModel();

        if (! $episodeModel->delete($episode->id)) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $episodeModel->errors());
        }

        $episodeMediaList = [$episode->transcript, $episode->chapters, $episode->audio];

        //only delete episode cover if different from podcast's
        if ($episode->cover_id !== null) {
            $episodeMediaList[] = $episode->cover;
        }

        $mediaModel = new MediaModel();

        //delete episode media records from database
        foreach ($episodeMediaList as $episodeMedia) {
            if ($episodeMedia !== null && ! $mediaModel->delete($episodeMedia->id)) {
                $db->transRollback();
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', lang('Episode.messages.deleteError', [
                        'type' => $episodeMedia->type,
                    ]));
            }
        }

        $db->transComplete();

        $warnings = [];

        //remove episode media files from disk
        foreach ($episodeMediaList as $episodeMedia) {
            if ($episodeMedia === null) {
                continue;
            }

            if ($episodeMedia->deleteFile()) {
                continue;
            }

            $warnings[] = lang('Episode.messages.deleteFileError', [
                'type'     => $episodeMedia->type,
                'file_key' => $episodeMedia->file_key,
            ]);
        }

        if ($warnings !== []) {
            return redirect()
                ->route('episode-list', [$episode->podcast_id])
                ->with('message', lang('Episode.messages.deleteSuccess'))
                ->with('warnings', $warnings);
        }

        return redirect()->route('episode-list', [$episode->podcast_id])->with(
            'message',
            lang('Episode.messages.deleteSuccess'),
        );
    }

    public function embedView(Episode $episode): string
    {
        helper(['form']);

        $data = [
            'podcast' => $episode->podcast,
            'episode' => $episode,
            'themes'  => EpisodeModel::$themes,
        ];

        $this->setHtmlHead(lang('Episode.embed.title'));
        replace_breadcrumb_params([
            0 => $episode->podcast->at_handle,
            1 => $episode->title,
        ]);
        return view('episode/embed', $data);
    }

    public function commentCreateAction(Episode $episode): RedirectResponse
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

        $validData = $this->validator->getValidated();

        $newComment = new EpisodeComment([
            'actor_id'   => interact_as_actor_id(),
            'episode_id' => $episode->id,
            'message'    => $validData['message'],
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

    public function commentReplyAction(Episode $episode, string $commentId): RedirectResponse
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

        $validData = $this->validator->getValidated();

        $newReply = new EpisodeComment([
            'actor_id'       => interact_as_actor_id(),
            'episode_id'     => $episode->id,
            'message'        => $validData['message'],
            'in_reply_to_id' => $commentId,
            'created_at'     => new Time('now'),
            'created_by'     => user_id(),
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
