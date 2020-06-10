<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity;

class Episode extends Entity
{
    protected $casts = [
        'slug' => 'string',
        'title' => 'string',
        'enclosure_url' => 'string',
        'enclosure_length' => 'integer',
        'enclosure_type' => 'string',
        'guid' => 'string',
        'pub_date' => 'datetime',
        'description' => 'string',
        'duration' => 'integer',
        'image' => 'string',
        'explicit' => 'boolean',
        'episode_number' => 'integer',
        'season_number' => '?integer',
        'type' => 'string',
        'block' => 'boolean',
    ];
}
