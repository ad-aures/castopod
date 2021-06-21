<?php

declare(strict_types=1);

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
use ActivityPub\Entities\Status;

class AnnounceActivity extends Activity
{
    protected string $type = 'Announce';

    public function __construct(Status $reblogStatus)
    {
        $this->actor = $reblogStatus->actor->uri;
        $this->object = $reblogStatus->reblog_of_status->uri;

        $this->published = $reblogStatus->published_at->format(DATE_W3C);

        $this->cc = [$reblogStatus->actor->uri, $reblogStatus->actor->followers_url];
    }
}
