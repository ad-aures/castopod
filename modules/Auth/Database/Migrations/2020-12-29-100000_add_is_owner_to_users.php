<?php

declare(strict_types=1);

namespace App\Database\Migrations;

class AddIsOwnerToUsers extends BaseMigration
{
    public function up(): void
    {
        $fields = [
            'is_owner' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'null'       => false,
            ],
        ];

        $this->forge->addColumn('users', $fields);
    }

    public function down(): void
    {
        $fields = ['is_owner'];
        $this->forge->dropColumn('users', $fields);
    }
}
