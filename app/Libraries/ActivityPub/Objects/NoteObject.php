<?php

/**
 * This class defines the Object which is the
 * primary base type for the Activity Streams vocabulary.
 *
 * Object is a reserved word in php, so the class is named ObjectType.
 *
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Objects;

use ActivityPub\Entities\Note;
use ActivityPub\Core\ObjectType;

class NoteObject extends ObjectType
{
    /**
     * @var string
     */
    protected $type = 'Note';

    /**
     * @var string
     */
    protected $attributedTo;

    /**
     * @var string
     */
    protected $inReplyTo;

    /**
     * @var array
     */
    protected $replies = [];

    /**
     * @param Note $note
     */
    public function __construct($note)
    {
        $this->id = $note->uri;

        $this->content = $note->message_html;
        $this->published = $note->published_at->format(DATE_W3C);
        $this->attributedTo = $note->actor->uri;

        if ($note->is_reply) {
            $this->inReplyTo = $note->reply_to_note->uri;
        }

        $this->replies = base_url(
            route_to('note-replies', $note->actor->username, $note->id),
        );

        $this->cc = [$note->actor->followers_url];
    }
}
