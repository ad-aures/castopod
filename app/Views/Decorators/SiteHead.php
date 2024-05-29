<?php

declare(strict_types=1);

namespace App\Views\Decorators;

use CodeIgniter\View\ViewDecoratorInterface;
use Override;

class SiteHead implements ViewDecoratorInterface
{
    private static int $renderedCount = 0;

    #[Override]
    public static function decorate(string $html): string
    {
        if (url_is(config('Admin')->gateway . '*') || url_is(config('Install')->gateway)) {
            return $html;
        }

        if (static::$renderedCount > 0) {
            return $html;
        }

        ob_start(); // Start output buffering
        // run hook to add tags to <head>
        service('plugins')->siteHead();
        $metaTags = ob_get_contents(); // Store buffer in variable
        ob_end_clean();

        if (str_contains($html, '</head>')) {
            $html = str_replace('</head>', "\n\t{$metaTags}\n</head>", $html);
            ++static::$renderedCount;
        }

        return $html;
    }
}
