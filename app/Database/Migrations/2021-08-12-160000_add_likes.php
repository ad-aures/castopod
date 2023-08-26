<?php

declare(strict_types=1);

/**
 * Class AddLikes Creates likes table in database
 *
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

class AddLikes extends BaseMigration
{
    public function up(): void
    {
        $this->forge->addField([
            'actor_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'comment_id' => [
                'type'       => 'BINARY',
                'constraint' => 16,
            ],
        ]);

        $this->forge->addField('`created_at` timestamp NOT NULL DEFAULT current_timestamp()');
        $this->forge->addPrimaryKey(['actor_id', 'comment_id']);
        $this->forge->addForeignKey('actor_id', 'fediverse_actors', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('comment_id', 'episode_comments', 'id', '', 'CASCADE');
        $this->forge->createTable('likes');
    }

    public function down(): void
    {
        $this->forge->dropTable('likes');
    }
}
