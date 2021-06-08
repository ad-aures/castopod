<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property int $actor_id
 * @property int $target_actor_id
 */
class Follow extends Entity
{
    /**
     * @var array<string, string>
     */
    protected $casts = [
        'actor_id' => 'integer',
        'target_actor_id' => 'integer',
    ];
}
