<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Models;

use Michalsn\Uuid\UuidModel;

class ActivityModel extends UuidModel
{
    protected $table = 'activitypub_activities';
    protected $primaryKey = 'id';

    protected $uuidFields = ['id', 'note_id'];

    protected $allowedFields = [
        'id',
        'actor_id',
        'target_actor_id',
        'note_id',
        'type',
        'payload',
        'status',
        'scheduled_at',
    ];

    protected $returnType = \ActivityPub\Entities\Activity::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = true;
    protected $updatedField = null;

    public function getActivityById($activityId)
    {
        $cacheName =
            config('ActivityPub')->cachePrefix . "activity#{$activityId}";
        if (!($found = cache($cacheName))) {
            $found = $this->find($activityId);

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * Inserts a new activity record in the database
     *
     * @param string $type
     * @param integer $actorId
     * @param integer $targetActorId
     * @param integer $noteId
     * @param string $payload
     * @param \CodeIgniter\I18n\Time $scheduledAt
     * @param string $status
     *
     * @return Michalsn\Uuid\BaseResult|int|string|false
     */
    public function newActivity(
        $type,
        $actorId,
        $targetActorId,
        $noteId,
        $payload,
        $scheduledAt = null,
        $status = null
    ) {
        return $this->insert(
            [
                'actor_id' => $actorId,
                'target_actor_id' => $targetActorId,
                'note_id' => $noteId,
                'type' => $type,
                'payload' => $payload,
                'scheduled_at' => $scheduledAt,
                'status' => $status,
            ],
            true,
        );
    }

    public function getScheduledActivities()
    {
        return $this->where('`scheduled_at` <= NOW()', null, false)
            ->where('status', 'queued')
            ->orderBy('scheduled_at', 'ASC')
            ->findAll();
    }
}
