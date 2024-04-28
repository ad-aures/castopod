<?php

declare(strict_types=1);

namespace Modules\Plugins;

class Plugins
{
    /**
     * @var array<PluginInterface>
     */
    protected array $installed = [];

    public function registerPlugin(PluginInterface $plugin): void
    {
        $this->installed[] = $plugin;
    }

    /**
     * @return array<PluginInterface>
     */
    public function getInstalled(): array
    {
        return $this->installed;
    }
}
