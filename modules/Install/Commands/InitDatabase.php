<?php

declare(strict_types=1);

namespace Modules\Install\Commands;

use CodeIgniter\CLI\BaseCommand;
use Config\Database;
use Override;

class InitDatabase extends BaseCommand
{
    /**
     * @var string
     */
    protected $group = 'Install';

    /**
     * @var string
     */
    protected $name = 'install:init-database';

    /**
     * @var string
     */
    protected $description = 'Runs all database migrations for Castopod.';

    #[Override]
    public function run(array $params): void
    {
        // Run all migrations
        $migrate = service('migrations');
        $migrate->setNamespace(null)
            ->latest();

        // Seed database
        $seeder = Database::seeder();
        $seeder->call('AppSeeder');
    }
}
