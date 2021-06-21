<?php

declare(strict_types=1);

/**
 * Class AddActivities Creates activitypub_activities table in database
 *
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddActivities extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BINARY',
                'constraint' => 16,
            ],
            'actor_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'target_actor_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'status_id' => [
                'type' => 'BINARY',
                'constraint' => 16,
                'null' => true,
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'payload' => [
                'type' => 'JSON',
            ],
            'task_status' => [
                'type' => 'ENUM',
                'constraint' => ['queued', 'delivered'],
                'null' => true,
                'default' => null,
            ],
            'scheduled_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('actor_id', 'activitypub_actors', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('target_actor_id', 'activitypub_actors', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('status_id', 'activitypub_statuses', 'id', '', 'CASCADE');
        $this->forge->createTable('activitypub_activities');
    }

    public function down(): void
    {
        $this->forge->dropTable('activitypub_activities');
    }
}
