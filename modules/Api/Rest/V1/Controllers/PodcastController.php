<?php

declare(strict_types=1);

namespace Modules\Api\Rest\V1\Controllers;

use App\Entities\Podcast;
use App\Models\PodcastModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use Modules\Api\Rest\V1\Config\Services;

class PodcastController extends Controller
{
    use ResponseTrait;

    public function __construct()
    {
        Services::restApiExceptions()->initialize();
    }

    public function list(): ResponseInterface
    {
        $data = (new PodcastModel())->findAll();
        array_map(static function ($podcast): void {
            self::mapPodcast($podcast);
        }, $data);
        return $this->respond($data);
    }

    public function view(int $id): ResponseInterface
    {
        $podcast = (new PodcastModel())->getPodcastById($id);
        if (! $podcast instanceof Podcast) {
            return $this->failNotFound('Podcast not found');
        }

        // @phpstan-ignore-next-line
        return $this->respond(self::mapPodcast($podcast));
    }

    protected static function mapPodcast(Podcast $podcast): Podcast
    {
        $podcast->feed_url = $podcast->getFeedUrl();
        $podcast->actor_display_name = $podcast->getActor()
            ->display_name;
        $podcast->cover_url = $podcast->getCover()
            ->file_url;

        $categories = [$podcast->getCategory(), ...$podcast->getOtherCategories()];

        foreach ($categories as $category) {
            $category->translated = lang('Podcast.category_options.' . $category->code);
        }

        $podcast->categories = $categories;

        return $podcast;
    }
}
