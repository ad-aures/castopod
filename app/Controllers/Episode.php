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

        return $this->$method();
    }

    public function index()
    {
        self::triggerWebpageHit($this->episode->podcast_id);

        if (
            !($cachedView = cache(
                "page_podcast{$this->episode->podcast_id}_episode{$this->episode->id}"
            ))
        ) {
            $previousNextEpisodes = (new EpisodeModel())->getPreviousNextEpisodes(
                $this->episode,
                $this->podcast->type
            );

            $data = [
                'previousEpisode' => $previousNextEpisodes['previous'],
                'nextEpisode' => $previousNextEpisodes['next'],
                'podcast' => $this->podcast,
                'episode' => $this->episode,
            ];

            // The page cache is set to a decade so it is deleted manually upon podcast update
            return view('episode', $data, [
                'cache' => DECADE,
                'cache_name' => "page_podcast{$this->episode->podcast_id}_episode{$this->episode->id}",
            ]);
        }

        return $cachedView;
    }
}
