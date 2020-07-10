<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */
namespace App\Controllers;

use App\Models\PodcastModel;

class Podcast extends BaseController
{
    protected ?\App\Entities\Podcast $podcast;

    public function _remap($method, ...$params)
    {
        if (count($params) > 0) {
            $podcast_model = new PodcastModel();
            if (
                !($podcast = $podcast_model->where('name', $params[0])->first())
            ) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            $this->podcast = $podcast;
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
            'episodes' => $this->podcast->episodes,
        ];
        return view('podcast', $data);
    }
}
