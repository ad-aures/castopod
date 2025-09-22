<?php

declare(strict_types=1);

namespace Modules\Plugins\Core;

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Libraries\HtmlHead;
use App\Libraries\RssFeed;
use Config\Database;
use Modules\Plugins\Config\Plugins as PluginsConfig;

/**
 * @method void rssBeforeChannel(Podcast $podcast)
 * @method void rssAfterChannel(Podcast $podcast, RssFeed $channel)
 * @method void rssBeforeItem(Episode $episode)
 * @method void rssAfterItem(Episode $episode, RssFeed $item)
 * @method void siteHead(HtmlHead $head)
 */
class Plugins
{
    /**
     * @var list<string>
     */
    public const HOOKS = ['rssBeforeChannel', 'rssAfterChannel', 'rssBeforeItem', 'rssAfterItem', 'siteHead'];

    public const CACHE_MAP = [
        'rssBeforeChannel' => ['podcast*feed*'],
        'rssAfterChannel'  => ['podcast*feed*'],
        'rssBeforeItem'    => ['podcast*feed*'],
        'rssAfterItem'     => ['podcast*feed*'],
        'siteHead'         => ['page*'],
    ];

    public const FIELDS_VALIDATIONS = [
        'checkbox'        => ['permit_empty'],
        'datetime'        => ['valid_date[Y-m-d H:i]'],
        'email'           => ['valid_email'],
        'group'           => ['permit_empty', 'is_list'],
        'html'            => ['string'],
        'markdown'        => ['string'],
        'number'          => ['integer'],
        'radio-group'     => ['string'],
        'rss'             => ['string'],
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
        'markdown' => 'markdown',
        'number'   => 'int',
        'rss'      => 'rss',
        'toggler'  => 'bool',
        'url'      => 'uri',
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

    public function __construct(
        protected PluginsConfig $config,
    ) {
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
    public function getPlugins(int $page = 1, int $perPage = 12): array
    {
        return array_slice(static::$plugins, (($page - 1) * $perPage), $perPage);
    }

    /**
     * @return array<BasePlugin>
     */
    public function getAllPlugins(): array
    {
        return static::$plugins;
    }

    /**
     * @return array<BasePlugin>
     */
    public function getActivePlugins(): array
    {
        $activePlugins = [];
        foreach (static::$plugins as $plugin) {
            if ($plugin->getStatus() === PluginStatus::ACTIVE) {
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
            if ($plugin->getStatus() !== PluginStatus::ACTIVE) {
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
            if ($plugin->getStatus() !== PluginStatus::ACTIVE) {
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
            if ($plugin->getPackage() === $package) {
                return $plugin;
            }
        }

        return null;
    }

    public function getPluginByKey(string $key): ?BasePlugin
    {
        if (! str_contains($key, '/')) {
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
            if ($plugin->getStatus() !== PluginStatus::ACTIVE) {
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
        if ($plugin->activate()) {
            ++self::$activeCount;
        }
    }

    public function deactivate(BasePlugin $plugin): void
    {
        if ($plugin->deactivate()) {
            --self::$activeCount;
        }
    }

    /**
     * @param ?array{'podcast'|'episode',int} $additionalContext
     */
    public function setOption(BasePlugin $plugin, string $name, mixed $value, ?array $additionalContext = null): void
    {
        set_plugin_setting($plugin->getKey(), $name, $value, $additionalContext);
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

        return $db->transCommit();
    }

    protected function registerPlugins(): void
    {
        // search for plugins in plugins folder
        $pluginsDirectories = glob($this->config->folder . '*/*', GLOB_ONLYDIR);

        if ($pluginsDirectories === false || $pluginsDirectories === []) {
            return;
        }

        foreach ($pluginsDirectories as $pluginDirectory) {
            $vendor = basename(dirname($pluginDirectory));
            $package = basename($pluginDirectory);

            if (preg_match('~' . PLUGINS_KEY_PATTERN . '~', $vendor . '/' . $package) === false) {
                continue;
            }

            $className = str_replace(
                ' ',
                '',
                ucwords(str_replace(['-', '_', '.'], ' ', $vendor . ' ' . $package)) . 'Plugin',
            );

            $pluginFile = $pluginDirectory . DIRECTORY_SEPARATOR . 'Plugin.php';
            spl_autoload_register(static function ($class) use (&$className, &$pluginFile): void {
                if ($class !== $className) {
                    return;
                }

                if (! file_exists($pluginFile)) {
                    return;
                }

                include_once $pluginFile;
            }, true);

            if (! class_exists($className)) {
                continue;
            }

            $plugin = new $className($vendor, $package, $pluginDirectory);
            if (! $plugin instanceof BasePlugin) {
                continue;
            }

            static::$plugins[] = $plugin;
            static::$pluginsByVendor[$vendor][] = $plugin;
            ++static::$installedCount;

            if ($plugin->getStatus() === PluginStatus::ACTIVE) {
                ++static::$activeCount;
            }
        }
    }
}
