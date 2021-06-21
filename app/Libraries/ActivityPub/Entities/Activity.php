<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Entities;

use Michalsn\Uuid\UuidEntity;
use RuntimeException;

/**
 * @property string $id
 * @property int $actor_id
 * @property Actor $actor
 * @property int|null $target_actor_id
 * @property Actor $target_actor
 * @property string|null $status_id
 * @property Status $status
 * @property string $type
 * @property object $payload
 * @property string|null $task_status
 * @property Time|null $scheduled_at
 * @property Time $created_at
 */
class Activity extends UuidEntity
{
    protected ?Actor $actor = null;

    protected ?Actor $target_actor = null;

    protected ?Status $status = null;

    /**
     * @var string[]
     */
    protected $uuids = ['id', 'status_id'];

    /**
     * @var string[]
     */
    protected $dates = ['scheduled_at', 'created_at'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string',
        'actor_id' => 'integer',
        'target_actor_id' => '?integer',
        'status_id' => '?string',
        'type' => 'string',
        'payload' => 'json',
        'task_status' => '?string',
    ];

    public function getActor(): Actor
    {
        if ($this->actor_id === null) {
            throw new RuntimeException('Activity must have an actor_id before getting the actor.');
        }

        if ($this->actor === null) {
            $this->actor = model('ActorModel', false)
                ->getActorById($this->actor_id);
        }

        return $this->actor;
    }

    public function getTargetActor(): Actor
    {
        if ($this->target_actor_id === null) {
            throw new RuntimeException('Activity must have a target_actor_id before getting the target actor.');
        }

        if ($this->target_actor === null) {
            $this->target_actor = model('ActorModel', false)
                ->getActorById($this->target_actor_id);
        }

        return $this->target_actor;
    }

    public function getStatus(): Status
    {
        if ($this->status_id === null) {
            throw new RuntimeException('Activity must have a status_id before getting status.');
        }

        if ($this->status === null) {
            $this->status = model('StatusModel', false)
                ->getStatusById($this->status_id);
        }

        return $this->status;
    }
}
