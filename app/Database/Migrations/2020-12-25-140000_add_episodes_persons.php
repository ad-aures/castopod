<?php

/**
 * Class AddEpisodesPersons Creates episodes_persons table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEpisodesPersons extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'podcast_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'episode_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'person_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'person_group' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
            ],
            'person_role' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey(['podcast_id', 'episode_id', 'person_id', 'person_group', 'person_role']);
        $this->forge->addForeignKey('podcast_id', 'podcasts', 'id', '', 'CASCADE',);
        $this->forge->addForeignKey('episode_id', 'episodes', 'id', '', 'CASCADE',);
        $this->forge->addForeignKey('person_id', 'persons', 'id', '', 'CASCADE',);
        $this->forge->createTable('episodes_persons');
    }

    public function down(): void
    {
        $this->forge->dropTable('episodes_persons');
    }
}
