<?php

declare(strict_types=1);

namespace Modules\Plugins\Core;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\DisallowedRawHtml\DisallowedRawHtmlExtension;
use League\CommonMark\Extension\SmartPunct\SmartPunctExtension;
use League\CommonMark\MarkdownConverter;
use Stringable;

class Markdown implements Stringable
{
    public function __construct(
        protected string $markdown
    ) {
    }

    public function __toString(): string
    {
        return $this->markdown;
    }

    public function renderHTML(): string
    {
        $config = [
            'html_input'         => 'escape',
            'allow_unsafe_links' => false,
        ];

        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new AutolinkExtension());
        $environment->addExtension(new SmartPunctExtension());
        $environment->addExtension(new DisallowedRawHtmlExtension());

        $converter = new MarkdownConverter($environment);

        return (string) $converter->convert($this->markdown);
    }
}
