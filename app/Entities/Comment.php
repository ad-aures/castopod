<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

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
 * @property string $in_reply_to_id
 * @property Comment|null $reply_to_comment
 * @property string $message
 * @property string $message_html
 * @property int $likes_count
 * @property int $dislikes_count
 * @property int $replies_count
 * @property Time $created_at
 * @property int $created_by
 */
class Comment extends UuidEntity
{
    protected ?Episode $episode = null;

    protected ?Actor $actor = null;

    protected ?Comment $reply_to_comment = null;

    /**
     * @var string[]
     */
    protected $dates = ['created_at'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string',
        'uri' => 'string',
        'episode_id' => 'integer',
        'actor_id' => 'integer',
        'in_reply_to_id' => '?string',
        'message' => 'string',
        'message_html' => 'string',
        'likes_count' => 'integer',
        'dislikes_count' => 'integer',
        'replies_count' => 'integer',
        'created_by' => 'integer',
        'is_from_post' => 'boolean',
    ];

    /**
     * Returns the comment's attached episode
     */
    public function getEpisode(): ?Episode
    {
        if ($this->episode_id === null) {
            throw new RuntimeException('Comment must have an episode_id before getting episode.');
        }

        if (! $this->episode instanceof Episode) {
            $this->episode = (new EpisodeModel())->getEpisodeById($this->episode_id);
        }

        return $this->episode;
    }

    /**
     * Returns the comment's actor
     */
    public function getActor(): Actor
    {
        if ($this->actor_id === null) {
            throw new RuntimeException('Comment must have an actor_id before getting actor.');
        }

        if ($this->actor === null) {
            $this->actor = model('ActorModel', false)
                ->getActorById($this->actor_id);
        }

        return $this->actor;
    }

    public function setMessage(string $message): static
    {
        helper('activitypub');

        $messageWithoutTags = strip_tags($message);

        $this->attributes['message'] = $messageWithoutTags;
        $this->attributes['message_html'] = str_replace("\n", '<br />', linkify($messageWithoutTags));

        return $this;
    }
}
