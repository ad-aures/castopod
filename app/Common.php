<?php

declare(strict_types=1);

use Config\Services;
use Config\View;
use ViewThemes\Theme;

/**
 * The goal of this file is to allow developers a location where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @link: https://codeigniter4.github.io/CodeIgniter4/
 */

if (! function_exists('view')) {
    /**
     * Grabs the current RendererInterface-compatible class and tells it to render the specified view. Simply provides a
     * convenience method that can be used in Controllers, libraries, and routed closures.
     *
     * NOTE: Does not provide any escaping of the data, so that must all be handled manually by the developer.
     *
     * @param array<string, mixed>  $data
     * @param array<string, mixed>  $options Unused - reserved for third-party extensions.
     */
    function view(string $name, array $data = [], array $options = []): string
    {
        $path = Theme::path();

        /** @var CodeIgniter\View\View $renderer */
        $renderer = single_service('renderer', $path);

        $saveData = config(View::class)->saveData;

        if (array_key_exists('saveData', $options)) {
            $saveData = (bool) $options['saveData'];
            unset($options['saveData']);
        }

        return $renderer->setData($data, 'raw')
            ->render($name, $options, $saveData);
    }
}

if (! function_exists('lang')) {
    /**
     * A convenience method to translate a string or array of them and format the result with the intl extension's
     * MessageFormatter.
     *
     * Overwritten to include an escape parameter (escaped by default).
     *
     * @param array<int|string, string> $args
     *
     * @return string|string[]
     */
    function lang(string $line, array $args = [], ?string $locale = null, bool $escape = true): string | array
    {
        $language = Services::language();

        // Get active locale
        $activeLocale = $language->getLocale();

        if ($locale && $locale !== $activeLocale) {
            $language->setLocale($locale);
        }

        $line = $language->getLine($line, $args);
        if (! $locale) {
            return $escape ? esc($line) : $line;
        }

        if ($locale === $activeLocale) {
            return $escape ? esc($line) : $line;
        }

        // Reset to active locale
        $language->setLocale($activeLocale);
        return $escape ? esc($line) : $line;
    }
}
