<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use Analytics\AnalyticsTrait;
use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use SimpleXMLElement;

class Episode extends BaseController
{
    use AnalyticsTrait;

    /**
     * @var \App\Entities\Podcast
     */
    protected $podcast;

    /**
     * @var \App\Entities\Episode|null
     */
    protected $episode;

    public function _remap($method, ...$params)
    {
        $this->podcast = (new PodcastModel())->getPodcastByName($params[0]);

        if (
            count($params) > 1 &&
            !($this->episode = (new EpisodeModel())->getEpisodeBySlug(
                $this->podcast->id,
                $params[1],
            ))
        ) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        unset($params[1]);
        unset($params[0]);
        return $this->$method(...$params);
    }

    public function index()
    {
        // Prevent analytics hit when authenticated
        if (!can_user_interact()) {
            $this->registerPodcastWebpageHit($this->episode->podcast_id);
        }

        $locale = service('request')->getLocale();
        $cacheName =
            "page_podcast#{$this->podcast->id}_episode#{$this->episode->id}_{$locale}" .
            (can_user_interact() ? '_authenticated' : '');

        if (!($cachedView = cache($cacheName))) {
            helper('persons');
            $episodePersons = [];
            construct_person_array($this->episode->persons, $episodePersons);
            $podcastPersons = [];
            construct_person_array($this->podcast->persons, $podcastPersons);

            $data = [
                'podcast' => $this->podcast,
                'episode' => $this->episode,
                'episodePersons' => $episodePersons,
                'persons' => $podcastPersons,
            ];

            $secondsToNextUnpublishedEpisode = (new EpisodeModel())->getSecondsToNextUnpublishedEpisode(
                $this->podcast->id,
            );

            if (can_user_interact()) {
                helper('form');
                return view('podcast/episode_authenticated', $data);
            } else {
                // The page cache is set to a decade so it is deleted manually upon podcast update
                return view('podcast/episode', $data, [
                    'cache' => $secondsToNextUnpublishedEpisode
                        ? $secondsToNextUnpublishedEpisode
                        : DECADE,
                    'cache_name' => $cacheName,
                ]);
            }
        }

        return $cachedView;
    }

    public function embeddablePlayer($theme = 'light-transparent')
    {
        header('Content-Security-Policy: frame-ancestors https://* http://*');

        // Prevent analytics hit when authenticated
        if (!can_user_interact()) {
            $this->registerPodcastWebpageHit($this->episode->podcast_id);
        }

        $session = \Config\Services::session();
        $session->start();
        if (isset($_SERVER['HTTP_REFERER'])) {
            $session->set(
                'embeddable_player_domain',
                parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST),
            );
        }

        $locale = service('request')->getLocale();

        $cacheName = "page_podcast#{$this->podcast->id}_episode#{$this->episode->id}_embeddable_player_{$theme}_{$locale}";

        if (!($cachedView = cache($cacheName))) {
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

    public function oembedJSON()
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
                $this->episode->embeddable_player .
                '" width="100%" height="200" frameborder="0" scrolling="no"></iframe>',
            'width' => 600,
            'height' => 200,
            'thumbnail_url' => $this->episode->image->large_url,
            'thumbnail_width' => config('Images')->largeSize,
            'thumbnail_height' => config('Images')->largeSize,
        ]);
    }

    public function oembedXML()
    {
        $oembed = new SimpleXMLElement(
            "<?xml version='1.0' encoding='utf-8' standalone='yes'?><oembed></oembed>",
        );

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
                    $this->episode->embeddable_player .
                    '" width="100%" height="200" frameborder="0" scrolling="no"></iframe>',
            ),
        );
        $oembed->addChild('width', 600);
        $oembed->addChild('height', 200);

        return $this->response->setXML($oembed);
    }
}
