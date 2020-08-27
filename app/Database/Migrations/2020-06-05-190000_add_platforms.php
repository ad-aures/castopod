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
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'unique' => true,
            ],
            'label' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
            ],
            'home_url' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
            ],
            'submit_url' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true,
                'default' => null,
            ],
            'icon_filename' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
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
