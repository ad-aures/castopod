<?php

/**
 * Class AddPreviewCards
 * Creates activitypub_preview_cards table in database
 *
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPreviewCards extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'url' => [
                'type' => 'VARCHAR',
                'constraint' => 512,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'description' => ['type' => 'TEXT'],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['link', 'video', 'image', 'rich'],
                'default' => 'link',
            ],
            'author_name' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
                'null' => true,
            ],
            'author_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'provider_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'provider_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'html' => [
                'type' => 'TEXT',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('url');
        $this->forge->createTable('activitypub_preview_cards');
    }

    public function down(): void
    {
        $this->forge->dropTable('activitypub_preview_cards');
    }
}
