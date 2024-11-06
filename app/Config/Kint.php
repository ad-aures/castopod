<?php

declare(strict_types=1);

namespace Config;

use Kint\Parser\ConstructablePluginInterface;
use Kint\Renderer\AbstractRenderer;
use Kint\Renderer\Rich\TabPluginInterface;
use Kint\Renderer\Rich\ValuePluginInterface;

/**
 * --------------------------------------------------------------------------
 * --------------------------------------------------------------------------
 *
 * We use Kint's `RichRenderer` and `CLIRenderer`. This area contains options
 * that you can set to customize how Kint works for you.
 *
 * @see https://kint-php.github.io/kint/ for details on these settings.
 */
class Kint
{
    /*
    |--------------------------------------------------------------------------
    | Global Settings
    |--------------------------------------------------------------------------
    */

    /**
     * @var list<class-string<ConstructablePluginInterface>|ConstructablePluginInterface>|null
     */
    public ?array $plugins = [];

    public int $maxDepth = 6;

    public bool $displayCalledFrom = true;

    public bool $expanded = false;

    /*
    |--------------------------------------------------------------------------
    | RichRenderer Settings
    |--------------------------------------------------------------------------
    */

    public string $richTheme = 'aante-light.css';

    public bool $richFolder = false;

    public int $richSort = AbstractRenderer::SORT_FULL;

    /**
     * @var array<string, class-string<ValuePluginInterface>>|null
     */
    public ?array $richObjectPlugins = [];

    /**
     * @var array<string, class-string<TabPluginInterface>>|null
     */
    public ?array $richTabPlugins = [];

    /*
    |--------------------------------------------------------------------------
    | CLI Settings
    |--------------------------------------------------------------------------
    */

    public bool $cliColors = true;

    public bool $cliForceUTF8 = false;

    public bool $cliDetectWidth = true;

    public int $cliMinWidth = 40;
}
