<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use Analytics\AnalyticsTrait;
use App\Entities\Episode;
use App\Entities\Podcast;
use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
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
            ($this->podcast = (new PodcastModel())->getPodcastByName($params[0],)) === null
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (
            ($this->episode = (new EpisodeModel())->getEpisodeBySlug($params[0], $params[1],)) !== null
        ) {
            unset($params[1]);
            unset($params[0]);
            return $this->{$method}(...$params);
        }

        throw PageNotFoundException::forPageNotFound();
    }

    public function index(): string
    {
        // Prevent analytics hit when authenticated
        if (! can_user_interact()) {
            $this->registerPodcastWebpageHit($this->episode->podcast_id);
        }

        $locale = service('request')
            ->getLocale();
        $cacheName =
            "page_podcast#{$this->podcast->id}_episode#{$this->episode->id}_{$locale}" .
            (can_user_interact() ? '_authenticated' : '');

        if (! ($cachedView = cache($cacheName))) {
            $data = [
                'podcast' => $this->podcast,
                'episode' => $this->episode,
            ];

            $secondsToNextUnpublishedEpisode = (new EpisodeModel())->getSecondsToNextUnpublishedEpisode(
                $this->podcast->id,
            );

            if (can_user_interact()) {
                helper('form');
                return view('podcast/episode_authenticated', $data);
            }
            // The page cache is set to a decade so it is deleted manually upon podcast update
            return view('podcast/episode', $data, [
                'cache' => $secondsToNextUnpublishedEpisode
                    ? $secondsToNextUnpublishedEpisode
                    : DECADE,
                'cache_name' => $cacheName,
            ]);
        }

        return $cachedView;
    }

    public function embeddablePlayer(string $theme = 'light-transparent'): string
    {
        header('Content-Security-Policy: frame-ancestors https://* http://*');

        // Prevent analytics hit when authenticated
        if (! can_user_interact()) {
            $this->registerPodcastWebpageHit($this->episode->podcast_id);
        }

        $session = Services::session();
        $session->start();
        if (isset($_SERVER['HTTP_REFERER'])) {
            $session->set('embeddable_player_domain', parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST));
        }

        $locale = service('request')
            ->getLocale();

        $cacheName = "page_podcast#{$this->podcast->id}_episode#{$this->episode->id}_embeddable_player_{$theme}_{$locale}";

        if (! ($cachedView = cache($cacheName))) {
            $theme = EpisodeModel::$themes[$theme];

            $data = [
                'podcast' => $this->podcast,
                'episode' => $this->episode,
                'theme' => $theme,
            ];

            $secondsToNextUnpublishedEpisode = (new EpisodeModel())->getSecondsToNextUnpublishedEpisode(
                $this->podcast->id,
            );

            // The page cache is set to a decade so it is deleted manually upon podcast update
            return view('embeddable_player', $data, [
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
            'type' => 'rich',
            'version' => '1.0',
            'title' => $this->episode->title,
            'provider_name' => $this->podcast->title,
            'provider_url' => $this->podcast->link,
            'author_name' => $this->podcast->title,
            'author_url' => $this->podcast->link,
            'html' =>
                '<iframe src="' .
                $this->episode->embeddable_player_url .
                '" width="100%" height="200" frameborder="0" scrolling="no"></iframe>',
            'width' => 600,
            'height' => 200,
            'thumbnail_url' => $this->episode->image->large_url,
            'thumbnail_width' => config('Images')
                ->largeSize,
            'thumbnail_height' => config('Images')
                ->largeSize,
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
        $oembed->addChild('thumbnail', $this->episode->image->large_url);
        $oembed->addChild('thumbnail_width', config('Images')->largeSize);
        $oembed->addChild('thumbnail_height', config('Images')->largeSize);
        $oembed->addChild(
            'html',
            htmlentities(
                '<iframe src="' .
                    $this->episode->embeddable_player_url .
                    '" width="100%" height="200" frameborder="0" scrolling="no"></iframe>',
            ),
        );
        $oembed->addChild('width', '600');
        $oembed->addChild('height', '200');

        return $this->response->setXML((string) $oembed);
    }
}
