<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity;

class Podcast extends Entity
{
    protected $casts = [
        'title' => 'string',
        'name' => 'string',
        'description' => 'string',
        'episode_description_footer' => '?string',
        'image' => 'string',
        'language' => 'string',
        'category' => 'array',
        'explicit' => 'boolean',
        'author' => '?string',
        'owner_name' => '?string',
        'owner_email' => '?string',
        'type' => '?string',
        'copyright' => '?string',
        'block' => 'boolean',
        'complete' => 'boolean',
        'custom_html_head' => '?string',
    ];
}
