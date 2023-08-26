<?php

declare(strict_types=1);

/**
 * Class AddPostsPreviewCards Creates posts_preview_cards table in database
 *
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Database\Migrations;

use App\Database\Migrations\BaseMigration;

class AddPostsPreviewCards extends BaseMigration
{
    public function up(): void
    {
        $this->forge->addField([
            'post_id' => [
                'type'       => 'BINARY',
                'constraint' => 16,
            ],
            'preview_card_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
        ]);

        $this->forge->addPrimaryKey(['post_id', 'preview_card_id']);
        $this->forge->addForeignKey('post_id', 'fediverse_posts', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('preview_card_id', 'fediverse_preview_cards', 'id', '', 'CASCADE');
        $this->forge->createTable('fediverse_posts_preview_cards');
    }

    public function down(): void
    {
        $this->forge->dropTable('fediverse_posts_preview_cards');
    }
}
