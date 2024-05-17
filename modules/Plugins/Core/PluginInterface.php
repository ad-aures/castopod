<?php

declare(strict_types=1);

namespace Modules\Plugins\Core;

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Libraries\SimpleRSSElement;

interface PluginInterface
{
    public function rssBeforeChannel(Podcast $podcast): void;

    public function rssAfterChannel(Podcast $podcast, SimpleRSSElement $channel): void;

    public function rssBeforeItem(Episode $episode): void;

    public function rssAfterItem(Episode $episode, SimpleRSSElement $item): void;

    public function siteHead(): void;
}
