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
                'comment' => 'The platform ID',
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'unique' => true,
                'comment' => 'Platform name.',
            ],
            'home_url' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'comment' => 'Platform home URL.',
            ],
            'submit_url' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'comment' => 'Platform URL to submit podcasts.',
                'null' => true,
            ],
            'iosapp_url' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'comment' => 'Platform iOS app URL (if any).',
                'null' => true,
            ],
            'androidapp_url' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'comment' => 'Platform Android app URL (if any).',
                'null' => true,
            ],
            'comment' => [
                'type' => 'TEXT',
                'comment' => 'Comment.',
                'null' => true,
            ],
            'display_by_default' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'comment' =>
                    'True if the platform link should be displayed by default.',
            ],
            'ios_deeplink' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'comment' => 'iOS deeplinking for this platform.',
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
                'comment' => 'The logo for this platform.',
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
