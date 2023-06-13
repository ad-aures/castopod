<?php

declare(strict_types=1);

/**
 * Class AddAnalyticsUnknownUseragents Creates analytics_unknown_useragents table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Database\Migrations;

use App\Database\Migrations\BaseMigration;

class AddAnalyticsUnknownUseragents extends BaseMigration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'useragent' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'unique'     => true,
            ],
            'hits' => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 1,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        // `created_at` and `updated_at` are created with SQL because Model class won’t be used for insertion (Procedure will be used instead)
        $this->forge->addField('`created_at` timestamp NOT NULL DEFAULT current_timestamp()');
        $this->forge->addField(
            '`updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()',
        );
        $this->forge->createTable('analytics_unknown_useragents');
    }

    public function down(): void
    {
        $this->forge->dropTable('analytics_unknown_useragents');
    }
}
