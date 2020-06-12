<?php
/**
 * Class AddAnalyticsUnknownUseragents
 * Creates analytics_unknown_useragents table in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAnalyticsUnknownUseragents extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
                'comment' => 'The line ID',
            ],
            'useragent' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'unique' => true,
                'comment' => 'The unknown user-agent.',
            ],
            'hits' => [
                'type' => 'INT',
                'constraint' => 10,
                'default' => 1,
                'comment' => 'Number of hits.',
            ],
        ]);
        $this->forge->addKey('id', true);
        // `created_at` and `updated_at` are created with SQL because Model class won’t be used for insertion (Stored Procedure will be used instead)
        $this->forge->addField(
            '`created_at` timestamp NOT NULL DEFAULT current_timestamp()'
        );
        $this->forge->addField(
            '`updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()'
        );
        $this->forge->createTable('analytics_unknown_useragents');
    }

    public function down()
    {
        $this->forge->dropTable('analytics_unknown_useragents');
    }
}
