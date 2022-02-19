<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use Config\Services;

if (! function_exists('render_breadcrumb')) {
    /**
     * Renders the breadcrumb navigation through the Breadcrumb service
     *
     * @param  string $class to be added to the breadcrumb nav
     * @return string html breadcrumb
     */
    function render_breadcrumb(string $class = null): string
    {
        $breadcrumb = Services::breadcrumb();
        return $breadcrumb->render($class);
    }
}

if (! function_exists('replace_breadcrumb_params')) {
    /**
     * @param string[] $newParams
     */
    function replace_breadcrumb_params(array $newParams): void
    {
        $breadcrumb = Services::breadcrumb();
        $breadcrumb->replaceParams($newParams);
    }
}
