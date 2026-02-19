<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Models;

use CodeIgniter\Events\Events;
use Michalsn\Uuid\UuidModel;
use Modules\Fediverse\Activities\LikeActivity;
use Modules\Fediverse\Activities\UndoActivity;
use Modules\Fediverse\Entities\Actor;
use Modules\Fediverse\Entities\Favourite;
use Modules\Fediverse\Entities\Post;

class FavouriteModel extends UuidModel
{
    /**
     * @var string
     */
    protected $table = 'fediverse_favourites';

    /**
     * @var string[]
     */
    protected $uuidFields = ['post_id'];

    /**
     * @var list<string>
     */
    protected $allowedFields = ['actor_id', 'post_id'];

    /**
     * @var class-string<Favourite>
     */
    protected $returnType = Favourite::class;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    protected $updatedField = '';

    public function addFavourite(Actor $actor, Post $post, bool $registerActivity = true): void
    {
        $this->db->transStart();

        $this->insert([
            'actor_id' => $actor->id,
            'post_id'  => $post->id,
        ]);

        model('PostModel', false)
            ->builder()
            ->where('id', service('uuid') ->fromString($post->id) ->getBytes())
            ->increment('favourites_count');

        if ($registerActivity) {
            $likeActivity = new LikeActivity();
            $likeActivity->set('actor', $actor->uri)
                ->set('object', $post->uri);

            $activityId = model('ActivityModel', false)
                ->newActivity(
                    'Like',
                    $actor->id,
                    $post->actor_id,
                    $post->id,
                    $likeActivity->toJSON(),
                    $post->published_at,
                    'queued',
                );

            $likeActivity->set('id', url_to('activity', esc($actor->username), $activityId));

            model('ActivityModel', false)
                ->update($activityId, [
                    'payload' => $likeActivity->toJSON(),
                ]);
        }

        Events::trigger('on_post_favourite', $actor, $post);

        model('PostModel', false)
            ->clearCache($post);

        $this->db->transComplete();
    }

    public function removeFavourite(Actor $actor, Post $post, bool $registerActivity = true): void
    {
        $this->db->transStart();

        model('PostModel', false)
            ->builder()
            ->where('id', service('uuid') ->fromString($post->id) ->getBytes())
            ->decrement('favourites_count');

        $this->where([
            'actor_id' => $actor->id,
            'post_id'  => service('uuid')
                ->fromString($post->id)
                ->getBytes(),
        ])
            ->delete();

        if ($registerActivity) {
            $undoActivity = new UndoActivity();
            // get like activity
            $activity = model('ActivityModel', false)
                ->where([
                    'type'     => 'Like',
                    'actor_id' => $actor->id,
                    'post_id'  => service('uuid')
                        ->fromString($post->id)
                        ->getBytes(),
                ])
                ->first();

            $likeActivity = new LikeActivity();
            $likeActivity
                ->set('id', url_to('activity', esc($actor->username), $activity->id))
                ->set('actor', $actor->uri)
                ->set('object', $post->uri);

            $undoActivity
                ->set('actor', $actor->uri)
                ->set('object', $likeActivity);

            $activityId = model('ActivityModel', false)
                ->newActivity(
                    'Undo',
                    $actor->id,
                    $post->actor_id,
                    $post->id,
                    $undoActivity->toJSON(),
                    $post->published_at,
                    'queued',
                );

            $undoActivity->set('id', url_to('activity', esc($actor->username), $activityId));

            model('ActivityModel', false)
                ->update($activityId, [
                    'payload' => $undoActivity->toJSON(),
                ]);
        }

        Events::trigger('on_post_undo_favourite', $actor, $post);

        model('PostModel', false)
            ->clearCache($post);

        $this->db->transComplete();
    }

    /**
     * Adds or removes favourite from database
     */
    public function toggleFavourite(Actor $actor, Post $post): void
    {
        if (
            $this->where([
                'actor_id' => $actor->id,
                'post_id'  => service('uuid')
                    ->fromString($post->id)
                    ->getBytes(),
            ])->first() instanceof Favourite
        ) {
            $this->removeFavourite($actor, $post);
        } else {
            $this->addFavourite($actor, $post);
        }
    }
}
