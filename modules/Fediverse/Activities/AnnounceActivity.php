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

namespace Modules\Fediverse\Activities;

use Modules\Fediverse\Core\Activity;
use Modules\Fediverse\Entities\Post;

class AnnounceActivity extends Activity
{
    protected string $type = 'Announce';

    public function __construct(Post $reblogPost)
    {
        $this->actor = $reblogPost->actor->uri;
        $this->object = $reblogPost->reblog_of_post->uri;

        $this->published = $reblogPost->published_at->format(DATE_W3C);

        $this->cc = [$reblogPost->actor->uri, $reblogPost->actor->followers_url];
    }
}
