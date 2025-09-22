<?php

declare(strict_types=1);

namespace Modules\Plugins\Commands;

use Castopod\PluginsManager\Logger\FormatterInterface;
use Castopod\PluginsManager\Logger\LogLevel;
use CodeIgniter\CLI\CLI;

class CpmFormatter implements FormatterInterface
{
    public function format(LogLevel $level, array $log): void
    {
        match ($log['code']) {
            'add.start' => CLI::write(
                sprintf('• adding plugin %s%s', CLI::color(
                    $log['context']['pluginKey'],
                    'white',
                ), $log['context']['constraint'] === null ? '' : '@' . CLI::color(
                    $log['context']['constraint'],
                    'light_yellow',
                )),
            ),
            'add.end' => CLI::write(
                sprintf('+ %s@%s added%s', $log['context']['pluginKey'], $log['context']['version'], PHP_EOL),
                'light_green',
            ),
            'update.start' => CLI::write(sprintf('• updating plugin %s…', $log['context']['pluginKey'])),
            'update.end'   => CLI::write(
                '✔ ' . sprintf(
                    '%s updated to version %s%s',
                    $log['context']['pluginKey'],
                    $log['context']['version'],
                    PHP_EOL,
                ),
                'light_green',
            ),
            'remove.start' => CLI::write(sprintf('• removing plugin %s…', $log['context']['pluginKey'])),
            'remove.end'   => CLI::write(
                '- ' . sprintf('%s was removed%s', $log['context']['pluginKey'], PHP_EOL),
                'light_red',
            ),
            default => null,
        };

        if ($level === LogLevel::Warning) {
            CLI::write('⚠️  ' . $log['message'], 'light_yellow');
        }

        if ($level === LogLevel::Error) {
            CLI::newLine();
            CLI::write(' error ', 'white', 'red');
            CLI::error($log['message']);
            CLI::newLine();

            exit(1); // exit with error, something wrong happened
        }
    }
}
