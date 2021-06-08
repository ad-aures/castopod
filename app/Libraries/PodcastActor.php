<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Libraries;

use ActivityPub\Entities\Actor;
use ActivityPub\Objects\ActorObject;
use App\Models\PodcastModel;

class PodcastActor extends ActorObject
{
    protected string $rss;

    public function __construct(Actor $actor)
    {
        parent::__construct($actor);

        $podcast = (new PodcastModel())->where('actor_id', $actor->id)
            ->first();

        $this->rss = $podcast->feed_url;
    }
}
