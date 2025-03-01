<?php

declare(strict_types=1);

namespace Modules\Plugins\Core;

use App\Libraries\RssFeed;
use Exception;
use Override;
use Stringable;

class RSS implements Stringable
{
    public function __construct(
        protected string $rss,
    ) {
    }

    #[Override]
    public function __toString(): string
    {
        return $this->rss;
    }

    /**
     * @return ?RssFeed[]
     */
    public function toSimpleRSS(): ?array
    {
        try {
            $rssFeed = new RssFeed("{$this->rss}");
        } catch (Exception) {
            return null;
        }

        return [
            ...$rssFeed->children(),
            ...$rssFeed->children(RssFeed::ATOM_NS, true),
            ...$rssFeed->children(RssFeed::ITUNES_NS, true),
            ...$rssFeed->children(RssFeed::PODCAST_NS, true),
        ];
    }
}
