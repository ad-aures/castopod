<?php

/**
 * Class AddLanguages
 * Creates languages table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLanguages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'code' => [
                'type' => 'VARCHAR',
                'comment' => 'ISO 639-1 language code',
                'constraint' => 2,
            ],
            'native_name' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
        ]);
        $this->forge->addKey('code', true);
        $this->forge->createTable('languages');
    }

    public function down()
    {
        $this->forge->dropTable('languages');
    }
}
