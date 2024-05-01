<?php

declare(strict_types=1);

namespace Modules\Plugins;

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Libraries\SimpleRSSElement;

/**
 * @method void setChannelTag(Podcast $podcast, SimpleRSSElement $channel)
 * @method void setItemTag(Episode $episode, SimpleRSSElement $item)
 */
class Plugins
{
    protected const API_VERSION = '1.0';

    /**
     * @var list<string>
     */
    protected const HOOKS = ['setChannelTag', 'setItemTag'];

    /**
     * @var array<BasePlugin>
     */
    protected static array $plugins = [];

    protected static int $installedCount = 0;

    public function __construct()
    {
        helper('plugins');

        $this->registerPlugins();
    }

    /**
     * @param value-of<static::HOOKS> $name
     * @param array<mixed> $arguments
     */
    public function __call(string $name, array $arguments): void
    {
        if (! in_array($name, static::HOOKS, true)) {
            return;
        }

        $this->runHook($name, $arguments);
    }

    /**
     * @return array<BasePlugin>
     */
    public function getPlugins(int $page, int $perPage): array
    {
        return array_slice(static::$plugins, (($page - 1) * $perPage), $perPage);
    }

    /**
     * @param value-of<static::HOOKS> $name
     * @param array<mixed> $arguments
     */
    public function runHook(string $name, array $arguments): void
    {
        foreach (static::$plugins as $plugin) {
            // only run hook on active plugins
            if ($plugin->isActive()) {
                $plugin->{$name}(...$arguments);
            }
        }
    }

    public function activate(string $pluginKey): void
    {
        set_plugin_option($pluginKey, 'active', true);
    }

    public function deactivate(string $pluginKey): void
    {
        set_plugin_option($pluginKey, 'active', false);
    }

    public function getInstalledCount(): int
    {
        return static::$installedCount;
    }

    protected function registerPlugins(): void
    {
        // search for plugins in plugins folder
        $pluginsFiles = glob(ROOTPATH . '/plugins/**/Plugin.php', GLOB_NOSORT);

        if (! $pluginsFiles) {
            return;
        }

        $locator = service('locator');
        foreach ($pluginsFiles as $file) {
            $className = $locator->findQualifiedNameFromPath($file);

            if ($className === false) {
                continue;
            }

            $plugin = new $className(basename(dirname($file)), $file);
            if (! $plugin instanceof BasePlugin) {
                continue;
            }

            static::$plugins[] = $plugin;
            ++static::$installedCount;
        }
    }
}
