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
        $this->podcast = (new PodcastModel())
            ->where('name', $params[0])
            ->first();

        if (
            count($params) > 1 &&
            !($this->episode = (new EpisodeModel())
                ->where([
                    'podcast_id' => $this->podcast->id,
                    'slug' => $params[1],
                ])
                ->first())
        ) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->$method();
    }

    public function index()
    {
        // The page cache is set to a decade so it is deleted manually upon podcast update
        $this->cachePage(DECADE);

        self::triggerWebpageHit($this->podcast->id);

        $data = [
            'podcast' => $this->podcast,
            'episode' => $this->episode,
        ];
        return view('episode', $data);
    }
}
