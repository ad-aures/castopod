<?php

/**
 * Class AddAnalyticsPodcastsByRegion
 * Creates analytics_podcasts_by_region table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAnalyticsPodcastsByRegion extends Migration
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
            'country_code' => [
                'type' => 'VARCHAR',
                'constraint' => 3,
                'comment' => 'ISO 3166-1 code.',
            ],
            'region_code' => [
                'type' => 'VARCHAR',
                'constraint' => 3,
                'comment' => 'ISO 3166-2 code.',
            ],
            'latitude' => [
                'type' => 'FLOAT',
                'null' => true,
            ],
            'longitude' => [
                'type' => 'FLOAT',
                'null' => true,
            ],
            'hits' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 1,
            ],
        ]);
        $this->forge->addPrimaryKey([
            'podcast_id',
            'date',
            'country_code',
            'region_code',
        ]);
        $this->forge->addField(
            '`created_at` timestamp NOT NULL DEFAULT current_timestamp()',
        );
        $this->forge->addField(
            '`updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()',
        );
        $this->forge->createTable('analytics_podcasts_by_region');
    }

    public function down(): void
    {
        $this->forge->dropTable('analytics_podcasts_by_region');
    }
}
