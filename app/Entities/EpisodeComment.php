<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Models\ActorModel;
use App\Models\EpisodeCommentModel;
use App\Models\EpisodeModel;
use CodeIgniter\I18n\Time;
use Michalsn\Uuid\UuidEntity;
use RuntimeException;

/**
 * @property string $id
 * @property string $uri
 * @property int $episode_id
 * @property Episode|null $episode
 * @property int $actor_id
 * @property Actor|null $actor
 * @property ?string $in_reply_to_id
 * @property EpisodeComment|null $reply_to_comment
 * @property string $message
 * @property string $message_html
 * @property int $likes_count
 * @property int $replies_count
 * @property Time $created_at
 * @property int $created_by
 *
 * @property EpisodeComment[] $replies
 */
class EpisodeComment extends UuidEntity
{
    protected ?Episode $episode = null;

    protected ?Actor $actor = null;

    protected ?EpisodeComment $reply_to_comment = null;

    /**
     * @var EpisodeComment[]|null
     */
    protected ?array $replies = null;

    protected bool $has_replies = false;

    /**
     * @var array<int, string>
     * @phpstan-var list<string>
     */
    protected $dates = ['created_at'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id'             => 'string',
        'uri'            => 'string',
        'episode_id'     => 'integer',
        'actor_id'       => 'integer',
        'in_reply_to_id' => '?string',
        'message'        => 'string',
        'message_html'   => 'string',
        'likes_count'    => 'integer',
        'replies_count'  => 'integer',
        'created_by'     => 'integer',
        'is_from_post'   => 'boolean',
    ];

    public function getEpisode(): ?Episode
    {
        if (! $this->episode instanceof Episode) {
            $this->episode = new EpisodeModel()
                ->getEpisodeById($this->episode_id);
        }

        return $this->episode;
    }

    /**
     * Returns the comment's actor
     */
    public function getActor(): ?Actor
    {
        if (! $this->actor instanceof Actor) {
            $this->actor = model(ActorModel::class, false)
                ->getActorById($this->actor_id);
        }

        return $this->actor;
    }

    /**
     * @return EpisodeComment[]
     */
    public function getReplies(): array
    {
        if ($this->replies === null) {
            $this->replies = new EpisodeCommentModel()
                ->getCommentReplies($this->id);
        }

        return $this->replies;
    }

    public function getHasReplies(): bool
    {
        return $this->getReplies() !== [];
    }

    public function getReplyToComment(): ?self
    {
        if ($this->in_reply_to_id === null) {
            throw new RuntimeException('Comment is not a reply.');
        }

        if (! $this->reply_to_comment instanceof self) {
            $this->reply_to_comment = model(EpisodeCommentModel::class, false)
                ->getCommentById($this->in_reply_to_id);
        }

        return $this->reply_to_comment;
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
