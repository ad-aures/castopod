<?php

/**
 * Class AddAnalyticsWebsiteByReferer
 * Creates analytics_website_by_referer table in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAnalyticsWebsiteByReferer extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'podcast_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'referer' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'comment' => 'Referer URL.',
            ],
            'date' => [
                'type' => 'date',
            ],
            'hits' => [
                'type' => 'INT',
                'constraint' => 10,
                'default' => 1,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['podcast_id', 'referer', 'date']);
        $this->forge->addField(
            '`created_at` timestamp NOT NULL DEFAULT current_timestamp()'
        );
        $this->forge->addField(
            '`updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()'
        );
        $this->forge->addForeignKey('podcast_id', 'podcasts', 'id');
        $this->forge->createTable('analytics_website_by_referer');
    }

    public function down()
    {
        $this->forge->dropTable('analytics_website_by_referer');
    }
}
