<?php

declare(strict_types=1);

namespace Modules\Plugins\Commands;

use Castopod\PluginsManager\Logger\FormatterInterface;
use Castopod\PluginsManager\Logger\LogLevel;
use CodeIgniter\CLI\CLI;

class CpmFormatterDebug implements FormatterInterface
{
    public function format(LogLevel $level, array $log): void
    {
        match ($level) {
            LogLevel::Success => CLI::write(
                sprintf('%s %s', CLI::color($level->name, 'white', 'green'), json_encode(
                    $log,
                    JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT,
                )),
            ),
            LogLevel::Warning => CLI::write(
                sprintf('%s %s', CLI::color($level->name, 'white', 'yellow'), json_encode(
                    $log,
                    JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT,
                )),
            ),
            LogLevel::Error => CLI::write(
                sprintf('%s %s', CLI::color($level->name, 'white', 'red'), json_encode(
                    $log,
                    JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT,
                )),
            ),
            default => CLI::write(
                sprintf('%s %s', CLI::color($level->name, 'white', 'blue'), json_encode(
                    $log,
                    JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT,
                )),
            ),
        };
    }
}
