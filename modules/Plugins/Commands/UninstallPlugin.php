<?php

declare(strict_types=1);

namespace Modules\Plugins\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

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
    protected $description = '';

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
    public function run(array $pluginKeys): int
    {
        $validation = service('validation');

        /** @var list<string> $errors */
        $errors = [];
        foreach ($pluginKeys as $pluginKey) {
            // TODO: change validation of pluginKey
            if (! $validation->check($pluginKey, 'required')) {
                $errors = [...$errors, ...$validation->getErrors()];
                continue;
            }

            if (! service('plugins')->uninstall($pluginKey)) {
                $errors[] = sprintf('Something happened when removing %s', $pluginKey);
            }
        }

        foreach ($errors as $error) {
            CLI::error($error . PHP_EOL);
        }

        return $errors === [] ? 0 : 1;
    }
}
