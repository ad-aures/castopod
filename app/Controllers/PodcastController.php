<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Entities\Podcast;
use App\Libraries\PodcastActor;
use App\Libraries\PodcastEpisode;
use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use App\Models\PostModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;
use Modules\Analytics\AnalyticsTrait;
use Modules\Fediverse\Objects\OrderedCollectionObject;
use Modules\Fediverse\Objects\OrderedCollectionPage;

class PodcastController extends BaseController
{
    use AnalyticsTrait;

    protected Podcast $podcast;

    public function _remap(string $method, string ...$params): mixed
    {
        if ($params === []) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (
            ! ($podcast = new PodcastModel()->getPodcastByHandle($params[0])) instanceof Podcast
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->podcast = $podcast;

        unset($params[0]);

        return $this->{$method}(...$params);
    }

    public function podcastActor(): ResponseInterface
    {
        $podcastActor = new PodcastActor($this->podcast);

        return $this->response
            ->setContentType('application/activity+json')
            ->setBody($podcastActor->toJSON());
    }

    public function activity(): string
    {
        $this->registerPodcastWebpageHit($this->podcast->id);

        $cacheName = implode(
            '_',
            array_filter([
                'page',
                "podcast#{$this->podcast->id}",
                'activity',
                service('request')
                    ->getLocale(),
                is_unlocked($this->podcast->handle) ? 'unlocked' : null,
                auth()
                    ->loggedIn() ? 'authenticated' : null,
            ]),
        );

        if (! ($cachedView = cache($cacheName))) {
            set_podcast_metatags($this->podcast, 'activity');
            $data = [
                'podcast' => $this->podcast,
                'posts'   => new PostModel()
                    ->getActorPublishedPosts($this->podcast->actor_id),
            ];

            // if user is logged in then send to the authenticated activity view
            if (auth()->loggedIn()) {
                helper('form');

                return view('podcast/activity', $data);
            }

            $secondsToNextUnpublishedEpisode = new EpisodeModel()
                ->getSecondsToNextUnpublishedEpisode($this->podcast->id);

            return view('podcast/activity', $data, [
                'cache'      => $secondsToNextUnpublishedEpisode ?: DECADE,
                'cache_name' => $cacheName,
            ]);
        }

        return $cachedView;
    }

    public function about(): string
    {
        $this->registerPodcastWebpageHit($this->podcast->id);

        $cacheName = implode(
            '_',
            array_filter([
                'page',
                "podcast#{$this->podcast->id}",
                'about',
                service('request')
                    ->getLocale(),
                is_unlocked($this->podcast->handle) ? 'unlocked' : null,
                auth()
                    ->loggedIn() ? 'authenticated' : null,
            ]),
        );

        if (! ($cachedView = cache($cacheName))) {
            $stats = new EpisodeModel()
                ->getPodcastStats($this->podcast->id);

            set_podcast_metatags($this->podcast, 'about');
            $data = [
                'podcast' => $this->podcast,
                'stats'   => $stats,
            ];

            // // if user is logged in then send to the authenticated activity view
            if (auth()->loggedIn()) {
                helper('form');

                return view('podcast/about', $data);
            }

            $secondsToNextUnpublishedEpisode = new EpisodeModel()
                ->getSecondsToNextUnpublishedEpisode($this->podcast->id);

            return view('podcast/about', $data, [
                'cache'      => $secondsToNextUnpublishedEpisode ?: DECADE,
                'cache_name' => $cacheName,
            ]);
        }

        return $cachedView;
    }

    public function episodes(): string
    {
        $this->registerPodcastWebpageHit($this->podcast->id);

        $yearQuery = $this->request->getGet('year');
        $seasonQuery = $this->request->getGet('season');

        if (! $yearQuery && ! $seasonQuery) {
            $defaultQuery = new PodcastModel()
                ->getDefaultQuery($this->podcast->id);
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
                is_unlocked($this->podcast->handle) ? 'unlocked' : null,
                auth()
                    ->loggedIn() ? 'authenticated' : null,
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
                        'type'               => 'year',
                        'value'              => $year['year'],
                        'label'              => $year['year'],
                        'number_of_episodes' => $year['number_of_episodes'],
                    ];
                }

                $episodesNavigation[] = [
                    'label'              => $year['year'],
                    'number_of_episodes' => $year['number_of_episodes'],
                    'route'              => route_to('podcast-episodes', $this->podcast->handle) .
                        '?year=' .
                        $year['year'],
                    'is_active' => $isActive,
                ];
            }

            foreach ($seasons as $season) {
                $isActive = $seasonQuery === $season['season_number'];
                if ($isActive) {
                    $activeQuery = [
                        'type'  => 'season',
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
                    'route'              => route_to('podcast-episodes', $this->podcast->handle) .
                        '?season=' .
                        $season['season_number'],
                    'is_active' => $isActive,
                ];
            }

            set_podcast_metatags($this->podcast, 'episodes');
            $data = [
                'podcast'     => $this->podcast,
                'episodesNav' => $episodesNavigation,
                'activeQuery' => $activeQuery,
                'episodes'    => new EpisodeModel()
                    ->getPodcastEpisodes($this->podcast->id, $this->podcast->type, $yearQuery, $seasonQuery),
            ];

            if (auth()->loggedIn()) {
                return view('podcast/episodes', $data);
            }

            $secondsToNextUnpublishedEpisode = new EpisodeModel()
                ->getSecondsToNextUnpublishedEpisode($this->podcast->id);
            return view('podcast/episodes', $data, [
                'cache'      => $secondsToNextUnpublishedEpisode ?: DECADE,
                'cache_name' => $cacheName,
            ]);
        }

        return $cachedView;
    }

    public function episodeCollection(): ResponseInterface
    {
        if ($this->podcast->type === 'serial') {
            // podcast is serial
            $episodes = model('EpisodeModel')
                ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
                ->orderBy('season_number DESC, number ASC');
        } else {
            $episodes = model('EpisodeModel')
                ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
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
            foreach ($paginatedEpisodes as $episode) {
                $orderedItems[] = new PodcastEpisode($episode)->toArray();
            }

            // @phpstan-ignore-next-line
            $collection = new OrderedCollectionPage($pager, $orderedItems);
        }

        return $this->response
            ->setContentType('application/activity+json')
            ->setBody($collection->toJSON());
    }

    public function links(): string
    {
        set_podcast_metatags($this->podcast, 'links');
        return view('podcast/links', [
            'podcast' => $this->podcast,
        ]);
    }
}
