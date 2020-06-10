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
        $data = ['podcasts' => $model->findAll()];

        return view('home', $data);
    }
}
