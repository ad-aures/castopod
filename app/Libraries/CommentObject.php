<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Libraries;

use App\Entities\EpisodeComment;
use Modules\Fediverse\Core\ObjectType;

class CommentObject extends ObjectType
{
    protected string $type = 'Note';

    protected string $attributedTo;

    protected string $inReplyTo;

    protected string $replies;

    public function __construct(EpisodeComment $comment)
    {
        $this->id = $comment->uri;

        $this->content = $comment->message_html;
        $this->published = $comment->created_at->format(DATE_W3C);
        $this->attributedTo = $comment->actor->uri;

        if ($comment->in_reply_to_id !== null) {
            $this->inReplyTo = $comment->reply_to_comment->uri;
        }

        $this->replies = url_to(
            'episode-comment-replies',
            $comment->actor->username,
            $comment->episode->slug,
            $comment->id
        );

        $this->cc = [$comment->actor->followers_url];
    }
}
