<?php

declare(strict_types=1);

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
    protected $uuidFields = ['id', 'status_id'];

    /**
     * @var string[]
     */
    protected $allowedFields = [
        'id',
        'actor_id',
        'target_actor_id',
        'status_id',
        'type',
        'payload',
        'task_status',
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

    public function getActivityById(string $activityId): ?Activity
    {
        $cacheName =
            config('ActivityPub')
                ->cachePrefix . "activity#{$activityId}";
        if (! ($found = cache($cacheName))) {
            $found = $this->find($activityId);

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * Inserts a new activity record in the database
     *
     * @param Time $scheduledAt
     */
    public function newActivity(
        string $type,
        int $actorId,
        ?int $targetActorId,
        ?string $statusId,
        string $payload,
        DateTimeInterface $scheduledAt = null,
        ?string $taskStatus = null
    ): BaseResult | int | string | false {
        return $this->insert(
            [
                'actor_id' => $actorId,
                'target_actor_id' => $targetActorId,
                'status_id' => $statusId,
                'type' => $type,
                'payload' => $payload,
                'scheduled_at' => $scheduledAt,
                'task_status' => $taskStatus,
            ],
            true,
        );
    }

    /**
     * @return Activity[]
     */
    public function getScheduledActivities(): array
    {
        return $this->where('`scheduled_at` <= NOW()', null, false)
            ->where('status', 'queued')
            ->orderBy('scheduled_at', 'ASC')
            ->findAll();
    }
}
