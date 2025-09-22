<?php

declare(strict_types=1);

namespace Modules\Plugins\Commands;

use Castopod\PluginsManager\PluginsManager;
use CodeIgniter\CLI\CLI;
use Override;

class Update extends BaseCommand
{
    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'plugins:update';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Update a plugin from the plugins repository given its name and version.';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'plugins:update [arguments] [options]';

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
     *
     * @return int|void
     */
    #[Override]
    public function run(array $params)
    {
        parent::run($params);

        if ($params === []) {
            CLI::error('Missing pluginKey argument.');
            return 1;
        }

        /** @var PluginsManager $cpm */
        $cpm = service('cpm');

        $cpm->update($params[0]);
    }
}
