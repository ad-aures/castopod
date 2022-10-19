<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
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
            // Database has not been set or could not find the podcasts table
            // Redirecting to install page because it is likely that Castopod has not been installed yet.
            // NB: as base_url wouldn't have been defined here, redirect to install wizard manually
            $route = Services::routes()->reverseRoute('install');
            return redirect()->to(rtrim(host_url(), '/') . $route);
        }

        $sortOptions = ['activity', 'created_desc', 'created_asc'];
        $sortBy = in_array($this->request->getGet('sort'), $sortOptions, true) ? $this->request->getGet(
            'sort'
        ) : 'activity';

        $allPodcasts = (new PodcastModel())->getAllPodcasts($sortBy);

        // check if there's only one podcast to redirect user to it
        if (count($allPodcasts) === 1) {
            return redirect()->route('podcast-activity', [$allPodcasts[0]->handle]);
        }

        // default behavior: list all podcasts on home page
        $data = [
            'metatags' => get_home_metatags(),
            'podcasts' => $allPodcasts,
            'sortBy' => $sortBy,
        ];

        return view('home', $data);
    }
}
