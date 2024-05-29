<?php

declare(strict_types=1);

namespace Tests\Support\Database\Migrations;

use CodeIgniter\Database\Migration;
use Override;

class ExampleMigration extends Migration
{
    /**
     * @var string
     */
    protected $DBGroup = 'tests';

    #[Override]
    public function up(): void
    {
        $fields = [
            'name' => [
                'type'       => 'varchar',
                'constraint' => 31,
            ],
            'uid' => [
                'type'       => 'varchar',
                'constraint' => 31,
            ],
            'class' => [
                'type'       => 'varchar',
                'constraint' => 63,
            ],
            'icon' => [
                'type'       => 'varchar',
                'constraint' => 31,
            ],
            'summary' => [
                'type'       => 'varchar',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        ];

        $this->forge->addField('id');
        $this->forge->addField($fields);

        $this->forge->addKey('name');
        $this->forge->addKey('uid');
        $this->forge->addKey(['deleted_at', 'id']);
        $this->forge->addKey('created_at');

        $this->forge->createTable('factories');
    }

    #[Override]
    public function down(): void
    {
        $this->forge->dropTable('factories');
    }
}
