<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use Config\Services;

/**
 * @property string $url
 * @property string $name
 * @property string|null $geo
 * @property string|null $osm
 */
class Location extends Entity
{
    /**
     * @var string
     */
    private const OSM_URL = 'https://www.openstreetmap.org/';

    /**
     * @var string
     */
    private const NOMINATIM_URL = 'https://nominatim.openstreetmap.org/';

    public function __construct(
        protected string $name,
        protected ?string $geo = null,
        protected ?string $osm = null
    ) {
        parent::__construct([
            'name' => $name,
            'geo' => $geo,
            'osm' => $osm,
        ]);
    }

    public function getUrl(): string
    {
        if ($this->osm !== null) {
            return self::OSM_URL .
                [
                    'N' => 'node',
                    'W' => 'way',
                    'R' => 'relation',
                ][substr($this->osm, 0, 1)] .
                '/' .
                substr($this->osm, 1);
        }

        if ($this->geo !== null) {
            return self::OSM_URL .
                '#map=17/' .
                str_replace(',', '/', substr($this->geo, 4));
        }

        return self::OSM_URL . 'search?query=' . urlencode($this->name);
    }

    /**
     * Fetches places from Nominatim OpenStreetMap
     */
    public function fetchOsmLocation(): static
    {
        $client = Services::curlrequest();

        $response = $client->request(
            'GET',
            self::NOMINATIM_URL .
                'search.php?q=' .
                urlencode($this->name) .
                '&polygon_geojson=1&format=jsonv2',
            [
                'headers' => [
                    'User-Agent' => 'Castopod/' . CP_VERSION,
                    'Accept' => 'application/json',
                ],
            ],
        );

        $places = json_decode($response->getBody(), false, 512, JSON_THROW_ON_ERROR,);

        if ($places === []) {
            return $this;
        }

        if (property_exists($places[0], 'lat') && $places[0]->lat !== null && (property_exists(
            $places[0],
            'lon'
        ) && $places[0]->lon !== null)) {
            $this->attributes['geo'] = "geo:{$places[0]->lat},{$places[0]->lon}";
        }

        if (property_exists($places[0], 'osm_type') && $places[0]->osm_type !== null && (property_exists(
            $places[0],
            'osm_id'
        ) && $places[0]->osm_id !== null)) {
            $this->attributes['osm'] = strtoupper(substr($places[0]->osm_type, 0, 1)) . $places[0]->osm_id;
        }

        return $this;
    }
}
