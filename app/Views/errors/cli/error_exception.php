<?php

declare(strict_types=1);

use CodeIgniter\CLI\CLI;

// The main Exception
CLI::newLine();
CLI::write('[' . $exception::class . ']', 'light_gray', 'red');
CLI::newLine();
CLI::write($message);
CLI::newLine();
CLI::write('at ' . CLI::color(clean_path($exception->getFile()) . ':' . $exception->getLine(), 'green', ), );
CLI::newLine();
// The backtrace
if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE) {
    $backtraces = $exception->getTrace();

    if ($backtraces) {
        CLI::write('Backtrace:', 'green');
    }

    foreach ($backtraces as $i => $error) {
        $padFile = '    ';
        $c = str_pad($i + 1, 3, ' ', STR_PAD_LEFT);

        if (isset($error['file'])) {
            $filepath = clean_path($error['file']) . ':' . $error['line'];

            CLI::write($c . $padFile . CLI::color($filepath, 'yellow'));
        } else {
            CLI::write($c . $padFile . CLI::color('[internal function]', 'yellow'), );
        }

        $function = '';

        if (isset($error['class'])) {
            $type =
                $error['type'] === '->'
                    ? '()' . $error['type']
                    : $error['type'];
            $function .=
                $padClass . $error['class'] . $type . $error['function'];
        } elseif (! isset($error['class']) && isset($error['function'])) {
            $function .= $padClass . $error['function'];
        }

        $args = implode(
            ', ',
            array_map(function ($value) {
                return match (true) {
                    is_object($value) => 'Object(' . $value::class . ')',
                    is_array($value) => $value !== [] ? '[...]' : '[]',
                    $value === null => 'null',
                    default => var_export($value, true),
                };
            }, array_values($error['args'] ?? [])),
        );

        $function .= '(' . $args . ')';

        CLI::write($function);
        CLI::newLine();
    }
}
