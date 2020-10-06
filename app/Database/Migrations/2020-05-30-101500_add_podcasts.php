<?php

/**
 * Class AddPodcasts
 * Creates podcasts table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPodcasts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'unique' => true,
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'image_uri' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
            ],
            'language' => [
                'type' => 'VARCHAR',
                'constraint' => 2,
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'default' => 0,
            ],
            'parental_advisory' => [
                'type' => 'ENUM',
                'constraint' => ['clean', 'explicit'],
                'null' => true,
                'default' => null,
            ],
            'owner_name' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
            ],
            'owner_email' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
            ],
            'publisher' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'null' => true,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['episodic', 'serial'],
                'default' => 'episodic',
            ],
            'copyright' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'null' => true,
            ],
            'block' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'complete' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'episode_description_footer' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'updated_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'imported_feed_url' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'comment' =>
                    'The RSS feed URL if this podcast was imported, NULL otherwise.',
                'null' => true,
            ],
            'new_feed_url' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'comment' =>
                    'The RSS new feed URL if this podcast is moving out, NULL otherwise.',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('category_id', 'categories', 'id');
        $this->forge->addForeignKey('created_by', 'users', 'id');
        $this->forge->addForeignKey('updated_by', 'users', 'id');
        $this->forge->createTable('podcasts');
    }

    public function down()
    {
        $this->forge->dropTable('podcasts');
    }
}
