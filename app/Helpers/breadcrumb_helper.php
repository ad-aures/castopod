<?php

declare(strict_types=1);

if (! function_exists('render_breadcrumb')) {
    /**
     * Renders the breadcrumb navigation through the Breadcrumb service
     *
     * @param string|null $class to be added to the breadcrumb nav
     * @return string html breadcrumb
     */
    function render_breadcrumb(string $class = null): string
    {
        return service('breadcrumb')->render($class);
    }
}

if (! function_exists('replace_breadcrumb_params')) {
    /**
     * @param array<string|int,string> $newParams
     */
    function replace_breadcrumb_params(array $newParams): void
    {
        service('breadcrumb')->replaceParams($newParams);
    }
}
