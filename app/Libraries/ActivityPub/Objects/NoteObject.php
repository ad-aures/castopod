<?php

declare(strict_types=1);

/**
 * This class defines the Object which is the primary base type for the Activity Streams vocabulary.
 *
 * Object is a reserved word in php, so the class is named ObjectType.
 *
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Objects;

use ActivityPub\Core\ObjectType;
use ActivityPub\Entities\Post;

class NoteObject extends ObjectType
{
    protected string $type = 'Note';

    protected string $attributedTo;

    protected string $inReplyTo;

    protected string $replies;

    public function __construct(Post $post)
    {
        $this->id = $post->uri;

        $this->content = $post->message_html;
        $this->published = $post->published_at->format(DATE_W3C);
        $this->attributedTo = $post->actor->uri;

        if ($post->in_reply_to_id !== null) {
            $this->inReplyTo = $post->reply_to_post->uri;
        }

        $this->replies = url_to('post-replies', $post->actor->username, $post->id);

        $this->cc = [$post->actor->followers_url];
    }
}
