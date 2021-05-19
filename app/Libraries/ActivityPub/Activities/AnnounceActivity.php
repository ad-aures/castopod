<?php

/**
 * Activity objects are specializations of the base Object type that provide information about actions that have either
 * already occurred, are in the process of occurring, or may occur in the future.
 *
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Activities;

use ActivityPub\Core\Activity;
use ActivityPub\Entities\Note;

class AnnounceActivity extends Activity
{
    protected string $type = 'Announce';

    public function __construct(Note $reblogNote)
    {
        $this->actor = $reblogNote->actor->uri;
        $this->object = $reblogNote->reblog_of_note->uri;

        $this->published = $reblogNote->published_at->format(DATE_W3C);

        $this->cc = [$reblogNote->actor->uri, $reblogNote->actor->followers_url];
    }
}
