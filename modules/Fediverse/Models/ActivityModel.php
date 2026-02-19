<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Models;

use CodeIgniter\Database\BaseResult;
use CodeIgniter\I18n\Time;
use DateTimeInterface;
use Michalsn\Uuid\UuidModel;
use Modules\Fediverse\Entities\Activity;

class ActivityModel extends UuidModel
{
    /**
     * @var string
     */
    protected $table = 'fediverse_activities';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var string[]
     */
    protected $uuidFields = ['id', 'post_id'];

    /**
     * @var list<string>
     */
    protected $afterInsert = ['notify'];

    /**
     * @var list<string>
     */
    protected $afterUpdate = ['notify'];

    /**
     * @var list<string>
     */
    protected $allowedFields = [
        'id',
        'actor_id',
        'target_actor_id',
        'post_id',
        'type',
        'payload',
        'status',
        'scheduled_at',
    ];

    /**
     * @var class-string<Activity>
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

    protected $updatedField = '';

    public function getActivityById(string $activityId): ?Activity
    {
        $cacheName =
            config('Fediverse')
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
     * @param Time|null $scheduledAt
     */
    public function newActivity(
        string $type,
        int $actorId,
        ?int $targetActorId,
        ?string $postId,
        string $payload,
        ?DateTimeInterface $scheduledAt = null,
        ?string $taskStatus = null,
    ): BaseResult | int | string | false {
        return $this->insert(
            [
                'actor_id'        => $actorId,
                'target_actor_id' => $targetActorId,
                'post_id'         => $postId,
                'type'            => $type === 'Undo' ? $type . '_' . (json_decode(
                    $payload,
                    true,
                ))['object']['type'] : $type,
                'payload'      => $payload,
                'scheduled_at' => $scheduledAt,
                'status'       => $taskStatus,
            ],
            true,
        );
    }

    /**
     * @return Activity[]
     */
    public function getScheduledActivities(int $limit = 10): array
    {
        return $this->where('`scheduled_at` <= UTC_TIMESTAMP()', null, false)
            ->where('status', 'queued')
            ->orderBy('scheduled_at', 'ASC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * @param array<mixed> $data
     * @return array<string, array<string|int, mixed>>
     */
    protected function notify(array $data): array
    {
        /** @var ?Activity $activity */
        $activity = new self()
            ->find(is_array($data['id']) ? $data['id'][0] : $data['id']);

        if (! $activity instanceof Activity) {
            return $data;
        }

        if ($activity->target_actor_id === $activity->actor_id) {
            return $data;
        }

        // notify only if incoming activity (with status set to NULL) is created
        if ($activity->status !== null) {
            return $data;
        }

        if ($activity->type === 'Follow') {
            new NotificationModel()
                ->insert([
                    'actor_id'        => $activity->actor_id,
                    'target_actor_id' => $activity->target_actor_id,
                    'activity_id'     => $activity->id,
                    'type'            => 'follow',
                    'created_at'      => $activity->created_at,
                ]);
        } elseif ($activity->type === 'Undo_Follow') {
            new NotificationModel()
                ->builder()
                ->delete([
                    'actor_id'        => $activity->actor_id,
                    'target_actor_id' => $activity->target_actor_id,
                    'type'            => 'follow',
                ]);
        } elseif (in_array($activity->type, ['Create', 'Like', 'Announce'], true) && $activity->post_id !== null) {
            new NotificationModel()
                ->insert([
                    'actor_id'        => $activity->actor_id,
                    'target_actor_id' => $activity->target_actor_id,
                    'post_id'         => $activity->post_id,
                    'activity_id'     => $activity->id,
                    'type'            => match ($activity->type) {
                        'Create'   => 'reply',
                        'Like'     => 'like',
                        'Announce' => 'share',
                    },
                    'created_at' => $activity->created_at,
                ]);
        } elseif (in_array($activity->type, ['Undo_Like', 'Undo_Announce'], true) && $activity->post_id !== null) {
            new NotificationModel()
                ->builder()
                ->delete([
                    'actor_id'        => $activity->actor_id,
                    'target_actor_id' => $activity->target_actor_id,
                    'post_id'         => service('uuid')
                        ->fromString($activity->post_id)
                        ->getBytes(),
                    'type' => match ($activity->type) {
                        'Undo_Like'     => 'like',
                        'Undo_Announce' => 'share',
                    },
                ]);
        }

        return $data;
    }
}
