<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Models;

use ActivityPub\Entities\Activity;
use CodeIgniter\Database\BaseResult;
use CodeIgniter\I18n\Time;
use DateTimeInterface;
use Michalsn\Uuid\UuidModel;

class ActivityModel extends UuidModel
{
    /**
     * @var string
     */
    protected $table = 'activitypub_activities';
    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var string[]
     */
    protected $uuidFields = ['id', 'note_id'];

    /**
     * @var string[]
     */
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

    /**
     * @var string
     */
    protected $returnType = Activity::class;
    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = true;
    protected $updatedField;

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
     * @param Time $scheduledAt
     *
     * @return BaseResult|int|string|false
     */
    public function newActivity(
        string $type,
        int $actorId,
        ?int $targetActorId,
        ?string $noteId,
        string $payload,
        DateTimeInterface $scheduledAt = null,
        ?string $status = null
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
