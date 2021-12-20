<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMedia extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'file_path' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'file_size' => [
                'type' => 'INT',
                'unsigned' => true,
                'comment' => 'File size in bytes',
            ],
            'file_mimetype' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'file_metadata' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['image', 'audio', 'video', 'transcript', 'chapters', 'document'],
                'default' => 'document',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'language_code' => [
                'type' => 'VARCHAR',
                'constraint' => 2,
            ],
            'uploaded_by' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'updated_by' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'uploaded_at' => [
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
        $this->forge->addUniqueKey('file_path');
        $this->forge->addForeignKey('uploaded_by', 'users', 'id');
        $this->forge->addForeignKey('updated_by', 'users', 'id');
        $this->forge->createTable('media');
    }

    public function down(): void
    {
        $this->forge->dropTable('media');
    }
}
