<?php

declare(strict_types=1);

/**
 * Class AddNotifications Creates notifications table in database
 *
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use Override;

class AddNotifications extends BaseMigration
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
            'actor_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'target_actor_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'post_id' => [
                'type'       => 'BINARY',
                'constraint' => 16,
                'null'       => true,
            ],
            'activity_id' => [
                'type'       => 'BINARY',
                'constraint' => 16,
            ],
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['like', 'follow', 'share', 'reply'],
            ],
            'read_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('actor_id', 'fediverse_actors', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('target_actor_id', 'fediverse_actors', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('post_id', 'fediverse_posts', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('activity_id', 'fediverse_activities', 'id', '', 'CASCADE');
        $this->forge->createTable('fediverse_notifications');
    }

    #[Override]
    public function down(): void
    {
        $this->forge->dropTable('fediverse_notifications');
    }
}
