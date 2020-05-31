<?php

namespace App\Database\Migrations;

use \CodeIgniter\Database\Migration;

class AddLanguages extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'code' => [
                'type' => 'VARCHAR',
                'constraint' => 2,
            ],
        ]);
        $this->forge->addKey('code', true);
        $this->forge->createTable('languages');
    }

    public function down()
    {
        $this->forge->dropTable('languages');
    }
}
