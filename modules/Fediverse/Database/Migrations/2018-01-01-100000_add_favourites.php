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

class AddFavourites extends BaseMigration
{
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

        $tablesPrefix = config('Fediverse')
            ->tablesPrefix;

        $this->forge->addField('`created_at` timestamp NOT NULL DEFAULT current_timestamp()');
        $this->forge->addPrimaryKey(['actor_id', 'post_id']);
        $this->forge->addForeignKey('actor_id', $tablesPrefix . 'actors', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('post_id', $tablesPrefix . 'posts', 'id', '', 'CASCADE');
        $this->forge->createTable($tablesPrefix . 'favourites');
    }

    public function down(): void
    {
        $this->forge->dropTable(config('Fediverse')->tablesPrefix . 'favourites');
    }
}
