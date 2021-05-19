<?php

/**
 * Class AddFollowers Creates activitypub_followers table in database
 *
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFollowers extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'actor_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'comment' => 'Actor that is following',
            ],
            'target_actor_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'comment' => 'Actor that is followed',
            ],
        ]);
        $this->forge->addField('`created_at` timestamp NOT NULL DEFAULT current_timestamp()',);
        $this->forge->addPrimaryKey(['actor_id', 'target_actor_id']);
        $this->forge->addForeignKey('actor_id', 'activitypub_actors', 'id', '', 'CASCADE',);
        $this->forge->addForeignKey('target_actor_id', 'activitypub_actors', 'id', '', 'CASCADE',);
        $this->forge->createTable('activitypub_follows');
    }

    public function down(): void
    {
        $this->forge->dropTable('activitypub_follows');
    }
}
