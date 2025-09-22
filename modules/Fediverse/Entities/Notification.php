<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Entities;

use CodeIgniter\I18n\Time;
use Michalsn\Uuid\UuidEntity;
use Modules\Fediverse\Models\ActorModel;
use Modules\Fediverse\Models\PostModel;
use RuntimeException;

/**
 * @property int $id
 * @property int $actor_id
 * @property ?Actor $actor
 * @property int $target_actor_id
 * @property ?Actor $target_actor
 * @property string|null $post_id
 * @property ?Post $post
 * @property string $activity_id
 * @property Activity $activity
 * @property 'like'|'follow'|'share'|'reply' $type
 * @property Time|null $read_at
 * @property Time $created_at
 * @property Time $updated_at
 */
class Notification extends UuidEntity
{
    protected ?Actor $actor = null;

    protected ?Actor $target_actor = null;

    protected ?Post $post = null;

    protected ?Activity $activity = null;

    /**
     * @var string[]
     */
    protected $uuids = ['post_id', 'activity_id'];

    /**
     * @var list<string>
     */
    protected $dates = ['read_at', 'created_at', 'updated_at'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id'              => 'integer',
        'actor_id'        => 'integer',
        'target_actor_id' => 'integer',
        'post_id'         => '?string',
        'activity_id'     => 'string',
        'type'            => 'string',
    ];

    public function getActor(): ?Actor
    {
        if (! $this->actor instanceof Actor) {
            $this->actor = new ActorModel()
                ->getActorById($this->actor_id);
        }

        return $this->actor;
    }

    public function getTargetActor(): ?Actor
    {
        if (! $this->target_actor instanceof Actor) {
            $this->target_actor = new ActorModel()
                ->getActorById($this->target_actor_id);
        }

        return $this->target_actor;
    }

    public function getPost(): ?Post
    {
        if ($this->post_id === null) {
            throw new RuntimeException('Notification must have a post_id before getting post.');
        }

        if (! $this->post instanceof Post) {
            $this->post = new PostModel()
                ->getPostById($this->post_id);
        }

        return $this->post;
    }
}
