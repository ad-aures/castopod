<?php

declare(strict_types=1);

/**
 * Class AddNotePreviewCards Creates activitypub_notes_preview_cards table in database
 *
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNotesPreviewCards extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'note_id' => [
                'type' => 'BINARY',
                'constraint' => 16,
            ],
            'preview_card_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
        ]);

        $this->forge->addPrimaryKey(['note_id', 'preview_card_id']);
        $this->forge->addForeignKey('note_id', 'activitypub_notes', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('preview_card_id', 'activitypub_preview_cards', 'id', '', 'CASCADE');
        $this->forge->createTable('activitypub_notes_preview_cards');
    }

    public function down(): void
    {
        $this->forge->dropTable('activitypub_notes_preview_cards');
    }
}
