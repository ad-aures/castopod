<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Entities;

use CodeIgniter\Entity;

class PreviewCard extends Entity
{
    protected $casts = [
        'id' => 'integer',
        'note_id' => 'string',
        'url' => 'string',
        'title' => 'string',
        'description' => 'string',
        'type' => 'string',
        'author_name' => '?string',
        'author_url' => '?string',
        'provider_name' => '?string',
        'provider_url' => '?string',
        'image' => '?string',
        'html' => '?string',
    ];
}
