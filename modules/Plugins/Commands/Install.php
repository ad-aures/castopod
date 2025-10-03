<?php

declare(strict_types=1);

namespace Modules\Plugins\Commands;

use Castopod\PluginsManager\PluginsManager;
use Override;

class Install extends BaseCommand
{
    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'plugins:install';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Install all plugins specified in plugins.json file.';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'plugins:install';

    /**
     * Actually execute a command.
     *
     * @param array<string> $params
     */
    #[Override]
    public function run(array $params): void
    {
        parent::run($params);

        /** @var PluginsManager $cpm */
        $cpm = service('cpm');

        $cpm->installFromPluginsTxt();
    }
}
