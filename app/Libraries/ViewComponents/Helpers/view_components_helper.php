<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

if (! function_exists('component')) {
    /**
     * Loads the specified class or view file component in the parameters
     *
     * @param array<string, array<string, mixed>> $properties
     * @param array<string, array<string, mixed>> $attributes
     */
    function component(string $name, array $properties = [], array $attributes = []): string
    {
        $componentLoader = service('viewcomponents');

        $componentLoader->name = $name;
        $componentLoader->properties = $properties;
        $componentLoader->attributes = $attributes;

        return $componentLoader->load();
    }
}
