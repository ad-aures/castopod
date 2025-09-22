<?php

declare(strict_types=1);

namespace Modules\Plugins\Commands;

use Castopod\PluginsManager\PluginsManager;
use Override;

class Add extends BaseCommand
{
    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'plugins:add';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Add a plugin from the plugins repository given its name and version.';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'plugins:add [arguments] [options]';

    /**
     * The Command's Arguments
     *
     * @var array<string,string>
     */
    protected $arguments = [
        'plugin' => 'The pluginKey and an optional version separated by an @. If version is not provided, the latest will be added by default.',
    ];

    /**
     * Actually execute a command.
     *
     * @param array<string> $params
     */
    #[Override]
    public function run(array $params): void
    {
        parent::run($params);

        $plugins = $this->parsePluginsParams($params);

        /** @var PluginsManager $cpm */
        $cpm = service('cpm');

        $cpm->install($plugins);
    }

    /**
     * @param array<string> $params
     * @return array<string,string|null>
     */
    private function parsePluginsParams(array $params): array
    {
        $plugins = [];
        foreach ($params as $param) {
            preg_match(
                '/^(?<pluginKey>[a-z0-9]([_.-]?[a-z0-9]+)*\/[a-z0-9]([_.-]?[a-z0-9]+)*)(@(?<version>\S+))?\s*$/',
                $param,
                $matches,
            );

            if (array_key_exists('pluginKey', $matches)) {
                $plugins[$matches['pluginKey']] = $matches['version'] ?? null;
            }
        }

        return $plugins;
    }
}
