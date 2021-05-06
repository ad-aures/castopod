<?php

/**
 * Class Persons
 * Creates persons table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPersons extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'full_name' => [
                'type' => 'VARCHAR',
                'constraint' => 192,
                'comment' => 'This is the full name or alias of the person.',
            ],
            'unique_name' => [
                'type' => 'VARCHAR',
                'constraint' => 192,
                'comment' => 'This is the slug name or alias of the person.',
                'unique' => true,
            ],
            'information_url' => [
                'type' => 'VARCHAR',
                'constraint' => 512,
                'comment' =>
                    'The url to a relevant resource of information about the person, such as a homepage or third-party profile platform.',
                'null' => true,
            ],
            'image_path' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            // constraint is 13 because the longest safe mimetype for images is image/svg+xml,
            // see https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types#image_types
            'image_mimetype' => [
                'type' => 'VARCHAR',
                'constraint' => 13,
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
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('created_by', 'users', 'id');
        $this->forge->addForeignKey('updated_by', 'users', 'id');
        $this->forge->createTable('persons');
    }

    public function down(): void
    {
        $this->forge->dropTable('persons');
    }
}
