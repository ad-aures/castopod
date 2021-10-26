<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class WebmanifestController extends Controller
{
    public function index(): ResponseInterface
    {
        $webmanifest = [
            'name' => service('settings')
                ->get('App.siteName'),
            'description' => service('settings')
                ->get('App.siteDescription'),
            'display' => 'minimal-ui',
            'theme_color' => '#009486',
            'icons' => [
                [
                    'src' => service('settings')
                        ->get('App.siteIcon')['192'],
                    'type' => 'image/png',
                    'sizes' => '192x192',
                ],
                [
                    'src' => service('settings')
                        ->get('App.siteIcon')['512'],
                    'type' => 'image/png',
                    'sizes' => '512x512',
                ],
            ],
        ];

        return $this->response->setJSON($webmanifest);
    }
}
