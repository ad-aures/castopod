<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Entities\Podcast;
use App\Models\PodcastModel;
use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

class WebmanifestController extends Controller
{
    /**
     * @var array<string, array<string, string>>
     */
    final public const THEME_COLORS = [
        'pine' => [
            'theme' => '#009486',
            'background' => '#F0F9F8',
        ],
        'lake' => [
            'theme' => '#00ACE0',
            'background' => '#F0F7F9',
        ],
        'jacaranda' => [
            'theme' => '#562CDD',
            'background' => '#F2F0F9',
        ],
        'crimson' => [
            'theme' => '#F24562',
            'background' => '#F9F0F2',
        ],
        'amber' => [
            'theme' => '#FF6224',
            'background' => '#F9F3F0',
        ],
        'onyx' => [
            'theme' => '#040406',
            'background' => '#F3F3F7',
        ],
    ];

    public function index(): ResponseInterface
    {
        helper('misc');

        $webmanifest = [
            'name' => esc(service('settings') ->get('App.siteName')),
            'description' => esc(service('settings') ->get('App.siteDescription')),
            'lang' => service('request')
                ->getLocale(),
            'start_url' => base_url(),
            'display' => 'standalone',
            'orientation' => 'portrait',
            'theme_color' => self::THEME_COLORS[service('settings')->get('App.theme')]['theme'],
            'background_color' => self::THEME_COLORS[service('settings')->get('App.theme')]['background'],
            'icons' => [
                [
                    'src' => get_site_icon_url('192'),
                    'type' => 'image/png',
                    'sizes' => '192x192',
                ],
                [
                    'src' => get_site_icon_url('512'),
                    'type' => 'image/png',
                    'sizes' => '512x512',
                ],
            ],
        ];

        return $this->response->setJSON($webmanifest);
    }

    public function podcastManifest(string $podcastHandle): ResponseInterface
    {
        if (
            ! ($podcast = (new PodcastModel())->getPodcastByHandle($podcastHandle)) instanceof Podcast
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $webmanifest = [
            'name' => esc($podcast->title),
            'short_name' => '@' . esc($podcast->handle),
            'description' => $podcast->description,
            'lang' => $podcast->language_code,
            'start_url' => $podcast->link,
            'scope' => '/@' . esc($podcast->handle),
            'display' => 'standalone',
            'orientation' => 'portrait',
            'theme_color' => self::THEME_COLORS[service('settings')->get('App.theme')]['theme'],
            'background_color' => self::THEME_COLORS[service('settings')->get('App.theme')]['background'],
            'icons' => [
                [
                    'src' => $podcast->cover->webmanifest192_url,
                    'type' => $podcast->cover->webmanifest192_mimetype,
                    'sizes' => '192x192',
                ],
                [
                    'src' => $podcast->cover->webmanifest512_url,
                    'type' => $podcast->cover->webmanifest512_mimetype,
                    'sizes' => '512x512',
                ],
            ],
        ];

        return $this->response->setJSON($webmanifest);
    }
}
