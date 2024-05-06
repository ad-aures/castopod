<?php

declare(strict_types=1);

use Modules\Plugins\Core\Plugins;

if (! function_exists('plugins')) {
    function plugins(): Plugins
    {
        return service('plugins');
    }
}

if (! function_exists('get_plugin_option')) {
    /**
     * @param ?array{'podcast'|'episode',int} $additionalContext
     */
    function get_plugin_option(string $pluginKey, string $option, array $additionalContext = null): mixed
    {
        $key = sprintf('Plugins.%s', $option);
        $context = sprintf('plugin:%s', $pluginKey);

        if ($additionalContext !== null) {
            $context .= sprintf('+%s:%d', ...$additionalContext);
        }

        return setting()->get($key, $context);
    }
}

if (! function_exists('set_plugin_option')) {
    /**
     * @param ?array{'podcast'|'episode',int} $additionalContext
     */
    function set_plugin_option(
        string $pluginKey,
        string $option,
        mixed $value = null,
        array $additionalContext = null
    ): void {
        $key = sprintf('Plugins.%s', $option);
        $context = sprintf('plugin:%s', $pluginKey);

        if ($additionalContext !== null) {
            $context .= sprintf('+%s:%d', ...$additionalContext);
        }

        setting()
            ->set($key, $value, $context);
    }
}
