<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\EpisodeComment;
use App\Entities\Like;
use Michalsn\Uuid\UuidModel;
use Modules\Fediverse\Activities\LikeActivity;
use Modules\Fediverse\Activities\UndoActivity;
use Modules\Fediverse\Entities\Activity;
use Modules\Fediverse\Entities\Actor;

class LikeModel extends UuidModel
{
    /**
     * @var string
     */
    protected $table = 'likes';

    /**
     * @var string[]
     */
    protected $uuidFields = ['comment_id'];

    /**
     * @var list<string>
     */
    protected $allowedFields = ['actor_id', 'comment_id'];

    /**
     * @var class-string<Like>
     */
    protected $returnType = Like::class;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    protected $updatedField = '';

    public function addLike(Actor $actor, EpisodeComment $comment, bool $registerActivity = true): void
    {
        $this->db->transStart();

        $this->insert([
            'actor_id'   => $actor->id,
            'comment_id' => $comment->id,
        ]);

        new EpisodeCommentModel()
            ->builder()
            ->where('id', service('uuid')->fromString($comment->id)->getBytes())
            ->increment('likes_count');

        if ($registerActivity) {
            $likeActivity = new LikeActivity();
            $likeActivity->set('actor', $actor->uri)
                ->set('object', $comment->uri);

            $activityId = model('ActivityModel')
                ->newActivity(
                    'Like',
                    $actor->id,
                    null,
                    null,
                    $likeActivity->toJSON(),
                    $comment->created_at,
                    'queued',
                );

            $likeActivity->set('id', url_to('activity', esc($actor->username), $activityId));

            model('ActivityModel')
                ->update($activityId, [
                    'payload' => $likeActivity->toJSON(),
                ]);
        }

        $this->db->transComplete();
    }

    public function removeLike(Actor $actor, EpisodeComment $comment, bool $registerActivity = true): void
    {
        $this->db->transStart();

        new EpisodeCommentModel()
            ->builder()
            ->where('id', service('uuid') ->fromString($comment->id) ->getBytes())
            ->decrement('likes_count');

        $this->where([
            'actor_id'   => $actor->id,
            'comment_id' => service('uuid')
                ->fromString($comment->id)
                ->getBytes(),
        ])
            ->delete();

        if ($registerActivity) {
            $undoActivity = new UndoActivity();
            // FIXME: get like activity associated with the deleted like
            $activity = model('ActivityModel')
                ->where([
                    'type'     => 'Like',
                    'actor_id' => $actor->id,
                ])
                ->first();

            if (! $activity instanceof Activity) {
                // no like activity found, do nothing
                return;
            }

            $likeActivity = new LikeActivity();
            $likeActivity
                ->set('id', url_to('activity', esc($actor->username), $activity->id))
                ->set('actor', $actor->uri)
                ->set('object', $comment->uri);

            $undoActivity
                ->set('actor', $actor->uri)
                ->set('object', $likeActivity);

            $activityId = model('ActivityModel')
                ->newActivity(
                    'Undo',
                    $actor->id,
                    null,
                    null,
                    $undoActivity->toJSON(),
                    $comment->created_at,
                    'queued',
                );

            $undoActivity->set('id', url_to('activity', esc($actor->username), $activityId));

            model('ActivityModel')
                ->update($activityId, [
                    'payload' => $undoActivity->toJSON(),
                ]);
        }

        $this->db->transComplete();
    }

    /**
     * Adds or removes likes from database
     */
    public function toggleLike(Actor $actor, EpisodeComment $comment): void
    {
        if (
            $this->where([
                'actor_id'   => $actor->id,
                'comment_id' => service('uuid')
                    ->fromString($comment->id)
                    ->getBytes(),
            ])->first() instanceof Like
        ) {
            $this->removeLike($actor, $comment);
        } else {
            $this->addLike($actor, $comment);
        }
    }
}
