<?php

declare(strict_types=1);

namespace Modules\Api\Rest\V1\Controllers;

use App\Entities\Episode;
use App\Entities\Location;
use App\Entities\Podcast;
use App\Entities\Post;
use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use App\Models\PostModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
use Modules\Auth\Models\UserModel;

class EpisodeController extends BaseApiController
{
    public function __construct()
    {
        service('restApiExceptions')->initialize();
    }

    public function list(): ResponseInterface
    {
        $query = $this->request->getGet('query');
        $order = $this->request->getGet('order') ?? 'newest';
        $podcastIds = $this->request->getGet('podcastIds');

        $builder = (new EpisodeModel());

        if ($podcastIds !== null) {
            $builder->whereIn('podcast_id', explode(',', (string) $podcastIds));
        }

        if ($query !== null) {
            $builder->fullTextSearch($query);

            if ($order === 'search') {
                $builder->orderBy('(episodes_score + podcasts_score)', 'desc');
            }
        }

        if ($order === 'newest') {
            $builder->orderBy('episodes.created_at', 'desc');
        }

        /** @var array<string,mixed> $data */
        $data = $builder->findAll(
            (int) ($this->request->getGet('limit') ?? config('RestApi')->limit),
            (int) $this->request->getGet('offset'),
        );

        array_map(static function (Episode $episode): void {
            self::mapEpisode($episode);
        }, $data);

        return $this->respond($data);
    }

    public function view(int $id): ResponseInterface
    {
        $episode = new EpisodeModel()
            ->getEpisodeById($id);

        if (! $episode instanceof Episode) {
            return $this->failNotFound('Episode not found');
        }

        // @phpstan-ignore-next-line
        return $this->respond(static::mapEpisode($episode));
    }

