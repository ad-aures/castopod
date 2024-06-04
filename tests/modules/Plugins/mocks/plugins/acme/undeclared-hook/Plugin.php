<?php

declare(strict_types=1);

use App\Entities\Podcast;
use App\Libraries\SimpleRSSElement;
use Modules\Plugins\Core\BasePlugin;

class AcmeUndeclaredHookPlugin extends BasePlugin
{
    #[Override]
    public function rssBeforeChannel(Podcast $podcast): void
    {
        $podcast->title = 'Podcast test undeclared';
    }

    #[Override]
    public function rssAfterChannel(Podcast $podcast, SimpleRSSElement $channel): void
    {
        $channel->addChild('foo', 'bar');
    }
}
