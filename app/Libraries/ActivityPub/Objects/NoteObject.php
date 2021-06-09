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
use ActivityPub\Entities\Note;

class NoteObject extends ObjectType
{
    protected string $type = 'Note';

    protected string $attributedTo;

    protected string $inReplyTo;

    protected string $replies;

    public function __construct(Note $note)
    {
        $this->id = $note->uri;

        $this->content = $note->message_html;
        $this->published = $note->published_at->format(DATE_W3C);
        $this->attributedTo = $note->actor->uri;

        if ($note->in_reply_to_id !== null) {
            $this->inReplyTo = $note->reply_to_note->uri;
        }

        $this->replies = base_url(route_to('note-replies', $note->actor->username, $note->id));

        $this->cc = [$note->actor->followers_url];
    }
}
