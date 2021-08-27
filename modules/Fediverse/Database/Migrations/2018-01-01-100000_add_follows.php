<?php

declare(strict_types=1);

/**
 * Class AddFollowers Creates followers table in database
 *
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Database\Migrations;

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

        $tablesPrefix = config('Fediverse')
            ->tablesPrefix;

        $this->forge->addField('`created_at` timestamp NOT NULL DEFAULT current_timestamp()');
        $this->forge->addPrimaryKey(['actor_id', 'target_actor_id']);
        $this->forge->addForeignKey('actor_id', $tablesPrefix . 'actors', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('target_actor_id', $tablesPrefix . 'actors', 'id', '', 'CASCADE');
        $this->forge->createTable($tablesPrefix . 'follows');
    }

    public function down(): void
    {
        $this->forge->dropTable(config('Fediverse')->tablesPrefix . 'follows');
    }
}
