<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\Actor;
use Modules\Fediverse\Models\ActorModel as FediverseActorModel;
use Override;

class ActorModel extends FediverseActorModel
{
    /**
     * @var class-string<Actor>
     */
    protected $returnType = Actor::class;

    #[Override]
    public function getActorById(int $id): ?Actor
    {
        return $this->find($id);
    }
}
