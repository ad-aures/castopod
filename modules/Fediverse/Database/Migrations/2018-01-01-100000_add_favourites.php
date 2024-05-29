<?php

declare(strict_types=1);

/**
 * Class AddFavourites Creates favourites table in database
 *
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Database\Migrations;

use App\Database\Migrations\BaseMigration;
use Override;

class AddFavourites extends BaseMigration
{
    #[Override]
    public function up(): void
    {
        $this->forge->addField([
            'actor_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'post_id' => [
                'type'       => 'BINARY',
                'constraint' => 16,
            ],
        ]);

        $this->forge->addField('`created_at` timestamp NOT NULL DEFAULT current_timestamp()');
        $this->forge->addPrimaryKey(['actor_id', 'post_id']);
        $this->forge->addForeignKey('actor_id', 'fediverse_actors', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('post_id', 'fediverse_posts', 'id', '', 'CASCADE');
        $this->forge->createTable('fediverse_favourites');
    }

    #[Override]
    public function down(): void
    {
        $this->forge->dropTable('fediverse_favourites');
    }
}
