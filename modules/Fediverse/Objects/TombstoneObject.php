<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Objects;

use Modules\Fediverse\Core\ObjectType;

class TombstoneObject extends ObjectType
{
    protected string $type = 'Tombstone';
}
