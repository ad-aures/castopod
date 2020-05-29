<?php

namespace App\Database\Migrations;

use \CodeIgniter\Database\Migration;

class AddCategories extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => TRUE,
            ],
            'parent_id'          => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => TRUE
            ],
            'apple_category'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '1024',
            ],
            'google_category' => [
                'type'           => 'VARCHAR',
                'constraint'           => '1024',
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('parent_id', 'categories', 'id');
        $this->forge->createTable('categories');
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}
