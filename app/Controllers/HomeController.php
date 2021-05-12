<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Models\PodcastModel;

class HomeController extends BaseController
{
    /**
     * @return mixed
     */
    public function index()
    {
        $model = new PodcastModel();

        $allPodcasts = $model->findAll();

        // check if there's only one podcast to redirect user to it
        if (count($allPodcasts) == 1) {
            return redirect()->route('podcast-activity', [
                $allPodcasts[0]->name,
            ]);
        }

        // default behavior: list all podcasts on home page
        $data = ['podcasts' => $allPodcasts];
        return view('home', $data);
    }
}
