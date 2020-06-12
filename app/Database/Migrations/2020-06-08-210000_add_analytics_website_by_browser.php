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
            'browser' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'comment' => 'The Web Browser.',
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
        $this->forge->addUniqueKey(['podcast_id', 'browser', 'date']);
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
