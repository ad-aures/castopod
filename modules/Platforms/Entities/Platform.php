<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Platforms\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property int $podcast_id
 * @property string $slug
 * @property string $type
 * @property string $label
 * @property string $link_url
 * @property string|null $account_id
 * @property bool $is_visible
 * @property string $home_url
 * @property string|null $submit_url
 */
class Platform extends Entity
{
    /**
     * @var array<string, string>
     */
    protected $casts = [
        'podcast_id' => 'int',
        'slug'       => 'string',
        'type'       => 'string',
        'label'      => 'string',
        'link_url'   => 'string',
        'account_id' => '?string',
        'is_visible' => 'boolean',
        'home_url'   => 'string',
        'submit_url' => '?string',
    ];
}
