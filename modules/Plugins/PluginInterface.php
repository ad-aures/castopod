<?php

declare(strict_types=1);

namespace Modules\Plugins;

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Libraries\SimpleRSSElement;

interface PluginInterface
{
    public function setChannelTag(Podcast $podcast, SimpleRSSElement $channel): void;

    public function setItemTag(Episode $episode, SimpleRSSElement $item): void;
}
