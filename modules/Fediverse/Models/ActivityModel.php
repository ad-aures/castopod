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
use Modules\Fediverse\Entities\Activity;

class ActivityModel extends BaseUuidModel
{
    /**
     * @var string
     */
    protected $table = 'activities';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var string[]
     */
    protected $uuidFields = ['id', 'post_id'];

    /**
     * @var string[]
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
     * @param Time $scheduledAt
     */
    public function newActivity(
        string $type,
        int $actorId,
        ?int $targetActorId,
        ?string $postId,
        string $payload,
        DateTimeInterface $scheduledAt = null,
        ?string $taskStatus = null
    ): BaseResult | int | string | false {
        return $this->insert(
            [
                'actor_id' => $actorId,
                'target_actor_id' => $targetActorId,
                'post_id' => $postId,
                'type' => $type,
                'payload' => $payload,
                'scheduled_at' => $scheduledAt,
                'status' => $taskStatus,
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
