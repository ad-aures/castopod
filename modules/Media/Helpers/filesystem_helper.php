<?php

declare(strict_types=1);

/**
 * @copyright  2023 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

if (! function_exists('add_suffix_to_path')) {
    function change_file_path(string $path, string $suffix = '', ?string $newExtension = null): string
    {
        if ($newExtension === null) {
            $newExtension = pathinfo($path, PATHINFO_EXTENSION);
        }

        return preg_replace('~\.[^.]+$~', '', $path) . $suffix . '.' . $newExtension;
    }
}
