<?php

declare(strict_types=1);

/**
 * Class AddEpisodeComments creates episode_comments table in database
 *
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

class AddEpisodeComments extends BaseMigration
{
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
            'episode_id' => [
                'type'     => 'INT',
                'unsigned' => true,
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
            'message' => [
                'type'       => 'VARCHAR',
                'constraint' => 5000,
            ],
            'message_html' => [
                'type'       => 'VARCHAR',
                'constraint' => 6000,
            ],
            'likes_count' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'replies_count' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'created_by' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
        ]);

        $fediverseTablesPrefix = config('Fediverse')
            ->tablesPrefix;

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('episode_id', 'episodes', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('actor_id', $fediverseTablesPrefix . 'actors', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('created_by', 'users', 'id');
        $this->forge->createTable('episode_comments');
    }

    public function down(): void
    {
        $this->forge->dropTable('episode_comments');
    }
}
