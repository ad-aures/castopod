<?php

declare(strict_types=1);

if (! function_exists('get_plugin_option')) {
    function get_plugin_option(string $pluginKey, string $option): mixed
    {
        $key = sprintf('Plugins.%s', $option);
        $context = sprintf('plugin:%s', $pluginKey);

        return setting()->get($key, $context);
    }
}

if (! function_exists('set_plugin_option')) {
    function set_plugin_option(string $pluginKey, string $option, mixed $value = null): void
    {
        $key = sprintf('Plugins.%s', $option);
        $context = sprintf('plugin:%s', $pluginKey);

        setting()
            ->set($key, $value, $context);
    }
}
