<?php

/**
 * Class AddAnalyticsPodcasts Creates analytics_podcasts table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAnalyticsPodcasts extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'podcast_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'date' => [
                'type' => 'DATE',
            ],
            'duration' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'bandwidth' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'unique_listeners' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 1,
            ],
            'hits' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 1,
            ],
        ]);
        $this->forge->addPrimaryKey(['podcast_id', 'date']);
        $this->forge->addField('`created_at` timestamp NOT NULL DEFAULT current_timestamp()',);
        $this->forge->addField(
            '`updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()',
        );
        $this->forge->createTable('analytics_podcasts');
    }

    public function down(): void
    {
        $this->forge->dropTable('analytics_podcasts');
    }
}
