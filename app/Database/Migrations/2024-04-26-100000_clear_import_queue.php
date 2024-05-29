<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use Override;

/**
 * CodeIgniter 4.5.1 introduces new DataCaster class that breaks deserialization of import queue tasks.
 * This just removes them altogether.
 */
class ClearImportQueue extends Migration
{
    #[Override]
    public function up(): void
    {
        service('settings')->forget('Import.queue');
    }

    #[Override]
    public function down(): void
    {
        // nothing
    }
}
