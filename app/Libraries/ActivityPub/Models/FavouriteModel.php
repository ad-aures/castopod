<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Models;

use ActivityPub\Activities\LikeActivity;
use ActivityPub\Activities\UndoActivity;
use ActivityPub\Entities\Actor;
use ActivityPub\Entities\Favourite;
use ActivityPub\Entities\Status;
use CodeIgniter\Events\Events;
use Michalsn\Uuid\UuidModel;

class FavouriteModel extends UuidModel
{
    /**
     * @var string
     */
    protected $table = 'activitypub_favourites';

    /**
     * @var string[]
     */
    protected $uuidFields = ['status_id'];

    /**
     * @var string[]
     */
    protected $allowedFields = ['actor_id', 'status_id'];

    /**
     * @var string
     */
    protected $returnType = Favourite::class;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    protected $updatedField;

    public function addFavourite(Actor $actor, Status $status, bool $registerActivity = true): void
    {
        $this->db->transStart();

        $this->insert([
            'actor_id' => $actor->id,
            'status_id' => $status->id,
        ]);

        model('StatusModel')
            ->where('id', service('uuid') ->fromString($status->id) ->getBytes())
            ->increment('favourites_count');

        if ($registerActivity) {
            $likeActivity = new LikeActivity();
            $likeActivity->set('actor', $actor->uri)
                ->set('object', $status->uri);

            $activityId = model('ActivityModel')
                ->newActivity(
                    'Like',
                    $actor->id,
                    null,
                    $status->id,
                    $likeActivity->toJSON(),
                    $status->published_at,
                    'queued',
                );

            $likeActivity->set('id', url_to('activity', $actor->username, $activityId));

            model('ActivityModel')
                ->update($activityId, [
                    'payload' => $likeActivity->toJSON(),
                ]);
        }

        Events::trigger('on_status_favourite', $actor, $status);

        model('StatusModel')
            ->clearCache($status);

        $this->db->transComplete();
    }

    public function removeFavourite(Actor $actor, Status $status, bool $registerActivity = true): void
    {
        $this->db->transStart();

        model('StatusModel')
            ->where('id', service('uuid') ->fromString($status->id) ->getBytes())
            ->decrement('favourites_count');

        $this->db
            ->table('activitypub_favourites')
            ->where([
                'actor_id' => $actor->id,
                'status_id' => service('uuid')
                    ->fromString($status->id)
                    ->getBytes(),
            ])
            ->delete();

        if ($registerActivity) {
            $undoActivity = new UndoActivity();
            // get like activity
            $activity = model('ActivityModel')
                ->where([
                    'type' => 'Like',
                    'actor_id' => $actor->id,
                    'status_id' => service('uuid')
                        ->fromString($status->id)
                        ->getBytes(),
                ])
                ->first();

            $likeActivity = new LikeActivity();
            $likeActivity
                ->set('id', base_url(route_to('activity', $actor->username, $activity->id)))
                ->set('actor', $actor->uri)
                ->set('object', $status->uri);

            $undoActivity
                ->set('actor', $actor->uri)
                ->set('object', $likeActivity);

            $activityId = model('ActivityModel')
                ->newActivity(
                    'Undo',
                    $actor->id,
                    null,
                    $status->id,
                    $undoActivity->toJSON(),
                    $status->published_at,
                    'queued',
                );

            $undoActivity->set('id', url_to('activity', $actor->username, $activityId));

            model('ActivityModel')
                ->update($activityId, [
                    'payload' => $undoActivity->toJSON(),
                ]);
        }

        Events::trigger('on_status_undo_favourite', $actor, $status);

        model('StatusModel')
            ->clearCache($status);

        $this->db->transComplete();
    }

    /**
     * Adds or removes favourite from database and increments count
     */
    public function toggleFavourite(Actor $actor, Status $status): void
    {
        if (
            $this->where([
                'actor_id' => $actor->id,
                'status_id' => service('uuid')
                    ->fromString($status->id)
                    ->getBytes(),
            ])->first()
        ) {
            $this->removeFavourite($actor, $status);
        } else {
            $this->addFavourite($actor, $status);
        }
    }
}
