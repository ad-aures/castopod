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
            'home_url' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
            ],
            'submit_url' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true,
            ],
            'iosapp_url' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true,
            ],
            'androidapp_url' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true,
            ],
            'comment' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'display_by_default' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'ios_deeplink' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'android_deeplink' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'comment' =>
                    'Android deeplinking for this platform: 0=No, 1=Manual, 2=Automatic.',
            ],
            'logo_file_name' => [
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
