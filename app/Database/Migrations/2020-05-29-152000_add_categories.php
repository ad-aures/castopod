<?php

namespace App\Database\Migrations;

use \CodeIgniter\Database\Migration;

class AddCategories extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
            'parent_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
            'code' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
            ],
            'apple_category' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
            ],
            'google_category' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('parent_id', 'categories', 'id');
        $this->forge->createTable('categories');
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}
