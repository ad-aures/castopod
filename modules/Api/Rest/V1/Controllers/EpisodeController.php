<?php

declare(strict_types=1);

namespace Modules\Api\Rest\V1\Controllers;

use App\Entities\Episode;
use App\Models\EpisodeModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use Modules\Api\Rest\V1\Config\Services;

class EpisodeController extends Controller
{
    use ResponseTrait;

    public function __construct()
    {
        Services::restApiExceptions()->initialize();
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

        $data = $builder->findAll(
            (int) ($this->request->getGet('limit') ?? config('RestApi')->limit),
            (int) $this->request->getGet('offset')
        );

        array_map(static function ($episode): void {
            self::mapEpisode($episode);
        }, $data);

        return $this->respond($data);
    }

    public function view(int $id): ResponseInterface
    {
        $episode = (new EpisodeModel())->getEpisodeById($id);

        if (! $episode instanceof Episode) {
            return $this->failNotFound('Episode not found');
        }

        // @phpstan-ignore-next-line
        return $this->respond(static::mapEpisode($episode));
    }

    protected static function mapEpisode(Episode $episode): Episode
    {
        $episode->cover_url = $episode->getCover()
->file_url;
        $episode->audio_url = $episode->getAudioUrl();
        $episode->duration = round($episode->audio->duration);

        return $episode;
    }
}
