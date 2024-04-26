<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * CodeIgniter 4.5.1 introduces new DataCaster class that breaks deserialization of import queue tasks.
 * This just removes them altogether.
 */
class ClearImportQueue extends Migration
{
    public function up(): void
    {
        service('settings')->forget('Import.queue');
    }

    public function down(): void
    {
        // nothing
    }
}
