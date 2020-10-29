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
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
                'unique' => true,
            ],
            'description_markdown' => [
                'type' => 'TEXT',
            ],
            'description_html' => [
                'type' => 'TEXT',
            ],
            'image_uri' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'language_code' => [
                'type' => 'VARCHAR',
                'constraint' => 2,
            ],
            'category_id' => [
                'type' => 'INT',
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
                'constraint' => 128,
            ],
            'owner_email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'publisher' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => true,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['episodic', 'serial'],
                'default' => 'episodic',
            ],
            'copyright' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => true,
            ],
            'episode_description_footer_markdown' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'episode_description_footer_html' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'is_blocked' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'is_completed' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'is_locked' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
            ],
            'imported_feed_url' => [
                'type' => 'VARCHAR',
                'constraint' => 512,
                'comment' =>
                    'The RSS feed URL if this podcast was imported, NULL otherwise.',
                'null' => true,
            ],
            'new_feed_url' => [
                'type' => 'VARCHAR',
                'constraint' => 512,
                'comment' =>
                    'The RSS new feed URL if this podcast is moving out, NULL otherwise.',
                'null' => true,
            ],
            'created_by' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'updated_by' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('category_id', 'categories', 'id');
        $this->forge->addForeignKey('language_code', 'languages', 'code');
        $this->forge->addForeignKey('created_by', 'users', 'id');
        $this->forge->addForeignKey('updated_by', 'users', 'id');
        $this->forge->createTable('podcasts');
    }

    public function down()
    {
        $this->forge->dropTable('podcasts');
    }
}
