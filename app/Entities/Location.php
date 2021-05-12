<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property string $url
 * @property string $name
 * @property string|null $geo
 * @property string|null $osm_id
 */
class Location extends Entity
{
    /**
     * @var string
     */
    const OSM_URL = 'https://www.openstreetmap.org/';

    public function getUrl(): string
    {
        if ($this->osm_id !== null) {
            return self::OSM_URL .
                ['N' => 'node', 'W' => 'way', 'R' => 'relation'][
                    substr($this->osm_id, 0, 1)
                ] .
                '/' .
                substr($this->osm_id, 1);
        }

        if ($this->geo !== null) {
            return self::OSM_URL .
                '#map=17/' .
                str_replace(',', '/', substr($this->geo, 4));
        }

        return self::OSM_URL . 'search?query=' . urlencode($this->name);
    }
}
