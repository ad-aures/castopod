<?php

declare(strict_types=1);

namespace Modules\Plugins\Commands;

use Castopod\PluginsManager\PluginsManager;
use CodeIgniter\CLI\CLI;
use Modules\Plugins\Core\Plugins;
use Override;

class Remove extends BaseCommand
{
    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'plugins:remove';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Deletes every data associated with the plugin and removes it the plugins directory.';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'plugins:remove [plugins]';

    /**
     * The Command's Arguments
     *
     * @var array<string, string>
     */
    protected $arguments = [
        'plugins' => 'One or more plugins as vendor/plugin',
    ];

    /**
     * @param list<string> $params
     */
    #[Override]
    public function run(array $params): int
    {
        parent::run($params);

        /** @var Plugins $plugins */
        $plugins = service('plugins');

        /** @var PluginsManager $cpm */
        $cpm = service('cpm');

        /** @var list<string> $errors */
        $errors = [];
        foreach ($params as $pluginKey) {
            $plugin = $plugins->getPluginByKey($pluginKey);

            if ($plugin === null) {
                $errors[] = sprintf('Plugin %s was not found.', $pluginKey);
                continue;
            }

            if (! $plugins->uninstall($plugin)) {
                $errors[] = sprintf('Something happened when removing %s', $pluginKey);
                break;
            }

            // delete plugin folder
            $cpm->remove($pluginKey);
        }

        foreach ($errors as $error) {
            CLI::write(' error ', 'white', 'red');
            CLI::error($error);
            CLI::newLine();
        }

        return $errors === [] ? 0 : 1;
    }
}
