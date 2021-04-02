<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Models;

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
        return $this->find($id);
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
        return $this->where('uri', $actorUri)->first();
    }

    public function getFollowers($actorId)
    {
        return $this->join(
            'activitypub_follows',
            'activitypub_follows.actor_id = id',
            'inner',
        )
            ->where('activitypub_follows.target_actor_id', $actorId)
            ->findAll();
    }

    /**
     * Check if an actor is blocked using its uri
     *
     * @param mixed $actorUri
     * @return boolean
     */
    public function isActorBlocked($actorUri)
    {
        return $this->where(['uri' => $actorUri, 'is_blocked' => true])->first()
            ? true
            : false;
    }

    /**
     * Retrieves all blocked actors.
     *
     * @return \ActivityPub\Entities\Actor[]
     */
    public function getBlockedActors()
    {
        return $this->where('is_blocked', 1)->findAll();
    }

    public function blockActor($actorId)
    {
        $this->update($actorId, ['is_blocked' => 1]);
    }

    public function unblockActor($actorId)
    {
        $this->update($actorId, ['is_blocked' => 0]);
    }
}
