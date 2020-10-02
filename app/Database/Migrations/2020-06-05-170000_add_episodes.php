<?php

/**
 * Class AddEpisodes
 * Creates episodes table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEpisodes extends Migration
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
            'podcast_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'guid' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
            ],
            'enclosure_uri' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
            ],
            'enclosure_duration' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'comment' => 'Playtime in seconds',
            ],
            'enclosure_mimetype' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'enclosure_filesize' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'comment' => 'File size in bytes',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'image_uri' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'null' => true,
            ],
            'parental_advisory' => [
                'type' => 'ENUM',
                'constraint' => ['clean', 'explicit'],
                'null' => true,
                'default' => null,
            ],
            'number' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'null' => true,
            ],
            'season_number' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'null' => true,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['trailer', 'full', 'bonus'],
                'default' => 'full',
            ],
            'block' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
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
            'published_at' => [
                'type' => 'DATETIME',
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
        $this->forge->addUniqueKey(['podcast_id', 'slug']);
        $this->forge->addForeignKey('podcast_id', 'podcasts', 'id');
        $this->forge->addForeignKey('created_by', 'users', 'id');
        $this->forge->addForeignKey('updated_by', 'users', 'id');
        $this->forge->createTable('episodes');
    }

    public function down()
    {
        $this->forge->dropTable('episodes');
    }
}
