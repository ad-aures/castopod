<?php

/**
 * Class AddPodcastsPersons
 * Creates podcasts_persons table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPodcastsPersons extends Migration
{
    public function up()
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
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey([
            'podcast_id',
            'person_id',
            'person_group',
            'person_role',
        ]);
        $this->forge->addForeignKey(
            'podcast_id',
            'podcasts',
            'id',
            false,
            'CASCADE',
        );
        $this->forge->addForeignKey(
            'person_id',
            'persons',
            'id',
            false,
            'CASCADE',
        );
        $this->forge->createTable('podcasts_persons');
    }

    public function down()
    {
        $this->forge->dropTable('podcasts_persons');
    }
}
