<?php

/**
 * Class AddPlatforms
 * Creates platforms table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPlatforms extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
                'unique' => true,
            ],
            'label' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
            ],
            'home_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'submit_url' => [
                'type' => 'VARCHAR',
                'constraint' => 512,
                'null' => true,
                'default' => null,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('platforms');
    }

    public function down()
    {
        $this->forge->dropTable('platforms');
    }
}
