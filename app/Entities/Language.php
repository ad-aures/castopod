<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property string $code
 * @property string $native_name
 */
class Language extends Entity
{
    /**
     * @var array<string, string>
     */
    protected $casts = [
        'code' => 'string',
        'native_name' => 'string',
    ];
}
