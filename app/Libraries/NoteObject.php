<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Libraries;

class NoteObject extends \ActivityPub\Objects\NoteObject
{
    /**
     * @param \App\Entities\Note $note
     */
    public function __construct($note)
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
