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
 * @property string $uri
 * @property int $actor_id
 * @property ?Actor $actor
 * @property string|null $in_reply_to_id
 * @property Post|null $reply_to_post
 * @property string|null $reblog_of_id
 * @property Post|null $reblog_of_post
 * @property string $message
 * @property string $message_html
 * @property bool $is_private
 *
 * @property int $favourites_count
 * @property int $reblogs_count
 * @property int $replies_count
 *
 * @property Time $published_at
 * @property Time $created_at
 *
 * @property PreviewCard|null $preview_card
 *
 * @property bool $has_replies
 * @property Post[] $replies
 * @property Post[] $reblogs
 */
class Post extends UuidEntity
{
    protected ?Actor $actor = null;

    protected ?Post $reply_to_post = null;

    protected ?Post $reblog_of_post = null;

    protected ?PreviewCard $preview_card = null;

    /**
     * @var Post[]|null
     */
    protected ?array $replies = null;

    protected bool $has_replies = false;

    /**
     * @var Post[]|null
     */
    protected ?array $reblogs = null;

    /**
     * @var string[]
     */
    protected $uuids = ['id', 'in_reply_to_id', 'reblog_of_id'];

    /**
     * @var list<string>
     */
    protected $dates = ['published_at', 'created_at'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id'               => 'string',
        'uri'              => 'string',
        'actor_id'         => 'integer',
        'in_reply_to_id'   => '?string',
        'reblog_of_id'     => '?string',
        'message'          => 'string',
        'message_html'     => 'string',
        'is_private'       => 'boolean',
        'favourites_count' => 'integer',
        'reblogs_count'    => 'integer',
        'replies_count'    => 'integer',
    ];

    /**
     * Returns the post's actor
     */
    public function getActor(): Actor
    {
        if (! $this->actor instanceof Actor) {
            $this->actor = model('ActorModel', false)
                ->getActorById($this->actor_id);
        }

        return $this->actor;
    }

    public function getPreviewCard(): ?PreviewCard
    {
        if (! $this->preview_card instanceof PreviewCard) {
            $this->preview_card = model('PreviewCardModel', false)
                ->getPostPreviewCard($this->id);
        }

        return $this->preview_card;
    }

    /**
     * @return Post[]
     */
    public function getReplies(): array
    {
        if ($this->replies === null) {
            $this->replies = model('PostModel', false)
                ->getPostReplies($this->id);
        }

        return $this->replies;
    }

    public function getHasReplies(): bool
    {
        return $this->getReplies() !== [];
    }

    public function getReplyToPost(): ?self
    {
        if ($this->in_reply_to_id === null) {
            throw new RuntimeException('Post is not a reply.');
        }

        if (! $this->reply_to_post instanceof self) {
            $this->reply_to_post = model('PostModel', false)
                ->getPostById($this->in_reply_to_id);
        }

        return $this->reply_to_post;
    }

    /**
     * @return Post[]
     */
    public function getReblogs(): array
    {
        if ($this->reblogs === null) {
            $this->reblogs = model('PostModel', false)
                ->getPostReblogs($this->id);
        }

        return $this->reblogs;
    }

    public function getReblogOfPost(): ?self
    {
        if ($this->reblog_of_id === null) {
            throw new RuntimeException('Post is not a reblog.');
        }

        if (! $this->reblog_of_post instanceof self) {
            $this->reblog_of_post = model('PostModel', false)
                ->getPostById($this->reblog_of_id);
        }

        return $this->reblog_of_post;
    }

    public function setMessage(string $message): static
    {
        helper('fediverse');

        $messageWithoutTags = strip_tags($message);

        $this->attributes['message'] = $messageWithoutTags;
        $this->attributes['message_html'] = str_replace("\n", '<br />', linkify($messageWithoutTags));

        return $this;
    }
}
