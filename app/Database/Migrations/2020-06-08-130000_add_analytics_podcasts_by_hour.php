<?php

/**
 * Class AddAnalyticsPodcastsByHour
 * Creates analytics_podcasts_by_hour table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAnalyticsPodcastsByHour extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'podcast_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'date' => [
                'type' => 'DATE',
            ],
            'hour' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'hits' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 1,
            ],
        ]);
        $this->forge->addPrimaryKey(['podcast_id', 'date', 'hour']);
        $this->forge->addField(
            '`created_at` timestamp NOT NULL DEFAULT current_timestamp()',
        );
        $this->forge->addField(
            '`updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()',
        );
        $this->forge->createTable('analytics_podcasts_by_hour');
    }

    public function down()
    {
        $this->forge->dropTable('analytics_podcasts_by_hour');
    }
}
