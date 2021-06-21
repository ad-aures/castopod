<?php

declare(strict_types=1);

/**
 * Class AddEpisodes Creates episodes table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEpisodes extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'podcast_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'guid' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
            ],
            'audio_file_path' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'audio_file_duration' => [
                // exact value for duration with max 99999,999 ~ 27.7 hours
                'type' => 'DECIMAL(8,3)',
                'unsigned' => true,
                'comment' => 'Playtime in seconds',
            ],
            'audio_file_mimetype' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'audio_file_size' => [
                'type' => 'INT',
                'unsigned' => true,
                'comment' => 'File size in bytes',
            ],
            'audio_file_header_size' => [
                'type' => 'INT',
                'unsigned' => true,
                'comment' => 'Header size in bytes',
            ],
            'description_markdown' => [
                'type' => 'TEXT',
            ],
            'description_html' => [
                'type' => 'TEXT',
            ],
            'image_path' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            // constraint is 13 because the longest safe mimetype for images is image/svg+xml,
            // see https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types#image_types
            'image_mimetype' => [
                'type' => 'VARCHAR',
                'constraint' => 13,
                'null' => true,
            ],
            'transcript_file_path' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'transcript_file_remote_url' => [
                'type' => 'VARCHAR',
                'constraint' => 512,
                'null' => true,
            ],
            'chapters_file_path' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'chapters_file_remote_url' => [
                'type' => 'VARCHAR',
                'constraint' => 512,
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
                'unsigned' => true,
                'null' => true,
            ],
            'season_number' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['trailer', 'full', 'bonus'],
                'default' => 'full',
            ],
            'is_blocked' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'location_name' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => true,
            ],
            'location_geo' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
                'null' => true,
            ],
            'location_osm' => [
                'type' => 'VARCHAR',
                'constraint' => 12,
                'null' => true,
            ],
            'custom_rss' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'favourites_total' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 0,
            ],
            'reblogs_total' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 0,
            ],
            'statuses_total' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 0,
            ],
            'created_by' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'updated_by' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'published_at' => [
                'type' => 'DATETIME',
                'null' => true,
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
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey(['podcast_id', 'slug']);
        $this->forge->addForeignKey('podcast_id', 'podcasts', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('created_by', 'users', 'id');
        $this->forge->addForeignKey('updated_by', 'users', 'id');
        $this->forge->createTable('episodes');
    }

    public function down(): void
    {
        $this->forge->dropTable('episodes');
    }
}
