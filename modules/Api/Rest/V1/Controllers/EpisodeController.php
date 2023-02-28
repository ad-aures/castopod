<?php

declare(strict_types=1);

namespace Modules\Api\Rest\V1\Controllers;

use App\Entities\Episode;
use App\Models\EpisodeModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Response;
use Modules\Api\Rest\V1\Config\Services;

class EpisodeController extends Controller
{
    use ResponseTrait;

    public function __construct()
    {
        Services::restApiExceptions()->initialize();
    }

    public function list(): Response
    {

        $params = $this->request->getGet();

        $searchParam = $params['search'] ?? null;
        $orderParams = $params['order'] ?? 'newest';
        $podcastId = $params['podcast_id'] ?? null;

        $builder = (new EpisodeModel());

        if($podcastId) {
            $builder->where('podcast_id', $podcastId);
        }

        if($searchParam) {
           $builder->fullTextSearch($searchParam);

           if($orderParams == "search") {
                $builder->orderBy('(episodes_score + podcasts_score)', 'desc');
           }
        }

        if($orderParams == "newest") {
            $builder->orderBy($builder->db->getPrefix().$builder->getTable().'.created_at', 'desc');
        }


        $data = $builder->findAll(
            (int) ($params['limit'] ?? config('RestApi')->limit),
            (int) ($params['offset'] ?? 0)
        );

        array_map(static function ($episode): void  {
          self::mapEpisode($episode);
        }, $data);

        return $this->respond($data);
    }

    public function view(int $id): Response
    {

        $data = (new EpisodeModel())->getEpisodeById($id);

        if (! $data instanceof Episode) {
            return $this->failNotFound('Episode not found');
        }

        return $this->respond(self::mapEpisode($data));
    }


    protected static function mapEpisode(Episode $episode): Episode
    {
        $episode->cover_url = $episode->getCover()->file_url;
        $episode->audio_url = $episode->getAudioUrl();
        $episode->duration =  round($episode->audio->duration);

        return $episode;
    }
}
