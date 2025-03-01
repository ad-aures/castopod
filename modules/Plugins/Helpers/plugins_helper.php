<?php

declare(strict_types=1);

use Modules\Plugins\Core\Plugins;

if (! function_exists('plugins')) {
    function plugins(): Plugins
    {
        return service('plugins');
    }
}

if (! function_exists('get_plugin_setting')) {
    /**
     * @param ?array{'podcast'|'episode',int} $additionalContext
     */
    function get_plugin_setting(string $pluginKey, string $option, ?array $additionalContext = null): mixed
    {
        $key = sprintf('Plugins.%s', $option);
        $context = sprintf('plugin:%s', $pluginKey);

        if ($additionalContext !== null) {
            $context .= sprintf('+%s:%d', ...$additionalContext);
        }

        return setting()->get($key, $context);
    }
}

if (! function_exists('set_plugin_setting')) {
    /**
     * @param ?array{'podcast'|'episode',int} $additionalContext
     */
    function set_plugin_setting(
        string $pluginKey,
        string $option,
        mixed $value = null,
        ?array $additionalContext = null,
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

if (! function_exists('load_plugins_translations')) {
    /**
     * @return array<mixed>
     */
    function load_plugins_translations(string $locale): array
    {
        $allPlugins = plugins()
            ->getAllPlugins();

        $translations = [];
        foreach ($allPlugins as $plugin) {
            $file = $plugin->getDirectory() . DIRECTORY_SEPARATOR . 'i18n' . DIRECTORY_SEPARATOR . $locale . '.json';

            $jsonContents = @file_get_contents($file);

            if (! $jsonContents) {
                continue;
            }

            $contents = json_decode($jsonContents, true);

            if (! $contents) {
                continue;
            }

            $translations[$plugin->getKey()] = $contents;
        }

        return $translations;
    }
}
