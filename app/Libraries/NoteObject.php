<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Libraries;

use ActivityPub\Objects\NoteObject as ActivityPubNoteObject;
use App\Entities\Status;

class NoteObject extends ActivityPubNoteObject
{
    /**
     * @param Status $status
     */
    public function __construct(\ActivityPub\Entities\Status $status)
    {
        parent::__construct($status);

        if ($status->episode_id) {
            $this->content =
                '<a href="' .
                $status->episode->link .
                '" target="_blank" rel="noopener noreferrer">' .
                $status->episode->title .
                '</a><br/>' .
                $status->message_html;
        }
    }
}
