<?php

declare(strict_types=1);

use Modules\Plugins\Plugins;

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

if (! function_exists('array_merge_recursive_distinct')) {
    /**
     * array_merge_recursive does indeed merge arrays, but it converts values with duplicate
     * keys to arrays rather than overwriting the value in the first array with the duplicate
     * value in the second array, as array_merge does. I.e., with array_merge_recursive,
     * this happens (documented behavior):
     *
     * array_merge_recursive(array('key' => 'org value'), array('key' => 'new value'));
     *     => array('key' => array('org value', 'new value'));
     *
     * array_merge_recursive_distinct does not change the datatypes of the values in the arrays.
     * Matching keys' values in the second array overwrite those in the first array, as is the
     * case with array_merge, i.e.:
     *
     * array_merge_recursive_distinct(array('key' => 'org value'), array('key' => 'new value'));
     *     => array('key' => array('new value'));
     *
     * Parameters are passed by reference, though only for performance reasons. They're not
     * altered by this function.
     *
     * from https://www.php.net/manual/en/function.array-merge-recursive.php#92195
     *
     * @param array<mixed> $array1
     * @param array<mixed> $array2
     * @return array<mixed>
     */
    function array_merge_recursive_distinct(array &$array1, array &$array2): array
    {
        $merged = $array1;

        foreach ($array2 as $key => &$value) {
            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                $merged[$key] = array_merge_recursive_distinct($merged[$key], $value);
            } else {
                $merged[$key] = $value;
            }
        }

        return $merged;
    }
}
