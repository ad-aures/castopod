<?php

declare(strict_types=1);

/**
 * Class AddFavourites Creates activitypub_favourites table in database
 *
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFavourites extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'actor_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'note_id' => [
                'type' => 'BINARY',
                'constraint' => 16,
            ],
        ]);
        $this->forge->addField('`created_at` timestamp NOT NULL DEFAULT current_timestamp()');
        $this->forge->addPrimaryKey(['actor_id', 'note_id']);
        $this->forge->addForeignKey('actor_id', 'activitypub_actors', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('note_id', 'activitypub_notes', 'id', '', 'CASCADE');
        $this->forge->createTable('activitypub_favourites');
    }

    public function down(): void
    {
        $this->forge->dropTable('activitypub_favourites');
    }
}
