<?php

/**
 * Class AddSoundbites
 * Creates soundbites table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSoundbites extends Migration
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
            'start_time' => [
                'type' => 'FLOAT',
            ],
            'duration' => [
                'type' => 'FLOAT',
            ],
            'label' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => true,
            ],
            'created_by' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'updated_by' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['episode_id', 'start_time', 'duration']);
        $this->forge->addForeignKey(
            'podcast_id',
            'podcasts',
            'id',
            false,
            'CASCADE',
        );
        $this->forge->addForeignKey(
            'episode_id',
            'episodes',
            'id',
            false,
            'CASCADE',
        );
        $this->forge->addForeignKey('created_by', 'users', 'id');
        $this->forge->addForeignKey('updated_by', 'users', 'id');
        $this->forge->createTable('soundbites');
    }

    public function down(): void
    {
        $this->forge->dropTable('soundbites');
    }
}
