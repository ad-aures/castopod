<?php

declare(strict_types=1);

/**
 * Class AddLanguages Creates languages table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

class AddLanguages extends BaseMigration
{
    public function up(): void
    {
        $this->forge->addField([
            'code' => [
                'type'       => 'VARCHAR',
                'comment'    => 'ISO 639-1 language code',
                'constraint' => 2,
            ],
            'native_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 128,
            ],
        ]);
        $this->forge->addPrimaryKey('code');
        $this->forge->createTable('languages');
    }

    public function down(): void
    {
        $this->forge->dropTable('languages');
    }
}
