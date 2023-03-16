<?php

declare(strict_types=1);

/**
 * @copyright  2023 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */


if (! function_exists('path_without_ext')) {
    function path_without_ext(string $path): string
    {
        $fileKeyInfo = pathinfo($path);

        if ($fileKeyInfo['dirname'] === '.' && ! str_starts_with($path, '.')) {
            return $fileKeyInfo['filename'];
        }

        if ($fileKeyInfo['dirname'] === '/') {
            return '/' . $fileKeyInfo['filename'];
        }

        return implode('/', [$fileKeyInfo['dirname'], $fileKeyInfo['filename']]);
    }
}
