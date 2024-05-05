<?php

declare(strict_types=1);

namespace Modules\Plugins;

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Libraries\SimpleRSSElement;
use Config\Database;

/**
 * @method void channelTag(Podcast $podcast, SimpleRSSElement $channel)
 * @method void itemTag(Episode $episode, SimpleRSSElement $item)
 * @method string siteHead()
 */
class Plugins
{
    public const API_VERSION = '1.0';

    /**
     * @var list<string>
     */
    public const HOOKS = ['channelTag', 'itemTag', 'siteHead'];

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
     * @return array<BasePlugin>
     */
    public function getPluginsWithPodcastSettings(): array
    {
        $pluginsWithPodcastSettings = [];
        foreach (static::$plugins as $plugin) {
            if (! $plugin->isActive()) {
                continue;
            }

            if ($plugin->settings['podcast'] === []) {
                continue;
            }

            $pluginsWithPodcastSettings[] = $plugin;
        }

        return $pluginsWithPodcastSettings;
    }

    /**
     * @return array<BasePlugin>
     */
    public function getPluginsWithEpisodeSettings(): array
    {
        $pluginsWithEpisodeSettings = [];
        foreach (static::$plugins as $plugin) {
            if (! $plugin->isActive()) {
                continue;
            }

            if ($plugin->settings['episode'] === []) {
                continue;
            }

            $pluginsWithEpisodeSettings[] = $plugin;
        }

        return $pluginsWithEpisodeSettings;
    }

    public function getPlugin(string $key): ?BasePlugin
    {
        foreach (static::$plugins as $plugin) {
            if ($plugin->getKey() === $key) {
                return $plugin;
            }
        }

        return null;
    }

    /**
     * @param value-of<static::HOOKS> $name
     * @param array<mixed> $arguments
     */
    public function runHook(string $name, array $arguments): void
    {
        foreach (static::$plugins as $plugin) {
            // only run hook on active plugins
            if (! $plugin->isActive()) {
                continue;
            }

            if (! $plugin->isHookDeclared($name)) {
                continue;
            }

            $plugin->{$name}(...$arguments);
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

    /**
     * @param ?array{'podcast'|'episode',int} $additionalContext
     */
    public function setOption(string $pluginKey, string $name, mixed $value, array $additionalContext = null): void
    {
        set_plugin_option($pluginKey, $name, $value, $additionalContext);
    }

    public function getInstalledCount(): int
    {
        return static::$installedCount;
    }

    public function uninstall(string $pluginKey): bool
    {
        // remove all settings data
        $db = Database::connect();
        $builder = $db->table('settings');

        $db->transStart();
        $builder->where('class', self::class);
        $builder->like('context', sprintf('plugin:%s', $pluginKey . '%'));

        if (! $builder->delete()) {
            $db->transRollback();
            return false;
        }

        // delete plugin folder from PLUGINS_PATH
        $pluginFolder = PLUGINS_PATH . $pluginKey;
        $rmdirResult = $this->rrmdir($pluginFolder);

        $transResult = $db->transCommit();

        return $rmdirResult && $transResult;
    }

    protected function registerPlugins(): void
    {
        // search for plugins in plugins folder
        // TODO: only get directories? Should be organized as author/repo?
        $pluginsFiles = glob(PLUGINS_PATH . '**/Plugin.php');

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

    /**
     * Adapted from https://stackoverflow.com/a/3338133
     */
    private function rrmdir(string $dir): bool
    {
        if (! is_dir($dir)) {
            return false;
        }

        $objects = scandir($dir);

        if (! $objects) {
            return false;
        }

        foreach ($objects as $object) {
            if ($object === '.') {
                continue;
            }

            if ($object === '..') {
                continue;
            }

            if (is_dir($dir . DIRECTORY_SEPARATOR . $object) && ! is_link($dir . '/' . $object)) {
                $this->rrmdir($dir . DIRECTORY_SEPARATOR . $object);
            } else {
                unlink($dir . DIRECTORY_SEPARATOR . $object);
            }
        }

        return rmdir($dir);
    }
}
