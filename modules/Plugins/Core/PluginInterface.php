<?php

declare(strict_types=1);

namespace Modules\Plugins\Core;

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Libraries\SimpleRSSElement;

interface PluginInterface
{
    public function channelTag(Podcast $podcast, SimpleRSSElement $channel): void;

    public function itemTag(Episode $episode, SimpleRSSElement $item): void;

    public function siteHead(): void;
}
