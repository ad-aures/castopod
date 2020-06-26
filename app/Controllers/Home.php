<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Models\PodcastModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new PodcastModel();

        $all_podcasts = $model->findAll();

        // check if there's only one podcast to redirect user to it
        if (count($all_podcasts) == 1) {
            return redirect()->to(
                base_url(route_to('podcast_view', $all_podcasts[0]->name))
            );
        }

        // default behavior: list all podcasts on home page
        $data = ['podcasts' => $all_podcasts];
        return view('home', $data);
    }
}
