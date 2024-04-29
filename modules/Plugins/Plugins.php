<?php

declare(strict_types=1);

namespace Modules\Plugins;

class Plugins
{
    /**
     * @var array<PluginInterface>
     */
    protected static array $plugins = [];

    public function __construct()
    {
        $this->registerPlugins();
    }

    /**
     * @return array<PluginInterface>
     */
    public function getPlugins(): array
    {
        return $this->plugins;
    }

    /**
     * @param array<mixed> $parameters
     */
    public function runHook(string $name, array $parameters): void
    {
        dd(static::$plugins);
        // only run active plugins' hooks
        foreach (static::$plugins as $plugin) {
            $plugin->{$name}(...$parameters);
        }
    }

    protected function registerPlugins(): void
    {
        $locator = service('locator');
        $pluginsFiles = $locator->search('HelloWorld/Plugin.php');

        // dd($pluginsFiles);

        foreach ($pluginsFiles as $file) {
            $className = $locator->findQualifiedNameFromPath($file);

            dd($file);
            if ($className === false) {
                continue;
            }

            $plugin = new $className();
            if (! $plugin instanceof PluginInterface) {
                continue;
            }

            static::$plugins[] = $plugin;
        }
    }
}
