<?php

/**
 * Class AddPlatforms Creates platforms table in database
 *
 * @copyright  2020 Podlibre
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
                'default' => null,
            ],
        ]);
        $this->forge->addField('`created_at` timestamp NOT NULL DEFAULT NOW()');
        $this->forge->addField('`updated_at` timestamp NOT NULL DEFAULT NOW() ON UPDATE NOW()',);
        $this->forge->addPrimaryKey('slug');
        $this->forge->createTable('platforms');
    }

    public function down(): void
    {
        $this->forge->dropTable('platforms');
    }
}
