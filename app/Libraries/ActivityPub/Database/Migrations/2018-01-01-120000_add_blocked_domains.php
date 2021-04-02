<?php

/**
 * Class AddBlockedDomains
 * Creates activitypub_blocked_domains table in database
 *
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBlockedDomains extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addPrimaryKey('name');
        $this->forge->createTable('activitypub_blocked_domains');
    }

    public function down()
    {
        $this->forge->dropTable('activitypub_blocked_domains');
    }
}
