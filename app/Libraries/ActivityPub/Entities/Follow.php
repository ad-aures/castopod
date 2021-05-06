<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Entities;

use CodeIgniter\Entity\Entity;

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
