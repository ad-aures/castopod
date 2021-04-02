<?php

/**
 * Class AddAnalyticsWebsiteByEntryPage
 * Creates analytics_website_by_entry_page table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAnalyticsWebsiteByEntryPage extends Migration
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
            'entry_page_url' => [
                'type' => 'VARCHAR',
                'constraint' => 512,
            ],
            'hits' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 1,
            ],
        ]);
        $this->forge->addPrimaryKey(['podcast_id', 'date', 'entry_page_url']);
        $this->forge->addField(
            '`created_at` timestamp NOT NULL DEFAULT current_timestamp()',
        );
        $this->forge->addField(
            '`updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()',
        );
        $this->forge->createTable('analytics_website_by_entry_page');
    }

    public function down()
    {
        $this->forge->dropTable('analytics_website_by_entry_page');
    }
}
