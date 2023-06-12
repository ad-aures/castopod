<?php

declare(strict_types=1);

/**
 * Class AddActivities Creates activities table in database
 *
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddActivities extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'BINARY',
                'constraint' => 16,
            ],
            'actor_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'target_actor_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'post_id' => [
                'type'       => 'BINARY',
                'constraint' => 16,
                'null'       => true,
            ],
            'type' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'payload' => [
                'type' => 'JSON',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['queued', 'delivered'],
                'null'       => true,
            ],
            'scheduled_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $tablesPrefix = config('Fediverse')
            ->tablesPrefix;

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('actor_id', $tablesPrefix . 'actors', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('target_actor_id', $tablesPrefix . 'actors', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('post_id', $tablesPrefix . 'posts', 'id', '', 'CASCADE');
        $this->forge->createTable($tablesPrefix . 'activities');
    }

    public function down(): void
    {
        $this->forge->dropTable(config('Fediverse')->tablesPrefix . 'activities');
    }
}
