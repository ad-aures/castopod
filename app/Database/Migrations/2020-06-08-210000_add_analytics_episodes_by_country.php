<?php

/**
 * Class AddAnalyticsEpisodesByCountry
 * Creates analytics_episodes_by_country table in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAnalyticsEpisodesByCountry extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
                'comment' => 'The line ID',
            ],
            'podcast_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'comment' => 'The podcast ID',
            ],
            'episode_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'comment' => 'The episode ID',
            ],
            'country_code' => [
                'type' => 'VARCHAR',
                'constraint' => 3,
                'comment' => 'ISO 3166-1 code.',
            ],
            'date' => [
                'type' => 'date',
                'comment' => 'Line date.',
            ],
            'hits' => [
                'type' => 'INT',
                'constraint' => 10,
                'default' => 1,
                'comment' => 'Number of hits.',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey([
            'podcast_id',
            'episode_id',
            'country_code',
            'date',
        ]);
        $this->forge->addField(
            '`created_at` timestamp NOT NULL DEFAULT current_timestamp()'
        );
        $this->forge->addField(
            '`updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()'
        );
        $this->forge->addForeignKey('podcast_id', 'podcasts', 'id');
        $this->forge->addForeignKey('episode_id', 'episodes', 'id');
        $this->forge->createTable('analytics_episodes_by_country');
    }

    public function down()
    {
        $this->forge->dropTable('analytics_episodes_by_country');
    }
}
