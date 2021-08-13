<?php

declare(strict_types=1);

/**
 * Class AddActors Creates activitypub_actors table in database
 *
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddActors extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uri' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
            ],
            'domain' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'private_key' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'public_key' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'display_name' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'summary' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'avatar_image_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            // constraint is 13 because the longest safe mimetype for images is image/svg+xml,
            // see https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types#image_types
            'avatar_image_mimetype' => [
                'type' => 'VARCHAR',
                'constraint' => 13,
                'null' => true,
            ],
            'cover_image_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'cover_image_mimetype' => [
                'type' => 'VARCHAR',
                'constraint' => 13,
                'null' => true,
            ],
            'inbox_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'outbox_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'followers_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'followers_count' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 0,
            ],
            'posts_count' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 0,
            ],
            'is_blocked' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('uri');
        $this->forge->addUniqueKey(['username', 'domain']);
        $this->forge->createTable('activitypub_actors');
    }

    public function down(): void
    {
        $this->forge->dropTable('activitypub_actors');
    }
}
