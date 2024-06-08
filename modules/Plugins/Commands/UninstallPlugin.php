<?php

declare(strict_types=1);

namespace Modules\Plugins\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Modules\Plugins\Core\Plugins;
use Override;

class UninstallPlugin extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Plugins';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'plugins:uninstall';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Removes a plugin from the plugins directory.';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'plugins:uninstall [plugins]';

    /**
     * The Command's Arguments
     *
     * @var array<string, string>
     */
    protected $arguments = [
        'plugins' => 'One or more plugins as vendor/plugin',
    ];

    /**
     * @param list<string> $pluginKeys
     */
    #[Override]
    public function run(array $pluginKeys): int
    {
        /** @var Plugins $plugins */
        $plugins = service('plugins');

        /** @var list<string> $errors */
        $errors = [];
        foreach ($pluginKeys as $pluginKey) {
            $plugin = $plugins->getPluginByKey($pluginKey);

            if ($plugin === null) {
                $errors[] = sprintf('Plugin %s was not found.', $pluginKey);
                continue;
            }

            if (! $plugins->uninstall($plugin)) {
                $errors[] = sprintf('Something happened when removing %s', $pluginKey);
            }
        }

        foreach ($errors as $error) {
            CLI::error($error . PHP_EOL);
        }

        return $errors === [] ? 0 : 1;
    }
}
