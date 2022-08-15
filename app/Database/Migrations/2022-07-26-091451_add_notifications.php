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

use CodeIgniter\Database\Migration;

class AddNotifications extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'actor_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'target_actor_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'post_id' => [
                'type' => 'BINARY',
                'constraint' => 16,
                'null' => true,
            ],
            'activity_id' => [
                'type' => 'BINARY',
                'constraint' => 16,
            ],
            'type' => [
                'type' => 'ENUM',
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

        $tablesPrefix = config('Fediverse')
            ->tablesPrefix;

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('actor_id', $tablesPrefix . 'actors', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('target_actor_id', $tablesPrefix . 'actors', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('post_id', $tablesPrefix . 'posts', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('activity_id', $tablesPrefix . 'activities', 'id', '', 'CASCADE');
        $this->forge->createTable('notifications');
    }

    public function down(): void
    {
        $this->forge->dropTable('notifications');
    }
}
