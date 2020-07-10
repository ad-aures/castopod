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
    protected \App\Entities\Podcast $podcast;
    protected ?\App\Entities\Episode $episode;

    public function _remap($method, ...$params)
    {
        $podcast_model = new PodcastModel();

        $this->podcast = $podcast_model->where('name', $params[0])->first();

        if (count($params) > 1) {
            $episode_model = new EpisodeModel();
            if (
                !($episode = $episode_model
                    ->where([
                        'podcast_id' => $this->podcast->id,
                        'slug' => $params[1],
                    ])
                    ->first())
            ) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            $this->episode = $episode;
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
