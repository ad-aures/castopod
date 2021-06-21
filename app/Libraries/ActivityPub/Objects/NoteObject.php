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
use ActivityPub\Entities\Status;

class NoteObject extends ObjectType
{
    protected string $type = 'Note';

    protected string $attributedTo;

    protected string $inReplyTo;

    protected string $replies;

    public function __construct(Status $status)
    {
        $this->id = $status->uri;

        $this->content = $status->message_html;
        $this->published = $status->published_at->format(DATE_W3C);
        $this->attributedTo = $status->actor->uri;

        if ($status->in_reply_to_id !== null) {
            $this->inReplyTo = $status->reply_to_status->uri;
        }

        $this->replies = base_url(route_to('status-replies', $status->actor->username, $status->id));

        $this->cc = [$status->actor->followers_url];
    }
}
