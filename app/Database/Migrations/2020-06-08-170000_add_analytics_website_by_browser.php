<?php

/**
 * Class AddAnalyticsWebsiteByBrowser
 * Creates analytics_website_by_browser table in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAnalyticsWebsiteByBrowser extends Migration
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
            'browser' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
            ],
            'hits' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 1,
            ],
        ]);

        $this->forge->addPrimaryKey(['podcast_id', 'date', 'browser']);
        $this->forge->addField(
            '`created_at` timestamp NOT NULL DEFAULT current_timestamp()'
        );
        $this->forge->addField(
            '`updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()'
        );
        $this->forge->addForeignKey('podcast_id', 'podcasts', 'id');
        $this->forge->createTable('analytics_website_by_browser');
    }

    public function down()
    {
        $this->forge->dropTable('analytics_website_by_browser');
    }
}
