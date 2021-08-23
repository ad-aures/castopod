<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Libraries;

use App\Entities\Post;
use Modules\Fediverse\Objects\NoteObject as ActivityPubNoteObject;

class NoteObject extends ActivityPubNoteObject
{
    /**
     * @param Post $post
     */
    public function __construct($post)
    {
        parent::__construct($post);

        if ($post->episode_id) {
            $this->content =
                '<a href="' .
                $post->episode->link .
                '" target="_blank" rel="noopener noreferrer">' .
                $post->episode->title .
                '</a><br/>' .
                $post->message_html;
        }
    }
}
