<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Entities;

use Michalsn\Uuid\UuidEntity;

class Favourite extends UuidEntity
{
    protected $uuids = ['note_id'];

    protected $casts = [
        'actor_id' => 'integer',
        'note_id' => 'integer',
    ];
}
