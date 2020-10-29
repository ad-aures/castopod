<?php

/**
 * Class AddPlatformsLinks
 * Creates platform_links table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPodcastsPlatforms extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'podcast_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'platform_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'link_url' => [
                'type' => 'VARCHAR',
                'constraint' => 512,
            ],
            'is_visible' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addPrimaryKey(['podcast_id', 'platform_id']);
        $this->forge->addForeignKey('podcast_id', 'podcasts', 'id');
        $this->forge->addForeignKey('platform_id', 'platforms', 'id');
        $this->forge->createTable('platform_links');
    }

    public function down()
    {
        $this->forge->dropTable('platform_links');
    }
}
