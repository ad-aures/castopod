<?php

declare(strict_types=1);

/**
 * Class Persons Creates persons table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use Override;

class AddPersons extends BaseMigration
{
    #[Override]
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'full_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 192,
                'comment'    => 'This is the full name or alias of the person.',
            ],
            'unique_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 192,
                'comment'    => 'This is the slug name or alias of the person.',
                'unique'     => true,
            ],
            'information_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 512,
                'comment'    => 'The url to a relevant resource of information about the person, such as a homepage or third-party profile platform.',
                'null'       => true,
            ],
            'avatar_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'created_by' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'updated_by' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('avatar_id', 'media', 'id', '', 'SET NULL');
        $this->forge->addForeignKey('created_by', 'users', 'id');
        $this->forge->addForeignKey('updated_by', 'users', 'id');
        $this->forge->createTable('persons');
    }

    #[Override]
    public function down(): void
    {
        $this->forge->dropTable('persons');
    }
}
