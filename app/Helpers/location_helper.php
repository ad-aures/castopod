<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use Config\Services;

if (!function_exists('fetch_osm_location')) {
    /**
     * Fetches places from Nominatim OpenStreetMap
     *
     * @return array|null
     */
    function fetch_osm_location(string $locationName): ?array
    {
        $osmObject = null;

        if (!empty($locationName)) {
            try {
                $client = Services::curlrequest();

                $response = $client->request(
                    'GET',
                    'https://nominatim.openstreetmap.org/search.php?q=' .
                        urlencode($locationName) .
                        '&polygon_geojson=1&format=jsonv2',
                    [
                        'headers' => [
                            'User-Agent' => 'Castopod/' . CP_VERSION,
                            'Accept' => 'application/json',
                        ],
                    ],
                );
                $places = json_decode(
                    $response->getBody(),
                    true,
                    512,
                    JSON_THROW_ON_ERROR,
                );
                $osmObject = [
                    'geo' =>
                        empty($places[0]['lat']) || empty($places[0]['lon'])
                            ? null
                            : "geo:{$places[0]['lat']},{$places[0]['lon']}",
                    'osmid' => empty($places[0]['osm_type'])
                        ? null
                        : strtoupper(substr($places[0]['osm_type'], 0, 1)) .
                            $places[0]['osm_id'],
                ];
            } catch (Exception $exception) {
                //If things go wrong the show must go on
                log_message('critical', $exception);
            }
        }

        return $osmObject;
    }
}
