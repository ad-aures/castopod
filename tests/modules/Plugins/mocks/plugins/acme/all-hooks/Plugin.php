<?php

declare(strict_types=1);

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Libraries\RssFeed;
use Modules\Plugins\Core\BasePlugin;

class AcmeAllHooksPlugin extends BasePlugin
{
    #[Override]
    public function rssBeforeChannel(Podcast $podcast): void
    {
        $podcast->title = 'Podcast test';
    }

    #[Override]
    public function rssAfterChannel(Podcast $podcast, RssFeed $channel): void
    {
        $channel->addChild('foo', 'bar');
    }

    #[Override]
    public function rssBeforeItem(Episode $episode): void
    {
        $episode->title = 'Episode test';
    }

    #[Override]
    public function rssAfterItem(Episode $episode, RssFeed $item): void
    {
        $item->addChild('efoo', 'ebar');
    }

    #[Override]
    public function siteHead(): void
    {
        echo 'hello';
    }
}
