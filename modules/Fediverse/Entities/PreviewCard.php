<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property int $id
 * @property string $post_id
 * @property string $url
 * @property string $title
 * @property string $description
 * @property string $type
 * @property string|null $author_name
 * @property string|null $author_url
 * @property string|null $provider_name
 * @property string|null $provider_url
 * @property string|null $image
 * @property string|null $html
 */
class PreviewCard extends Entity
{
    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'post_id' => 'string',
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
