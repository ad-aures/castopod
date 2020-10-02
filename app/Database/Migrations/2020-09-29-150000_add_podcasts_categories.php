<?php

/**
 * Class AddPodcastsCategories
 * Creates podcasts_categories table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPodcastsCategories extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'podcast_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addPrimaryKey(['podcast_id', 'category_id']);
        $this->forge->addForeignKey('podcast_id', 'podcasts', 'id');
        $this->forge->addForeignKey('category_id', 'categories', 'id');
        $this->forge->createTable('podcasts_categories');
    }

    public function down()
    {
        $this->forge->dropTable('podcasts_categories');
    }
}
