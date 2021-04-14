<?php

/**
 * Class AddAnalyticsWebsiteByReferer
 * Creates analytics_website_by_referer table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAnalyticsWebsiteByReferer extends Migration
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
            'referer_url' => [
                'type' => 'VARCHAR',
                'constraint' => 512,
            ],
            'domain' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => true,
            ],
            'keywords' => [
                'type' => 'VARCHAR',
                'constraint' => 384, // length of referer_url (512) - domain (128)
                'null' => true,
            ],
            'hits' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 1,
            ],
        ]);
        $this->forge->addPrimaryKey(['podcast_id', 'date', 'referer_url']);
        $this->forge->addField(
            '`created_at` timestamp NOT NULL DEFAULT current_timestamp()',
        );
        $this->forge->addField(
            '`updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()',
        );
        $this->forge->createTable('analytics_website_by_referer');
    }

    public function down()
    {
        $this->forge->dropTable('analytics_website_by_referer');
    }
}
