<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

class ActorModel extends \ActivityPub\Models\ActorModel
{
    protected $returnType = \App\Entities\Actor::class;
}
