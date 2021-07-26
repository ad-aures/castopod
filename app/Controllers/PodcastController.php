<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use ActivityPub\Objects\OrderedCollectionObject;
use ActivityPub\Objects\OrderedCollectionPage;
use Analytics\AnalyticsTrait;
use App\Entities\Podcast;
use App\Libraries\PodcastActor;
use App\Libraries\PodcastEpisode;
use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use App\Models\StatusModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\Response;

class PodcastController extends BaseController
{
    use AnalyticsTrait;

    protected Podcast $podcast;

    public function _remap(string $method, string ...$params): mixed
    {
        if (count($params) === 0) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (
            ($podcast = (new PodcastModel())->getPodcastByHandle($params[0])) === null
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->podcast = $podcast;

        unset($params[0]);

        return $this->{$method}(...$params);
    }

    /**
     * @noRector ReturnTypeDeclarationRector
     */
    public function podcastActor(): Response
    {
        $podcastActor = new PodcastActor($this->podcast);

        return $this->response
            ->setContentType('application/activity+json')
            ->setBody($podcastActor->toJSON());
    }

    public function activity(): string
    {
        // Prevent analytics hit when authenticated
        if (! can_user_interact()) {
            $this->registerPodcastWebpageHit($this->podcast->id);
        }

        $cacheName = implode(
            '_',
            array_filter([
                'page',
                "podcast#{$this->podcast->id}",
                'activity',
                service('request')
                    ->getLocale(),
                can_user_interact() ? '_authenticated' : null,
            ]),
        );

        if (! ($cachedView = cache($cacheName))) {
            $data = [
                'podcast' => $this->podcast,
                'statuses' => (new StatusModel())->getActorPublishedStatuses($this->podcast->actor_id),
            ];

            // if user is logged in then send to the authenticated activity view
            if (can_user_interact()) {
                helper('form');
                return view('podcast/activity_authenticated', $data);
            }

            $secondsToNextUnpublishedEpisode = (new EpisodeModel())->getSecondsToNextUnpublishedEpisode(
                $this->podcast->id,
            );

            return view('podcast/activity', $data, [
                'cache' => $secondsToNextUnpublishedEpisode
                    ? $secondsToNextUnpublishedEpisode
                    : DECADE,
                'cache_name' => $cacheName,
            ]);
        }

        return $cachedView;
    }

    public function episodes(): string
    {
        // Prevent analytics hit when authenticated
        if (! can_user_interact()) {
            $this->registerPodcastWebpageHit($this->podcast->id);
        }

        $yearQuery = $this->request->getGet('year');
        $seasonQuery = $this->request->getGet('season');

        if (! $yearQuery && ! $seasonQuery) {
            $defaultQuery = (new PodcastModel())->getDefaultQuery($this->podcast->id);
            if ($defaultQuery) {
                if ($defaultQuery['type'] === 'season') {
                    $seasonQuery = $defaultQuery['data']['season_number'];
                } elseif ($defaultQuery['type'] === 'year') {
                    $yearQuery = $defaultQuery['data']['year'];
                }
            }
        }

        $cacheName = implode(
            '_',
            array_filter([
                'page',
                "podcast#{$this->podcast->id}",
                'episodes',
                $yearQuery ? 'year' . $yearQuery : null,
                $seasonQuery ? 'season' . $seasonQuery : null,
                service('request')
                    ->getLocale(),
                can_user_interact() ? '_authenticated' : null,
            ]),
        );

        if (! ($cachedView = cache($cacheName))) {
            // Build navigation array
            $podcastModel = new PodcastModel();
            $years = $podcastModel->getYears($this->podcast->id);
            $seasons = $podcastModel->getSeasons($this->podcast->id);

            $episodesNavigation = [];
            $activeQuery = null;
            foreach ($years as $year) {
                $isActive = $yearQuery === $year['year'];
                if ($isActive) {
                    $activeQuery = [
                        'type' => 'year',
                        'value' => $year['year'],
                        'label' => $year['year'],
                        'number_of_episodes' => $year['number_of_episodes'],
                    ];
                }

                $episodesNavigation[] = [
                    'label' => $year['year'],
                    'number_of_episodes' => $year['number_of_episodes'],
                    'route' =>
                        route_to('podcast-episodes', $this->podcast->handle) .
                        '?year=' .
                        $year['year'],
                    'is_active' => $isActive,
                ];
            }

            foreach ($seasons as $season) {
                $isActive = $seasonQuery === $season['season_number'];
                if ($isActive) {
                    $activeQuery = [
                        'type' => 'season',
                        'value' => $season['season_number'],
                        'label' => lang('Podcast.season', [
                            'seasonNumber' => $season['season_number'],
                        ]),
                        'number_of_episodes' => $season['number_of_episodes'],
                    ];
                }

                $episodesNavigation[] = [
                    'label' => lang('Podcast.season', [
                        'seasonNumber' => $season['season_number'],
                    ]),
                    'number_of_episodes' => $season['number_of_episodes'],
                    'route' =>
                        route_to('podcast-episodes', $this->podcast->handle) .
                        '?season=' .
                        $season['season_number'],
                    'is_active' => $isActive,
                ];
            }

            $data = [
                'podcast' => $this->podcast,
                'episodesNav' => $episodesNavigation,
                'activeQuery' => $activeQuery,
                'episodes' => (new EpisodeModel())->getPodcastEpisodes(
                    $this->podcast->id,
                    $this->podcast->type,
                    $yearQuery,
                    $seasonQuery,
                ),
            ];

            $secondsToNextUnpublishedEpisode = (new EpisodeModel())->getSecondsToNextUnpublishedEpisode(
                $this->podcast->id,
            );

            // if user is logged in then send to the authenticated episodes view
            if (can_user_interact()) {
                return view('podcast/episodes_authenticated', $data);
            }
            return view('podcast/episodes', $data, [
                'cache' => $secondsToNextUnpublishedEpisode
                    ? $secondsToNextUnpublishedEpisode
                    : DECADE,
                'cache_name' => $cacheName,
            ]);
        }

        return $cachedView;
    }

    /**
     * @noRector ReturnTypeDeclarationRector
     */
    public function episodeCollection(): Response
    {
        if ($this->podcast->type === 'serial') {
            // podcast is serial
            $episodes = model('EpisodeModel')
                ->where('`published_at` <= NOW()', null, false)
                ->orderBy('season_number DESC, number ASC');
        } else {
            $episodes = model('EpisodeModel')
                ->where('`published_at` <= NOW()', null, false)
                ->orderBy('published_at', 'DESC');
        }

        $pageNumber = (int) $this->request->getGet('page');

        if ($pageNumber < 1) {
            $episodes->paginate(12);
            $pager = $episodes->pager;
            $collection = new OrderedCollectionObject(null, $pager);
        } else {
            $paginatedEpisodes = $episodes->paginate(12, 'default', $pageNumber);
            $pager = $episodes->pager;

            $orderedItems = [];
            if ($paginatedEpisodes !== null) {
                foreach ($paginatedEpisodes as $episode) {
                    $orderedItems[] = (new PodcastEpisode($episode))->toArray();
                }
            }

            // @phpstan-ignore-next-line
            $collection = new OrderedCollectionPage($pager, $orderedItems);
        }

        return $this->response
            ->setContentType('application/activity+json')
            ->setBody($collection->toJSON());
    }
}
