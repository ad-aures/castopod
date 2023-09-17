<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Libraries\NoteObject;
use App\Libraries\PodcastEpisode;
use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use App\Models\PostModel;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Embed;
use Config\Images;
use Config\Services;
use Modules\Analytics\AnalyticsTrait;
use Modules\Fediverse\Objects\OrderedCollectionObject;
use Modules\Fediverse\Objects\OrderedCollectionPage;
use SimpleXMLElement;

class EpisodeController extends BaseController
{
    use AnalyticsTrait;

    protected Podcast $podcast;

    protected Episode $episode;

    public function _remap(string $method, string ...$params): mixed
    {
        if (count($params) < 2) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (
            ! ($podcast = (new PodcastModel())->getPodcastByHandle($params[0])) instanceof Podcast
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->podcast = $podcast;

        if (
            ! ($episode = (new EpisodeModel())->getEpisodeBySlug($params[0], $params[1])) instanceof Episode
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->episode = $episode;

        unset($params[1]);
        unset($params[0]);

        return $this->{$method}(...$params);
    }

    public function index(): string
    {
        // Prevent analytics hit when authenticated
        if (! auth()->loggedIn()) {
            $this->registerPodcastWebpageHit($this->episode->podcast_id);
        }

        $cacheName = implode(
            '_',
            array_filter([
                'page',
                "podcast#{$this->podcast->id}",
                "episode#{$this->episode->id}",
                service('request')
                    ->getLocale(),
                is_unlocked($this->podcast->handle) ? 'unlocked' : null,
                auth()
                    ->loggedIn() ? 'authenticated' : null,
            ]),
        );

        if (! ($cachedView = cache($cacheName))) {
            $data = [
                'metatags' => get_episode_metatags($this->episode),
                'podcast'  => $this->podcast,
                'episode'  => $this->episode,
            ];

            $secondsToNextUnpublishedEpisode = (new EpisodeModel())->getSecondsToNextUnpublishedEpisode(
                $this->podcast->id,
            );

            if (auth()->loggedIn()) {
                helper('form');

                return view('episode/comments', $data);
            }

            // The page cache is set to a decade so it is deleted manually upon podcast update
            return view('episode/comments', $data, [
                'cache' => $secondsToNextUnpublishedEpisode
                ? $secondsToNextUnpublishedEpisode
                : DECADE,
                'cache_name' => $cacheName,
            ]);
        }

        return $cachedView;
    }

    public function activity(): string
    {
        // Prevent analytics hit when authenticated
        if (! auth()->loggedIn()) {
            $this->registerPodcastWebpageHit($this->episode->podcast_id);
        }

        $cacheName = implode(
            '_',
            array_filter([
                'page',
                "podcast#{$this->podcast->id}",
                "episode#{$this->episode->id}",
                'activity',
                service('request')
                    ->getLocale(),
                is_unlocked($this->podcast->handle) ? 'unlocked' : null,
                auth()
                    ->loggedIn() ? 'authenticated' : null,
            ]),
        );

        if (! ($cachedView = cache($cacheName))) {
            $data = [
                'metatags' => get_episode_metatags($this->episode),
                'podcast'  => $this->podcast,
                'episode'  => $this->episode,
            ];

            $secondsToNextUnpublishedEpisode = (new EpisodeModel())->getSecondsToNextUnpublishedEpisode(
                $this->podcast->id,
            );

            if (auth()->loggedIn()) {
                helper('form');

                return view('episode/activity', $data);
            }

            // The page cache is set to a decade so it is deleted manually upon podcast update
            return view('episode/activity', $data, [
                'cache' => $secondsToNextUnpublishedEpisode
                    ? $secondsToNextUnpublishedEpisode
                    : DECADE,
                'cache_name' => $cacheName,
            ]);
        }

        return $cachedView;
    }

    public function embed(string $theme = 'light-transparent'): string
    {
        header('Content-Security-Policy: frame-ancestors http://*:* https://*:*');

        // Prevent analytics hit when authenticated
        if (! auth()->loggedIn()) {
            $this->registerPodcastWebpageHit($this->episode->podcast_id);
        }

        $session = Services::session();

        if (service('superglobals')->server('HTTP_REFERER') !== null) {
            $session->set('embed_domain', parse_url(service('superglobals')->server('HTTP_REFERER'), PHP_URL_HOST));
        }

        $cacheName = implode(
            '_',
            array_filter([
                'page',
                "podcast#{$this->podcast->id}",
                "episode#{$this->episode->id}",
                'embed',
                $theme,
                service('request')
                    ->getLocale(),
                is_unlocked($this->podcast->handle) ? 'unlocked' : null,
            ]),
        );

        if (! ($cachedView = cache($cacheName))) {
            $themeData = EpisodeModel::$themes[$theme];

            $data = [
                'podcast'   => $this->podcast,
                'episode'   => $this->episode,
                'theme'     => $theme,
                'themeData' => $themeData,
            ];

            $secondsToNextUnpublishedEpisode = (new EpisodeModel())->getSecondsToNextUnpublishedEpisode(
                $this->podcast->id,
            );

            // The page cache is set to a decade so it is deleted manually upon podcast update
            return view('embed', $data, [
                'cache' => $secondsToNextUnpublishedEpisode
                    ? $secondsToNextUnpublishedEpisode
                    : DECADE,
                'cache_name' => $cacheName,
            ]);
        }

        return $cachedView;
    }

    public function oembedJSON(): ResponseInterface
    {
        return $this->response->setJSON([
            'type'          => 'rich',
            'version'       => '1.0',
            'title'         => $this->episode->title,
            'provider_name' => $this->podcast->title,
            'provider_url'  => $this->podcast->link,
            'author_name'   => $this->podcast->title,
            'author_url'    => $this->podcast->link,
            'html'          => '<iframe src="' .
                $this->episode->embed_url .
                '" width="100%" height="' . config(Embed::class)->height . '" frameborder="0" scrolling="no"></iframe>',
            'width' => config(Embed::class)
                ->width,
            'height' => config(Embed::class)
                ->height,
            'thumbnail_url'   => $this->episode->cover->og_url,
            'thumbnail_width' => config(Images::class)
                ->podcastCoverSizes['og']['width'],
            'thumbnail_height' => config(Images::class)
                ->podcastCoverSizes['og']['height'],
        ]);
    }

    public function oembedXML(): ResponseInterface
    {
        $oembed = new SimpleXMLElement("<?xml version='1.0' encoding='utf-8' standalone='yes'?><oembed></oembed>");

        $oembed->addChild('type', 'rich');
        $oembed->addChild('version', '1.0');
        $oembed->addChild('title', $this->episode->title);
        $oembed->addChild('provider_name', $this->podcast->title);
        $oembed->addChild('provider_url', $this->podcast->link);
        $oembed->addChild('author_name', $this->podcast->title);
        $oembed->addChild('author_url', $this->podcast->link);
        $oembed->addChild('thumbnail', $this->episode->cover->og_url);
        $oembed->addChild('thumbnail_width', (string) config(Images::class)->podcastCoverSizes['og']['width']);
        $oembed->addChild('thumbnail_height', (string) config(Images::class)->podcastCoverSizes['og']['height']);
        $oembed->addChild(
            'html',
            htmlspecialchars(
                '<iframe src="' .
                    $this->episode->embed_url .
                    '" width="100%" height="' . config(
                        Embed::class
                    )->height . '" frameborder="0" scrolling="no"></iframe>',
            ),
        );
        $oembed->addChild('width', (string) config(Embed::class)->width);
        $oembed->addChild('height', (string) config(Embed::class)->height);

        // @phpstan-ignore-next-line
        return $this->response->setXML($oembed);
    }

    public function episodeObject(): Response
    {
        $podcastObject = new PodcastEpisode($this->episode);

        return $this->response
            ->setContentType('application/json')
            ->setBody($podcastObject->toJSON());
    }

    public function comments(): Response
    {
        /**
         * get comments: aggregated replies from posts referring to the episode
         */
        $episodeComments = model(PostModel::class)
            ->whereIn('in_reply_to_id', function (BaseBuilder $builder): BaseBuilder {
                return $builder->select('id')
                    ->from('fediverse_posts')
                    ->where('episode_id', $this->episode->id);
            })
            ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
            ->orderBy('published_at', 'ASC');

        $pageNumber = (int) $this->request->getGet('page');

        if ($pageNumber < 1) {
            $episodeComments->paginate(12);
            $pager = $episodeComments->pager;
            $collection = new OrderedCollectionObject(null, $pager);
        } else {
            $paginatedComments = $episodeComments->paginate(12, 'default', $pageNumber);
            $pager = $episodeComments->pager;

            $orderedItems = [];
            if ($paginatedComments !== null) {
                foreach ($paginatedComments as $comment) {
                    $orderedItems[] = (new NoteObject($comment))->toArray();
                }
            }

            // @phpstan-ignore-next-line
            $collection = new OrderedCollectionPage($pager, $orderedItems);
        }

        return $this->response
            ->setContentType('application/activity+json')
            ->setHeader('Access-Control-Allow-Origin', '*')
            ->setBody($collection->toJSON());
    }
}
