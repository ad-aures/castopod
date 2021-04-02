<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Entities;

use Michalsn\Uuid\UuidEntity;

class Activity extends UuidEntity
{
    protected $uuids = ['id', 'note_id'];

    /**
     * @var \ActivityPub\Entities\Actor
     */
    protected $actor;

    /**
     * @var \ActivityPub\Entities\Actor
     */
    protected $target_actor;

    /**
     * @var \ActivityPub\Entities\Note
     */
    protected $note;

    protected $dates = ['scheduled_at', 'created_at'];

    protected $casts = [
        'id' => 'string',
        'actor_id' => 'integer',
        'target_actor_id' => '?integer',
        'note_id' => '?string',
        'type' => 'string',
        'payload' => 'json',
        'status' => '?string',
    ];

    /**
     * @return \ActivityPub\Entities\Actor
     */
    public function getActor()
    {
        if (empty($this->actor_id)) {
            throw new \RuntimeException(
                'Activity must have an actor_id before getting the actor.',
            );
        }

        if (empty($this->actor)) {
            $this->actor = model('ActorModel')->getActorById($this->actor_id);
        }

        return $this->actor;
    }

    /**
     * @return \ActivityPub\Entities\Actor
     */
    public function getTargetActor()
    {
        if (empty($this->target_actor_id)) {
            throw new \RuntimeException(
                'Activity must have a target_actor_id before getting the target actor.',
            );
        }

        if (empty($this->target_actor)) {
            $this->target_actor = model('ActorModel')->getActorById(
                $this->target_actor_id,
            );
        }

        return $this->target_actor;
    }

    /**
     * @return \ActivityPub\Entities\Note
     */
    public function getNote()
    {
        if (empty($this->note_id)) {
            throw new \RuntimeException(
                'Activity must have a note_id before getting note.',
            );
        }

        if (empty($this->note)) {
            $this->note = model('NoteModel')->getNoteById($this->note_id);
        }

        return $this->note;
    }
}
