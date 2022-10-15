<?php

declare(strict_types=1);

/**
 * Class AddPodcastsCategories Creates podcasts_categories table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPodcastsCategories extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'podcast_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'category_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
        ]);
        $this->forge->addPrimaryKey(['podcast_id', 'category_id']);
        $this->forge->addForeignKey('podcast_id', 'podcasts', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', '', 'CASCADE');
        $this->forge->createTable('podcasts_categories');
    }

    public function down(): void
    {
        $this->forge->dropTable('podcasts_categories');
    }
}
