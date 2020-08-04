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
    public function index($podcastName)
    {
        // The page cache is set to a decade so it is deleted manually upon podcast update
        $this->cachePage(DECADE);

        helper('rss');

        $podcast = (new PodcastModel())->where('name', $podcastName)->first();

        return $this->response->setXML(get_rss_feed($podcast));
    }
}
