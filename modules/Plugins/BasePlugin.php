<?php

declare(strict_types=1);

namespace Modules\Plugins;

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Libraries\SimpleRSSElement;

abstract class BasePlugin implements PluginInterface
{
    public function __construct()
    {
        // load metadata from json
        // load name, description, etc.
    }

    public function init(): void
    {
        // add to admin navigation

        // TODO: setup navigation and views?
    }

    public function setChannelTag(Podcast $podcast, SimpleRSSElement $channel): void
    {
    }

    public function setItemTag(Episode $episode, SimpleRSSElement $item): void
    {
    }
}
