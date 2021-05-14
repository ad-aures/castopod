<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use ActivityPub\Models\ActorModel as ActivityPubActorModel;
use App\Entities\Actor;

class ActorModel extends ActivityPubActorModel
{
    /**
     * @var string
     */
    protected $returnType = Actor::class;
}
