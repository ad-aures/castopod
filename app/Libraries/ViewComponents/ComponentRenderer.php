<?php

declare(strict_types=1);

namespace ViewComponents;

use RuntimeException;
use ViewComponents\Config\ViewComponents;

/**
 * Borrowed and adapted from https://github.com/lonnieezell/Bonfire2/
 */
class ComponentRenderer
{
    protected ViewComponents $config;

    public function __construct()
    {
        $this->config = config(ViewComponents::class);
    }

    public function render(string $output): string
    {
        // Try to locate any custom tags, with PascalCase names like: Button, Label, etc.
        service('timer')
            ->start('self-closing');
        $output = $this->renderSelfClosingTags($output);
        service('timer')
            ->stop('self-closing');

        service('timer')
            ->start('paired-tags');
        $output = $this->renderPairedTags($output);
        service('timer')
            ->stop('paired-tags');

        return $output;
    }

    /**
     * Finds and renders self-closing tags, i.e. <Foo />
     */
    private function renderSelfClosingTags(string $output): string
    {
        // Pattern borrowed and adapted from Laravel's ComponentTagCompiler
        // Should match any Component tags <Component />
        $pattern = "/
            <
                \s*
                (?<name>[A-Z][A-Za-z0-9\.]*?)
                \s*
                (?<attributes>
                    (?:
                        \s+
                        (?:
                            (?:
                                \{\{\s*\\\$attributes(?:[^}]+?)?\s*\}\}
                            )
                            |
                            (?:
                                [\w\-:.@]+
                                (
                                    =
                                    (?:
                                        \\\"[^\\\"]*\\\"
                                        |
                                        \'[^\']*\'
                                        |
                                        [^\'\\\"=<>]+
                                    )
                                )?
                            )
                        )
                    )*
                    \s*
                )
            \/>
        /x";

        /*
            $matches[0] = full tags matched
            $matches[name] = tag name
            $matches[attributes] = array of attribute string (class="foo")
         */
        return preg_replace_callback($pattern, function (array $match): string {
            $view = $this->locateView($match['name']);
            $attributes = $this->parseAttributes($match['attributes']);

            $component = $this->factory($match['name'], $view, $attributes);

            return $component instanceof Component
                ? $component->render()
                : $this->renderView($view, $attributes);
        }, $output) ?? '';
    }

    private function renderPairedTags(string $output): string
    {
        $pattern = '/<\s*(?<name>[A-Z][A-Za-z0-9\.]*?)(?<attributes>(\s*[\w\-]+\s*=\s*(\'[^\']*\'|\"[^\"]*\"))+\s*)>(?<slot>.*)<\/\s*\1\s*>/uUsm';
        ini_set('pcre.backtrack_limit', '-1');
        /*
            $matches[0] = full tags matched and all of its content
            $matches[name] = pascal cased tag name
            $matches[attributes] = string of tag attributes (class="foo")
            $matches[slot] = the content inside the tags
         */
        return preg_replace_callback($pattern, function (array $match): string {
            $view = $this->locateView($match['name']);
            $attributes = $this->parseAttributes($match['attributes']);
            $attributes['slot'] = $match['slot'];

            $component = $this->factory($match['name'], $view, $attributes);

            return $component instanceof Component
                ? $component->render()
                : $this->renderView($view, $attributes);
        }, $output) ?? (string) preg_last_error();
    }

    /**
     * Locate the view file used to render the component. The file's name must match the name of the component.
     *
     * Looks for class and view file components in the current module before checking the default app module
     */
    private function locateView(string $name): string
    {
        // TODO: Is there a better way to locate components local to current module?
        $pathsToDiscover = [];
        $lookupPaths = $this->config->lookupPaths;
        $pathsToDiscover = array_values($lookupPaths);
        $pathsToDiscover[] = $this->config->defaultLookupPath;

        $namePath = str_replace('.', '/', $name);

        foreach ($pathsToDiscover as $basePath) {
            // Look for a class component first
            $fileKey = $basePath . $this->config->componentsDirectory . '/' . $namePath . '.php';

            if (is_file($fileKey)) {
                return $fileKey;
            }

            $snakeCaseName = strtolower(preg_replace('~(?<!^)(?<!\/)[A-Z]~', '_$0', $namePath) ?? '');
            $fileKey = $basePath . $this->config->componentsDirectory . '/' . $snakeCaseName . '.php';

            if (is_file($fileKey)) {
                return $fileKey;
            }
        }

        throw new RuntimeException("View not found for component: {$name}");
    }

    /**
     * Parses a string to grab any key/value pairs, HTML attributes.
     *
     * @return array<string, string>
     */
    private function parseAttributes(string $attributeString): array
    {
        // Pattern borrowed from Laravel's ComponentTagCompiler
        $pattern = '/
            (?<attribute>[\w\-:.@]+)
            (
                =
                (?<value>
                    (
                        \"[^\"]+\"
                        |
                        \'[^\']+\'
                        |
                        \\\'[^\\\']+\\\'
                        |
                        [^\s>]+
                    )
                )
            )?
        /x';

        if (! preg_match_all($pattern, $attributeString, $matches, PREG_SET_ORDER)) {
            return [];
        }

        $attributes = [];
        /**
         * @var array<string, string> $match
         */
        foreach ($matches as $match) {
            $attributes[$match['attribute']] = $this->stripQuotes($match['value']);
        }

        return $attributes;
    }

    /**
     * Attempts to locate the view and/or class that will be used to render this component. By default, the only thing
     * that is needed is a view, but a Component class can also be found if more power is needed.
     *
     * If a class is used, the name is expected to be <viewName>Component.php
     *
     * @param array<string, mixed> $attributes
     */
    private function factory(string $name, string $view, array $attributes): ?Component
    {
        // Locate the class in the same folder as the view
        $class = $name . '.php';
        $fileKey = str_replace($name . '.php', $class, $view);

        if ($fileKey === '') {
            return null;
        }

        if (! file_exists($fileKey)) {
            return null;
        }

        $className = service('locator')
            ->getClassname($fileKey);

        if (! class_exists($className)) {
            return null;
        }

        return new $className($attributes);
    }

    /**
     * Renders the view when no corresponding class has been found.
     *
     * @param array<string, string> $data
     */
    private function renderView(string $view, array $data): string
    {
        return (static function (string $view, $data): string {
            extract($data);
            ob_start();
            eval('?>' . file_get_contents($view));
            return ob_get_clean() ?: '';
        })($view, $data);
    }

    /**
     * Removes surrounding quotes from a string.
     */
    private function stripQuotes(string $string): string
    {
        return trim($string, "\'\"");
    }
}
