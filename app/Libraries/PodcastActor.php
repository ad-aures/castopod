<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Libraries;

use App\Models\PodcastModel;

class PodcastActor extends \ActivityPub\Objects\ActorObject
{
    /**
     * @var string
     */
    protected $rss;

    /**
     * @param \App\Entities\Actor $actor
     */
    public function __construct($actor)
    {
        parent::__construct($actor);

        $podcast = (new PodcastModel())->where('actor_id', $actor->id)->first();

        $this->rss = $podcast->feed_url;
    }
}
