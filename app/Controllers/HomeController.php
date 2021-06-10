<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Models\PodcastModel;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Services;

class HomeController extends BaseController
{
    public function index(): RedirectResponse | string
    {
        $db = db_connect();
        if ($db->getDatabase() === '' || ! $db->tableExists('podcasts')) {
            // Database connection has not been set or could not find the podcasts table
            // Redirecting to install page because it is likely that Castopod Host has not been installed yet.
            // NB: as base_url wouldn't have been defined here, redirect to install wizard manually
            $route = Services::routes()->reverseRoute('install');
            return redirect()->to(rtrim(host_url(), '/') . $route);
        }

        $allPodcasts = (new PodcastModel())->findAll();

        // check if there's only one podcast to redirect user to it
        if (count($allPodcasts) === 1) {
            return redirect()->route('podcast-activity', [$allPodcasts[0]->name]);
        }

        // default behavior: list all podcasts on home page
        $data = [
            'podcasts' => $allPodcasts,
        ];
        return view('home', $data);
    }
}
