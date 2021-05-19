<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use Kint\Renderer\Renderer;

/**
 * --------------------------------------------------------------------------
 * Kint
 * --------------------------------------------------------------------------
 *
 * We use Kint's `RichRenderer` and `CLIRenderer`. This area contains options
 * that you can set to customize how Kint works for you.
 *
 * @see https://kint-php.github.io/kint/ for details on these settings.
 */
class Kint extends BaseConfig
{
    /*
    |--------------------------------------------------------------------------
    | Global Settings
    |--------------------------------------------------------------------------
    */

    /**
     * @var string[]
     */
    public array $plugins = [];

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

    public int $richSort = Renderer::SORT_FULL;

    /**
     * @var string[]
     */
    public array $richObjectPlugins = [];

    /**
     * @var string[]
     */
    public array $richTabPlugins = [];

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