    public function attemptCreate(): ResponseInterface
    {
        $rules = [
            'created_by'        => 'required|is_natural_no_zero',
            'updated_by'        => 'required|is_natural_no_zero',
            'title'             => 'required',
            'slug'              => 'required|max_length[128]',
            'podcast_id'        => 'required|is_natural_no_zero',
            'audio_file'        => 'uploaded[audio_file]|ext_in[audio_file,mp3,m4a]',
            'cover'             => 'permit_empty|is_image[cover]|ext_in[cover,jpg,jpeg,png]|min_dims[cover,1400,1400]|is_image_ratio[cover,1,1]',
            'transcript_file'   => 'permit_empty|ext_in[transcript_file,srt,vtt]',
            'chapters_file'     => 'permit_empty|ext_in[chapters_file,json]|is_json[chapters_file]',
            'transcript-choice' => 'permit_empty|in_list[upload-file,remote-url]',
            'chapters-choice'   => 'permit_empty|in_list[upload-file,remote-url]',
        ];

        if (! $this->validate($rules)) {
            return $this->failValidationErrors(array_values($this->validator->getErrors()));
        }

        $podcastId = (int) $this->request->getPost('podcast_id');

        $podcast = new PodcastModel()
            ->getPodcastById($podcastId);

        if (! $podcast instanceof Podcast) {
            return $this->failNotFound('Podcast not found');
        }

        $createdByUserId = (int) $this->request->getPost('created_by');

        $userModel = new UserModel();
        $createdByUser = $userModel->find($createdByUserId);

        if (! $createdByUser) {
            return $this->failNotFound('User not found');
        }

        $updatedByUserId = (int) $this->request->getPost('updated_by');

        $updatedByUser = $userModel->find($updatedByUserId);

        if (! $updatedByUser) {
            return $this->failNotFound('Updated by user not found');
        }

        if ($podcast->type === 'serial' && $this->request->getPost('type') === 'full') {
            $rules['episode_number'] = 'required';
        }

        if (! $this->validate($rules)) {
            return $this->failValidationErrors(array_values($this->validator->getErrors()));
        }

        $validData = $this->validator->getValidated();

        if (new EpisodeModel()
            ->where([
                'slug'       => $validData['slug'],
                'podcast_id' => $podcast->id,
            ])
            ->first() instanceof Episode) {
            return $this->fail('An episode with the same slug already exists in this podcast.', 409);
        }

        $newEpisode = new Episode([
            'created_by'           => $createdByUserId,
            'updated_by'           => $updatedByUserId,
            'podcast_id'           => $podcast->id,
            'title'                => $validData['title'],
            'slug'                 => $validData['slug'],
            'guid'                 => null,
            'audio'                => $this->request->getFile('audio_file'),
            'cover'                => $this->request->getFile('cover'),
            'description_markdown' => $this->request->getPost('description'),
            'location'             => in_array($this->request->getPost('location_name'), ['', null], true)
                ? null
                : new Location($this->request->getPost('location_name')),
            'parental_advisory' => $this->request->getPost('parental_advisory') !== 'undefined'
                ? $this->request->getPost('parental_advisory')
                : null,
            'number' => $this->request->getPost('episode_number') ? (int) $this->request->getPost(
                'episode_number',
            ) : null,
            'season_number' => $this->request->getPost('season_number') ? (int) $this->request->getPost(
                'season_number',
            ) : null,
            'type'              => $this->request->getPost('type'),
            'is_blocked'        => $this->request->getPost('block') === 'yes',
            'custom_rss_string' => $this->request->getPost('custom_rss'),
            'is_premium'        => $this->request->getPost('premium') === 'yes',
            'published_at'      => null,
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
        if (($newEpisodeId = (int) $episodeModel->insert($newEpisode, true)) === 0) {
            return $this->fail(array_values($episodeModel->errors()), 400);
        }

        $episode = $episodeModel->find($newEpisodeId)
            ->toRawArray();

        return $this->respond($episode);
    }

    public function attemptPublish(int $id): ResponseInterface
    {
        $episodeModel = new EpisodeModel();
        $episode = $episodeModel->getEpisodeById($id);

        if (! $episode instanceof Episode) {
            return $this->failNotFound('Episode not found');
        }

        if ($episode->publication_status !== 'not_published') {
            return $this->fail('Episode is already published or scheduled for publication', 409);
        }

        $rules = [
            'publication_method' => 'required',
            'created_by'         => 'required|is_natural_no_zero',
        ];

        if (! $this->validate($rules)) {
            return $this->failValidationErrors(array_values($this->validator->getErrors()));
        }

        if ($this->request->getPost('publication_method') === 'schedule') {
            $rules['scheduled_publication_date'] = 'required|valid_date[Y-m-d H:i]';
        }

        if (! $this->validate($rules)) {
            return $this->failValidationErrors(array_values($this->validator->getErrors()));
        }

        $createdByUserId = (int) $this->request->getPost('created_by');

        $userModel = new UserModel();
        $createdByUser = $userModel->find($createdByUserId);

        if (! $createdByUser) {
            return $this->failNotFound('User not found');
        }

        $validData = $this->validator->getValidated();

        $db = db_connect();
        $db->transStart();

        $newPost = new Post([
            'actor_id'   => $episode->podcast->actor_id,
            'episode_id' => $episode->id,
            'message'    => $this->request->getPost('message') ?? '',
            'created_by' => $createdByUserId,
        ]);

        $clientTimezone = $this->request->getPost('client_timezone') ?? app_timezone();

        if ($episode->podcast->publication_status === 'published') {
            $publishMethod = $validData['publication_method'];
            if ($publishMethod === 'schedule') {
                $scheduledPublicationDate = $validData['scheduled_publication_date'] ?? null;
                if ($scheduledPublicationDate) {
                    $episode->published_at = Time::createFromFormat(
                        'Y-m-d H:i',
                        $scheduledPublicationDate,
                        $clientTimezone,
                    )->setTimezone(app_timezone());
                } else {
                    $db->transRollback();
                    return $this->fail('Scheduled publication date is required', 400);
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
            return $this->fail(array_values($postModel->errors()), 400);
        }

        if (! $episodeModel->update($episode->id, $episode)) {
            $db->transRollback();
            return $this->fail(array_values($episodeModel->errors()), 400);
        }

        $db->transComplete();

        // @phpstan-ignore-next-line
        return $this->respond(self::mapEpisode($episode));
    }

    protected static function mapEpisode(Episode $episode): Episode
    {
        $episode->cover_url = $episode->getCover()
            ->file_url;
        $episode->duration = round($episode->audio->duration);

        return $episode;
    }
}
