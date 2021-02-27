<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Models\EpisodeModel;
use App\Models\PodcastModel;

class Episode extends BaseController
{
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
                $params[1]
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
        self::triggerWebpageHit($this->episode->podcast_id);

        $locale = service('request')->getLocale();
        $cacheName = "page_podcast{$this->episode->podcast_id}_episode{$this->episode->id}_{$locale}";

        if (!($cachedView = cache($cacheName))) {
            $episodeModel = new EpisodeModel();
            $previousNextEpisodes = $episodeModel->getPreviousNextEpisodes(
                $this->episode,
                $this->podcast->type
            );

            helper(['persons']);
            $persons = [];
            construct_episode_person_array(
                $this->episode->episode_persons,
                $persons
            );

            $data = [
                'previousEpisode' => $previousNextEpisodes['previous'],
                'nextEpisode' => $previousNextEpisodes['next'],
                'podcast' => $this->podcast,
                'episode' => $this->episode,
                'persons' => $persons,
            ];

            $secondsToNextUnpublishedEpisode = $episodeModel->getSecondsToNextUnpublishedEpisode(
                $this->podcast->id
            );

            // The page cache is set to a decade so it is deleted manually upon podcast update
            return view('episode', $data, [
                'cache' => $secondsToNextUnpublishedEpisode
                    ? $secondsToNextUnpublishedEpisode
                    : DECADE,
                'cache_name' => $cacheName,
            ]);
        }

        return $cachedView;
    }

    public function embeddablePlayer($theme = 'light-transparent')
    {
        self::triggerWebpageHit($this->episode->podcast_id);

        $session = \Config\Services::session();
        $session->start();
        if (isset($_SERVER['HTTP_REFERER'])) {
            $session->set(
                'embeddable_player_domain',
                parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST)
            );
        }

        $locale = service('request')->getLocale();

        $cacheName = "page_podcast{$this->episode->podcast_id}_episode{$this->episode->id}_embeddable_player_{$theme}_{$locale}";

        if (!($cachedView = cache($cacheName))) {
            $episodeModel = new EpisodeModel();
            $theme = EpisodeModel::$themes[$theme];
            helper(['persons']);
            $persons = [];
            construct_episode_person_array(
                $this->episode->episode_persons,
                $persons
            );
            constructs_podcast_person_array(
                $this->podcast->podcast_persons,
                $persons
            );

            $data = [
                'podcast' => $this->podcast,
                'episode' => $this->episode,
                'persons' => $persons,
                'theme' => $theme,
            ];

            $secondsToNextUnpublishedEpisode = $episodeModel->getSecondsToNextUnpublishedEpisode(
                $this->podcast->id
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
}
