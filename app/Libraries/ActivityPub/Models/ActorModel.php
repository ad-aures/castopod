<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Models;

use CodeIgniter\Events\Events;
use CodeIgniter\Model;

class ActorModel extends Model
{
    protected $table = 'activitypub_actors';

    protected $allowedFields = [
        'id',
        'uri',
        'username',
        'domain',
        'display_name',
        'summary',
        'private_key',
        'public_key',
        'avatar_image_url',
        'avatar_image_mimetype',
        'cover_image_url',
        'cover_image_mimetype',
        'inbox_url',
        'outbox_url',
        'followers_url',
        'followers_count',
        'notes_count',
        'is_blocked',
    ];

    protected $returnType = \ActivityPub\Entities\Actor::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = true;

    public function getActorById($id)
    {
        $cacheName = config('ActivityPub')->cachePrefix . "actor#{$id}";
        if (!($found = cache($cacheName))) {
            $found = $this->find($id);

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * Looks for actor with username and domain,
     * if no domain has been specified, the current host will be used
     *
     * @param mixed $username
     * @param mixed|null $domain
     * @return mixed
     */
    public function getActorByUsername($username, $domain = null)
    {
        // TODO: is there a better way?
        helper('activitypub');

        if (!$domain) {
            $domain = get_current_domain();
        }

        if (!($found = cache("actor@{$username}@{$domain}"))) {
            $found = $this->where([
                'username' => $username,
                'domain' => $domain,
            ])->first();

            cache()->save("actor@{$username}@{$domain}", $found, DECADE);
        }

        return $found;
    }

    public function getActorByUri($actorUri)
    {
        $hashedActorUri = md5($actorUri);
        $cacheName =
            config('ActivityPub')->cachePrefix . "actor@{$hashedActorUri}";
        if (!($found = cache($cacheName))) {
            $found = $this->where('uri', $actorUri)->first();

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getFollowers($actorId)
    {
        $cacheName =
            config('ActivityPub')->cachePrefix . "actor#{$actorId}_followers";
        if (!($found = cache($cacheName))) {
            $found = $this->join(
                'activitypub_follows',
                'activitypub_follows.actor_id = id',
                'inner',
            )
                ->where('activitypub_follows.target_actor_id', $actorId)
                ->findAll();

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * Check if an existing actor is blocked using its uri.
     * Returns FALSE if the actor doesn't exist
     *
     * @param mixed $actorUri
     * @return boolean
     */
    public function isActorBlocked($actorUri)
    {
        if ($actor = $this->getActorByUri($actorUri)) {
            return $actor->is_blocked;
        }

        return false;
    }

    /**
     * Retrieves all blocked actors.
     *
     * @return \ActivityPub\Entities\Actor[]
     */
    public function getBlockedActors()
    {
        $cacheName = config('ActivityPub')->cachePrefix . 'blocked_actors';
        if (!($found = cache($cacheName))) {
            $found = $this->where('is_blocked', 1)->findAll();

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function blockActor($actorId)
    {
        $prefix = config('ActivityPub')->cachePrefix;
        cache()->delete($prefix . 'blocked_actors');
        cache()->deleteMatching($prefix . '*replies');

        Events::trigger('on_block_actor', $actorId);

        $this->update($actorId, ['is_blocked' => 1]);
    }

    public function unblockActor($actorId)
    {
        $prefix = config('ActivityPub')->cachePrefix;
        cache()->delete($prefix . 'blocked_actors');
        cache()->deleteMatching($prefix . '*replies');

        Events::trigger('on_unblock_actor', $actorId);

        $this->update($actorId, ['is_blocked' => 0]);
    }
}
