<?php

declare(strict_types=1);

namespace Modules\Install\Commands;

use CodeIgniter\CLI\BaseCommand;
use Config\Database;
use Config\Services;

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

    public function run(array $params): void
    {
        // Run all migrations
        $migrate = Services::migrations();
        $migrate->setNamespace(null)
            ->latest();

        // Seed database
        $seeder = Database::seeder();
        $seeder->call('AppSeeder');
    }
}
