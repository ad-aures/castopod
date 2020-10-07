<?php

/**
 * Class AddAnalyticsPodcastsByPlayer
 * Creates analytics_podcasts_by_player table in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAnalyticsPodcastsByPlayer extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'podcast_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'date' => [
                'type' => 'date',
            ],
            'app' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'device' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
            ],
            'os' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
            ],
            'bot' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'hits' => [
                'type' => 'INT',
                'constraint' => 10,
                'default' => 1,
            ],
        ]);
        $this->forge->addPrimaryKey([
            'podcast_id',
            'date',
            'app',
            'device',
            'os',
            'bot',
        ]);
        $this->forge->addField(
            '`created_at` timestamp NOT NULL DEFAULT current_timestamp()'
        );
        $this->forge->addField(
            '`updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()'
        );
        $this->forge->addForeignKey('podcast_id', 'podcasts', 'id');
        $this->forge->createTable('analytics_podcasts_by_player');
    }

    public function down()
    {
        $this->forge->dropTable('analytics_podcasts_by_player');
    }
}
