<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Models;

use ActivityPub\Activities\FollowActivity;
use ActivityPub\Activities\UndoActivity;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\I18n\Time;
use CodeIgniter\Model;
use InvalidArgumentException;

class FollowModel extends Model
{
    protected $table = 'activitypub_follows';

    protected $allowedFields = ['actor_id', 'target_actor_id'];

    protected $returnType = \ActivityPub\Entities\Follow::class;

    protected $useTimestamps = true;
    protected $updatedField = null;

    /**
     *
     * @param \ActivityPub\Entities\Actor $actor
     * @param \ActivityPub\Entities\Actor $targetActor
     * @param bool $registerActivity
     * @return void
     * @throws DatabaseException
     */
    public function addFollower($actor, $targetActor, $registerActivity = true)
    {
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
        } catch (\Exception $e) {
            // follow already exists, do nothing
        }
    }

    /**
     * @param \ActivityPub\Entities\Actor $actor
     * @param \ActivityPub\Entities\Actor $targetActor
     * @return void
     * @throws InvalidArgumentException
     * @throws DatabaseException
     */
    public function removeFollower(
        $actor,
        $targetActor,
        $registerActivity = true
    ) {
        $this->db->transStart();

        $this->where([
            'actor_id' => $actor->id,
            'target_actor_id' => $targetActor->id,
        ])->delete();

        // decrement followers_count for target actor
        model('ActorModel')
            ->where('id', $targetActor->id)
            ->decrement('followers_count');

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
