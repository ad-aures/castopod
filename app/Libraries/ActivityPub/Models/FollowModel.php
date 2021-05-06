<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Models;

use ActivityPub\Entities\Actor;
use ActivityPub\Entities\Follow;
use Exception;
use ActivityPub\Activities\FollowActivity;
use ActivityPub\Activities\UndoActivity;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\I18n\Time;
use CodeIgniter\Model;
use InvalidArgumentException;

class FollowModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'activitypub_follows';

    /**
     * @var string[]
     */
    protected $allowedFields = ['actor_id', 'target_actor_id'];

    /**
     * @var string
     */
    protected $returnType = Follow::class;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    protected $updatedField;

    /**
     * @param Actor $actor Actor that is following
     * @param Actor $targetActor Actor that is being followed
     * @throws DatabaseException
     */
    public function addFollower(
        Actor $actor,
        Actor $targetActor,
        bool $registerActivity = true
    ): void {
        try {
            $this->db->transStart();

            $this->insert([
                'actor_id' => $actor->id,
                'target_actor_id' => $targetActor->id,
            ]);

            // increment followers_count for target actor
            model('ActorModel')
                ->where('id', $targetActor->id)
                ->increment('followers_count');

            cache()->delete(
                config('ActivityPub')->cachePrefix . "actor#{$targetActor->id}",
            );
            cache()->delete(
                config('ActivityPub')->cachePrefix .
                    "actor#{$targetActor->id}_followers",
            );

            if ($registerActivity) {
                $followActivity = new FollowActivity();

                $followActivity
                    ->set('actor', $actor->uri)
                    ->set('object', $targetActor->uri);

                $activityId = model('ActivityModel')->newActivity(
                    'Follow',
                    $actor->id,
                    $targetActor->id,
                    null,
                    $followActivity->toJSON(),
                    Time::now(),
                    'queued',
                );

                $followActivity->set(
                    'id',
                    base_url(
                        route_to('activity', $actor->username, $activityId),
                    ),
                );

                model('ActivityModel')->update($activityId, [
                    'payload' => $followActivity->toJSON(),
                ]);
            }

            $this->db->transComplete();
        } catch (Exception $exception) {
            // follow already exists, do nothing
        }
    }

    /**
     * @param Actor $actor Actor that is unfollowing
     * @param Actor $targetActor Actor that is being unfollowed
     * @throws InvalidArgumentException
     * @throws DatabaseException
     */
    public function removeFollower(
        Actor $actor,
        Actor $targetActor,
        $registerActivity = true
    ): void {
        $this->db->transStart();

        $this->where([
            'actor_id' => $actor->id,
            'target_actor_id' => $targetActor->id,
        ])->delete();

        // decrement followers_count for target actor
        model('ActorModel')
            ->where('id', $targetActor->id)
            ->decrement('followers_count');

        cache()->delete(
            config('ActivityPub')->cachePrefix . "actor#{$targetActor->id}",
        );
        cache()->delete(
            config('ActivityPub')->cachePrefix .
                "actor#{$targetActor->id}_followers",
        );

        if ($registerActivity) {
            $undoActivity = new UndoActivity();
            // get follow activity from database
            $followActivity = model('ActivityModel')
                ->where([
                    'type' => 'Follow',
                    'actor_id' => $actor->id,
                    'target_actor_id' => $targetActor->id,
                ])
                ->first();

            $undoActivity
                ->set('actor', $actor->uri)
                ->set('object', $followActivity->payload);

            $activityId = model('ActivityModel')->newActivity(
                'Undo',
                $actor->id,
                $targetActor->id,
                null,
                $undoActivity->toJSON(),
                Time::now(),
                'queued',
            );

            $undoActivity->set(
                'id',
                url_to('activity', $actor->username, $activityId),
            );

            model('ActivityModel')->update($activityId, [
                'payload' => $undoActivity->toJSON(),
            ]);
        }

        $this->db->transComplete();
    }
}
