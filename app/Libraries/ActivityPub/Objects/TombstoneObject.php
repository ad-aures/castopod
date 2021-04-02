<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Objects;

use ActivityPub\Core\ObjectType;

class TombstoneObject extends ObjectType
{
    /**
     * @var string
     */
    protected $type = 'Tombstone';
}
