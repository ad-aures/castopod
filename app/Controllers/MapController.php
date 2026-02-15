<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Models\EpisodeModel;
use CodeIgniter\HTTP\ResponseInterface;

class MapController extends BaseController
{
    public function index(): string
    {
        $cacheName = implode(
            '_',
            array_filter([
                'page',
                'map',
                service('request')
                    ->getLocale(),
                auth()
                    ->loggedIn() ? 'authenticated' : null,
            ]),
        );

        if (! ($found = cache($cacheName))) {
            return view('pages/map', [], [
                'cache'      => DECADE,
                'cache_name' => $cacheName,
            ]);
        }

        return $found;
    }

    public function getEpisodesMarkers(): ResponseInterface
    {
        $cacheName = 'episodes_markers';
        if (! ($found = cache($cacheName))) {
            $episodes = new EpisodeModel()
                ->where('`published_at` <= UTC_TIMESTAMP()', null, false)
                ->where('location_geo is not')
                ->findAll();
            $found = [];
            foreach ($episodes as $episode) {
                $found[] = [
                    'latitude'      => $episode->location->latitude,
                    'longitude'     => $episode->location->longitude,
                    'location_name' => esc($episode->location->name),
                    'location_url'  => $episode->location->url,
                    'episode_link'  => $episode->link,
                    'podcast_link'  => $episode->podcast->link,
                    'cover_url'     => $episode->cover->thumbnail_url,
                    'podcast_title' => esc($episode->podcast->title),
                    'episode_title' => esc($episode->title),
                ];
            }

            // The page cache is set to a decade so it is deleted manually upon episode update
            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $this->response->setJSON($found);
    }
}
