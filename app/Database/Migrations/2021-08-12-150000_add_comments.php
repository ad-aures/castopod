<?php

declare(strict_types=1);

/**
 * Class AddComments creates comments table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddComments extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BINARY',
                'constraint' => 16,
            ],
            'uri' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'episode_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'actor_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'in_reply_to_id' => [
                'type' => 'BINARY',
                'constraint' => 16,
                'null' => true,
            ],
            'message' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
            ],
            'message_html' => [
                'type' => 'VARCHAR',
                'constraint' => 600,
                'null' => true,
            ],
            'likes_count' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'dislikes_count' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'replies_count' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'created_by' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('episode_id', 'episodes', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('actor_id', 'activitypub_actors', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('created_by', 'users', 'id');
        $this->forge->createTable('comments');
    }

    public function down(): void
    {
        $this->forge->dropTable('comments');
    }
}
