<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Models\PodcastModel;
use CodeIgniter\Controller;

class Feed extends Controller
{
    public function index($podcast_name)
    {
        helper('rss');

        $podcast_model = new PodcastModel();
        $podcast = $podcast_model->where('name', $podcast_name)->first();

        // The page cache is set to a decade so it is deleted manually upon podcast update
        $this->cachePage(DECADE);

        return $this->response->setXML(get_rss_feed($podcast));
    }
}
