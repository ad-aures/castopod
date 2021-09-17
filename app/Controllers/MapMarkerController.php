<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Entities\Page;
use App\Models\EpisodeModel;
use CodeIgniter\HTTP\ResponseInterface;

class MapMarkerController extends BaseController
{
    public function index(): string
    {
        $locale = service('request')
            ->getLocale();
        $cacheName = "page_map_{$locale}";
        if (! ($found = cache($cacheName))) {
            $found = view('map', [], [
                'cache' => DECADE,
                'cache_name' => $cacheName,
            ]);
        }
        return $found;
    }

    public function getEpisodesMarkers(): ResponseInterface
    {
        $cacheName = 'episodes_markers';
        if (! ($found = cache($cacheName))) {
            $episodes = (new EpisodeModel())->where('location_geo is not', null)
                ->findAll();
            $found = [];
            foreach ($episodes as $episode) {
                $found[] = [
                    'latitude' => $episode->location->latitude,
                    'longitude' => $episode->location->longitude,
                    'location_name' => $episode->location->name,
                    'location_url' => $episode->location->url,
                    'episode_link' => $episode->link,
                    'podcast_link' => $episode->podcast->link,
                    'image_path' => $episode->image->thumbnail_url,
                    'podcast_title' => $episode->podcast->title,
                    'episode_title' => $episode->title,
                ];
            }
            // The page cache is set to a decade so it is deleted manually upon episode update
            cache()
                ->save($cacheName, $found, DECADE);
        }
        return $this->response->setJSON($found);
    }
}
