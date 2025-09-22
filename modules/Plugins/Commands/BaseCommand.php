<?php

declare(strict_types=1);

namespace Modules\Plugins\Commands;

use Castopod\PluginsManager\Logger\PluginsManagerLogger;
use CodeIgniter\CLI\BaseCommand as CodeIgniterBaseCommand;
use CodeIgniter\CLI\CLI;

class BaseCommand extends CodeIgniterBaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Plugins';

    /**
     * The Command's Options
     *
     * @var array<string,string>
     */
    protected $options = [
        '--debug' => 'Get log trace to follow what is happening under the hood.',
    ];

    /**
     * Actually execute a command.
     *
     * @param array<int,string> $params
     *
     * @return int|void
     */
    public function run(array $params)
    {
        if (CLI::getOption('debug')) {
            PluginsManagerLogger::$formatter = CpmFormatterDebug::class;
        } else {
            PluginsManagerLogger::$formatter = CpmFormatter::class;
        }

        return 0;
    }
}
