<?php

declare(strict_types=1);

namespace ViewThemes;

use ViewThemes\Config\Themes;

/**
 * Borrowed and adapted from https://github.com/lonnieezell/Bonfire2
 */
class Theme
{
    protected Themes $config;

    /**
     * @var string
     */
    protected static $defaultTheme = 'app';

    /**
     * @var string
     */
    protected static $currentTheme;

    /**
     * Holds theme info retrieved
     *
     * @var array<int, array<string, mixed>>
     */
    protected static array $info = [];

    public function __construct()
    {
        $this->config = config(Themes::class);
    }

    /**
     * Sets the active theme.
     */
    public static function setTheme(string $theme): void
    {
        static::$currentTheme = $theme;
    }

    /**
     * Returns the path to the specified theme folder. If no theme is provided, will use the current theme.
     */
    public static function path(string $theme = null): string
    {
        if ($theme === null) {
            $theme = static::current();
        }

        // Ensure we've pulled the theme info
        if (static::$info === []) {
            static::$info = self::available();
        }

        foreach (static::$info as $info) {
            if ($info['name'] === $theme) {
                return $info['path'];
            }
        }

        return '';
    }

    /**
     * Returns the name of the active theme.
     */
    public static function current(): string
    {
        return static::$currentTheme !== null
            ? static::$currentTheme
            : static::$defaultTheme;
    }

    /**
     * Returns an array of all available themes and the paths to their directories.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function available(): array
    {
        $themes = [];

        $config = config(Themes::class);

        foreach ($config->themes as $name => $folder) {
            $themes[] = [
                'name' => $name,
                'path' => $config->themesDirectory . '/' . $folder . '/',
            ];
        }

        return $themes;
    }
}
