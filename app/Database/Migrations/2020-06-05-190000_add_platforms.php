<?php

declare(strict_types=1);

/**
 * Class AddPlatforms Creates platforms table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPlatforms extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['podcasting', 'social', 'funding'],
            ],
            'label' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
            ],
            'home_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'submit_url' => [
                'type' => 'VARCHAR',
                'constraint' => 512,
                'null' => true,
            ],
        ]);
        $this->forge->addField('`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP()');
        $this->forge->addField(
            '`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()'
        );
        $this->forge->addPrimaryKey('slug');
        $this->forge->createTable('platforms');
    }

    public function down(): void
    {
        $this->forge->dropTable('platforms');
    }
}
