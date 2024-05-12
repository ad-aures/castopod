<?php

declare(strict_types=1);

namespace Modules\Plugins\Core;

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

    public const FIELDS_VALIDATIONS = [
        'checkbox'        => ['permit_empty'],
        'datetime'        => ['valid_date[Y-m-d H:i]'],
        'email'           => ['valid_email'],
        'markdown'        => ['string'],
        'number'          => ['integer'],
        'radio-group'     => ['string'],
        'select'          => ['string'],
        'select-multiple' => ['permit_empty', 'is_list'],
        'text'            => ['string'],
        'textarea'        => ['string'],
        'toggler'         => ['permit_empty'],
        'url'             => ['valid_url_strict'],
    ];

    public const FIELDS_CASTS = [
        'checkbox' => 'bool',
        'datetime' => 'datetime',
        'number'   => 'int',
        'toggler'  => 'bool',
        'url'      => 'uri',
        'markdown' => 'markdown',
    ];

    /**
     * @var array<BasePlugin>
     */
    protected static array $plugins = [];

    /**
     * @var array<string,BasePlugin[]>
     */
    protected static array $pluginsByVendor = [];

    protected static int $installedCount = 0;

    protected static int $activeCount = 0;

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
    public function getActivePlugins(): array
    {
        $activePlugins = [];
        foreach (static::$plugins as $plugin) {
            if ($plugin->isActive()) {
                $activePlugins[] = $plugin;
            }
        }

        return $activePlugins;
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

            if ($plugin->getSettingsFields('podcast') === []) {
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

            if ($plugin->getSettingsFields('episode') === []) {
                continue;
            }

            $pluginsWithEpisodeSettings[] = $plugin;
        }

        return $pluginsWithEpisodeSettings;
    }

    /**
     * @return array<BasePlugin>
     */
    public function getVendorPlugins(string $vendor): array
    {
        return static::$pluginsByVendor[$vendor] ?? [];
    }

    public function getPlugin(string $vendor, string $package): ?BasePlugin
    {
        foreach ($this->getVendorPlugins($vendor) as $plugin) {
            if ($plugin->getKey() === $vendor . '/' . $package) {
                return $plugin;
            }
        }

        return null;
    }

    public function getPluginByKey(string $key): ?BasePlugin
    {
        if (! str_contains('/', $key)) {
            return null;
        }

        $keyArray = explode('/', $key);
        return $this->getPlugin($keyArray[0], $keyArray[1]);
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

    public function activate(BasePlugin $plugin): void
    {
        set_plugin_option($plugin->getKey(), 'active', true);
    }

    public function deactivate(BasePlugin $plugin): void
    {
        set_plugin_option($plugin->getKey(), 'active', false);
    }

    /**
     * @param ?array{'podcast'|'episode',int} $additionalContext
     */
    public function setOption(BasePlugin $plugin, string $name, mixed $value, array $additionalContext = null): void
    {
        set_plugin_option($plugin->getKey(), $name, $value, $additionalContext);
    }

    public function getInstalledCount(): int
    {
        return static::$installedCount;
    }

    public function getActiveCount(): int
    {
        return static::$activeCount;
    }

    public function uninstall(BasePlugin $plugin): bool
    {
        // remove all settings data
        $db = Database::connect();
        $builder = $db->table('settings');

        $db->transStart();
        $builder->where('class', self::class);
        $builder->like('context', sprintf('plugin:%s', $plugin->getKey() . '%'));

        if (! $builder->delete()) {
            $db->transRollback();
            return false;
        }

        // delete plugin folder from PLUGINS_PATH
        $pluginFolder = PLUGINS_PATH . $plugin->getKey();
        $rmdirResult = $this->rrmdir($pluginFolder);

        $transResult = $db->transCommit();

        return $rmdirResult && $transResult;
    }

    protected function registerPlugins(): void
    {
        // search for plugins in plugins folder
        $pluginsDirectories = glob(PLUGINS_PATH . '*/*', GLOB_ONLYDIR);

        if ($pluginsDirectories === false || $pluginsDirectories === []) {
            return;
        }

        $locator = service('locator');
        foreach ($pluginsDirectories as $pluginDirectory) {
            $vendor = basename(dirname($pluginDirectory));
            $package = basename($pluginDirectory);

            if (preg_match('~' . PLUGINS_KEY_PATTERN . '~', $vendor . '/' . $package) === false) {
                continue;
            }

            $pluginFile = $pluginDirectory . DIRECTORY_SEPARATOR . 'Plugin.php';

            $className = $locator->findQualifiedNameFromPath($pluginFile);

            if ($className === false) {
                continue;
            }

            $plugin = new $className($vendor, $package, $pluginDirectory);
            if (! $plugin instanceof BasePlugin) {
                continue;
            }

            static::$plugins[] = $plugin;
            static::$pluginsByVendor[$vendor][] = $plugin;
            ++static::$installedCount;

            if ($plugin->isActive()) {
                ++static::$activeCount;
            }
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
