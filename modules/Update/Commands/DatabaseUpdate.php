<?php

declare(strict_types=1);

namespace Modules\Update\Commands;

use CodeIgniter\CLI\BaseCommand;
use Override;

class DatabaseUpdate extends BaseCommand
{
    /**
     * @var string
     */
    protected $group = 'maintenance';

    /**
     * @var string
     */
    protected $name = 'castopod:database-update';

    /**
     * @var string
     */
    protected $description = 'Runs all new database migrations for Castopod.';

    #[Override]
    public function run(array $params): void
    {
        $migrate = service('migrations');

        $migrate->setNamespace(null)
            ->latest();
    }
}
