<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Libraries;

use App\Entities\Podcast;
use Modules\Fediverse\Objects\ActorObject;

class PodcastActor extends ActorObject
{
    protected string $rssFeed;

    protected string $language;

    protected string $category;

    protected string $episodes;

    public function __construct(Podcast $podcast)
    {
        parent::__construct($podcast->actor);

        $this->context[] = 'https://github.com/Podcastindex-org/activitypub-spec-work/blob/main/docs/1.0.md';

        $this->type = 'Podcast';

        $this->rssFeed = $podcast->feed_url;

        $this->language = $podcast->language_code;

        $category = '';
        if ($podcast->category->parent_id !== null) {
            $category .= $podcast->category->parent->apple_category . ' › ';
        }

        $category .= $podcast->category->apple_category;

        $this->category = $category;

        $this->episodes = url_to('podcast-episodes', esc($podcast->handle));
    }
}
