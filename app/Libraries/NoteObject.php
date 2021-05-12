<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Libraries;

use ActivityPub\Objects\NoteObject as ActivityPubNoteObject;
use App\Entities\Note;

class NoteObject extends ActivityPubNoteObject
{
    public function __construct(Note $note)
    {
        parent::__construct($note);

        if ($note->episode_id) {
            $this->content =
                '<a href="' .
                $note->episode->link .
                '" target="_blank" rel="noopener noreferrer">' .
                $note->episode->title .
                '</a><br/>' .
                $note->message_html;
        }
    }
}
