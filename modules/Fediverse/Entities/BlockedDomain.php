<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property string $name
 */
class BlockedDomain extends Entity
{
    /**
     * @var array<string, string>
     */
    protected $casts = [
        'name' => 'string',
    ];
}
