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

use App\Database\Migrations\BaseMigration;
use Override;

class AddActivities extends BaseMigration
{
    #[Override]
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

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('actor_id', 'fediverse_actors', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('target_actor_id', 'fediverse_actors', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('post_id', 'fediverse_posts', 'id', '', 'CASCADE');
        $this->forge->createTable('fediverse_activities');
    }

    #[Override]
    public function down(): void
    {
        $this->forge->dropTable('fediverse_activities');
    }
}
