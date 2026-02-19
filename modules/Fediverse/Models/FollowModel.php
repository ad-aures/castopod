<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Models;

use CodeIgniter\Events\Events;
use CodeIgniter\I18n\Time;
use CodeIgniter\Model;
use Exception;
use Modules\Fediverse\Activities\FollowActivity;
use Modules\Fediverse\Activities\UndoActivity;
use Modules\Fediverse\Entities\Actor;
use Modules\Fediverse\Entities\Follow;

class FollowModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'fediverse_follows';

    /**
     * @var list<string>
     */
    protected $allowedFields = ['actor_id', 'target_actor_id'];

    /**
     * @var class-string<Follow>
     */
    protected $returnType = Follow::class;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    protected $updatedField = '';

    /**
     * @param Actor $actor Actor that is following
     * @param Actor $targetActor Actor that is being followed
     */
    public function addFollower(Actor $actor, Actor $targetActor, bool $registerActivity = true): void
    {
        try {
            $this->db->transStart();

            $this->insert([
                'actor_id'        => $actor->id,
                'target_actor_id' => $targetActor->id,
            ]);

            // increment followers_count for target actor
            model('ActorModel', false)
                ->builder()
                ->where('id', $targetActor->id)
                ->increment('followers_count');

            if ($registerActivity) {
                $followActivity = new FollowActivity();

                $followActivity
                    ->set('actor', $actor->uri)
                    ->set('object', $targetActor->uri);

                $activityId = model('ActivityModel', false)
                    ->newActivity(
                        'Follow',
                        $actor->id,
                        $targetActor->id,
                        null,
                        $followActivity->toJSON(),
                        Time::now(),
                        'queued',
                    );

                $followActivity->set('id', url_to('activity', esc($actor->username), $activityId));

                model('ActivityModel', false)
                    ->update($activityId, [
                        'payload' => $followActivity->toJSON(),
                    ]);
            }

            Events::trigger('on_follow', $actor, $targetActor);

            model('ActorModel', false)
                ->clearCache($targetActor);

            $this->db->transComplete();
        } catch (Exception) {
            // follow already exists, do nothing
        }
    }

    /**
     * @param Actor $actor Actor that is unfollowing
     * @param Actor $targetActor Actor that is being unfollowed
     */
    public function removeFollower(Actor $actor, Actor $targetActor, bool $registerActivity = true): void
    {
        $this->db->transStart();

        $this->where([
            'actor_id'        => $actor->id,
            'target_actor_id' => $targetActor->id,
        ])->delete();

        // decrement followers_count for target actor
        model('ActorModel', false)
            ->builder()
            ->where('id', $targetActor->id)
            ->decrement('followers_count');

        if ($registerActivity) {
            $undoActivity = new UndoActivity();
            // get follow activity from database
            $followActivity = model('ActivityModel', false)
                ->where([
                    'type'            => 'Follow',
                    'actor_id'        => $actor->id,
                    'target_actor_id' => $targetActor->id,
                ])
                ->first();

            $undoActivity
                ->set('actor', $actor->uri)
                ->set('object', $followActivity->payload);

            $activityId = model('ActivityModel', false)
                ->newActivity(
                    'Undo',
                    $actor->id,
                    $targetActor->id,
                    null,
                    $undoActivity->toJSON(),
                    Time::now(),
                    'queued',
                );

            $undoActivity->set('id', url_to('activity', esc($actor->username), $activityId));

            model('ActivityModel', false)
                ->update($activityId, [
                    'payload' => $undoActivity->toJSON(),
                ]);
        }

        Events::trigger('on_undo_follow', $actor, $targetActor);

        model('ActorModel', false)
            ->clearCache($targetActor);

        $this->db->transComplete();
    }
}
