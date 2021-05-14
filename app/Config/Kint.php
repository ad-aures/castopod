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
    public $plugins = [];

    /**
     * @var int
     */
    public $maxDepth = 6;

    /**
     * @var bool
     */
    public $displayCalledFrom = true;

    /**
     * @var bool
     */
    public $expanded = false;

    /*
    |--------------------------------------------------------------------------
    | RichRenderer Settings
    |--------------------------------------------------------------------------
    */
    /**
     * @var string
     */
    public $richTheme = 'aante-light.css';

    /**
     * @var bool
     */
    public $richFolder = false;

    /**
     * @var int
     */
    public $richSort = Renderer::SORT_FULL;

    /**
     * @var string[]
     */
    public $richObjectPlugins = [];

    /**
     * @var string[]
     */
    public $richTabPlugins = [];

    /*
    |--------------------------------------------------------------------------
    | CLI Settings
    |--------------------------------------------------------------------------
    */

    /**
     * @var bool
     */
    public $cliColors = true;

    /**
     * @var bool
     */
    public $cliForceUTF8 = false;

    /**
     * @var bool
     */
    public $cliDetectWidth = true;

    /**
     * @var int
     */
    public $cliMinWidth = 40;
}
