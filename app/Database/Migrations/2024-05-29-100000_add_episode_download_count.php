<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEpisodeDownloadsCount extends Migration
{
    public function up(): void
    {
        $fields = [
            'downloads_count' => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 0,
                'after'    => 'is_published_on_hubs',
            ],
        ];

        $this->forge->addColumn('episodes', $fields);
    }

    public function down(): void
    {
        $this->forge->dropColumn('episodes', 'downloads_count');
    }
}
