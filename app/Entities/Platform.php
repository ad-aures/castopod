<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property string $slug
 * @property string $type
 * @property string $label
 * @property string $home_url
 * @property string|null $submit_url
 * @property string|null $link_url
 * @property string|null $account_id
 * @property bool|null $is_visible
 * @property bool|null $is_on_embed
 */
class Platform extends Entity
{
    /**
     * @var array<string, string>
     */
    protected $casts = [
        'slug' => 'string',
        'type' => 'string',
        'label' => 'string',
        'home_url' => 'string',
        'submit_url' => '?string',
        'link_url' => '?string',
        'account_id' => '?string',
        'is_visible' => '?boolean',
        'is_on_embed' => '?boolean',
    ];
}
