<?php

declare(strict_types=1);

/**
 * Class AddPosts Creates posts table in database
 *
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Database\Migrations;

use App\Database\Migrations\BaseMigration;
use Override;

class AddPosts extends BaseMigration
{
    #[Override]
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'BINARY',
                'constraint' => 16,
            ],
            'uri' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'actor_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'in_reply_to_id' => [
                'type'       => 'BINARY',
                'constraint' => 16,
                'null'       => true,
            ],
            'reblog_of_id' => [
                'type'       => 'BINARY',
                'constraint' => 16,
                'null'       => true,
            ],
            'message' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
            ],
            'message_html' => [
                'type'       => 'VARCHAR',
                'constraint' => 600,
                'null'       => true,
            ],
            'favourites_count' => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 0,
            ],
            'reblogs_count' => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 0,
            ],
            'replies_count' => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 0,
            ],
            'published_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('uri');
        // FIXME: an actor must reblog a post only once
        // $this->forge->addUniqueKey(['actor_id', 'reblog_of_id']);
        $this->forge->addForeignKey('actor_id', 'fediverse_actors', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('in_reply_to_id', 'fediverse_posts', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('reblog_of_id', 'fediverse_posts', 'id', '', 'CASCADE');
        $this->forge->createTable('fediverse_posts');
    }

    #[Override]
    public function down(): void
    {
        $this->forge->dropTable('fediverse_posts');
    }
}
