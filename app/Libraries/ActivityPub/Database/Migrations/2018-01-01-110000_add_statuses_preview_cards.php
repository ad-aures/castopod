<?php

declare(strict_types=1);

/**
 * Class AddStatusesPreviewCards Creates activitypub_statuses_preview_cards table in database
 *
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusesPreviewCards extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'status_id' => [
                'type' => 'BINARY',
                'constraint' => 16,
            ],
            'preview_card_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
        ]);

        $this->forge->addPrimaryKey(['status_id', 'preview_card_id']);
        $this->forge->addForeignKey('status_id', 'activitypub_statuses', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('preview_card_id', 'activitypub_preview_cards', 'id', '', 'CASCADE');
        $this->forge->createTable('activitypub_statuses_preview_cards');
    }

    public function down(): void
    {
        $this->forge->dropTable('activitypub_statuses_preview_cards');
    }
}
