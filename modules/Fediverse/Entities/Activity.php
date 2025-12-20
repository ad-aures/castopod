<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Entities;

use CodeIgniter\I18n\Time;
use Michalsn\Uuid\UuidEntity;
use RuntimeException;

/**
 * @property string $id
 * @property int $actor_id
 * @property ?Actor $actor
 * @property int|null $target_actor_id
 * @property ?Actor $target_actor
 * @property string|null $post_id
 * @property ?Post $post
 * @property string $type
 * @property object $payload
 * @property string|null $status
 * @property Time|null $scheduled_at
 * @property Time $created_at
 */
class Activity extends UuidEntity
{
    protected ?Actor $actor = null;

    protected ?Actor $target_actor = null;

    protected ?Post $post = null;

    /**
     * @var string[]
     */
    protected $uuids = ['id', 'post_id'];

    /**
     * @var list<string>
     */
    protected $dates = ['scheduled_at', 'created_at'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id'              => 'string',
        'actor_id'        => 'integer',
        'target_actor_id' => '?integer',
        'post_id'         => '?string',
        'type'            => 'string',
        'payload'         => 'json',
        'status'          => '?string',
    ];

    public function getActor(): Actor
    {
        if (! $this->actor instanceof Actor) {
            $this->actor = model('ActorModel', false)
                ->getActorById($this->actor_id);
        }

        return $this->actor;
    }

    public function getTargetActor(): Actor
    {
        if ($this->target_actor_id === null) {
            throw new RuntimeException('Activity must have a target_actor_id before getting the target actor.');
        }

        if (! $this->target_actor instanceof Actor) {
            $this->target_actor = model('ActorModel', false)
                ->getActorById($this->target_actor_id);
        }

        return $this->target_actor;
    }

    public function getPost(): Post
    {
        if ($this->post_id === null) {
            throw new RuntimeException('Activity must have a post_id before getting post.');
        }

        if (! $this->post instanceof Post) {
            $this->post = model('PostModel', false)
                ->getPostById($this->post_id);
        }

        return $this->post;
    }
}
