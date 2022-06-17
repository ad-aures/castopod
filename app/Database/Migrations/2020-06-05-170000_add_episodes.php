<?php

declare(strict_types=1);

/**
 * Class AddEpisodes Creates episodes table in database
 *
 * @copyright  2020 Ad Aures
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
                'constraint' => 128,
            ],
            'audio_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'description_markdown' => [
                'type' => 'TEXT',
            ],
            'description_html' => [
                'type' => 'TEXT',
            ],
            'cover_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'transcript_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'transcript_remote_url' => [
                'type' => 'VARCHAR',
                'constraint' => 512,
                'null' => true,
            ],
            'chapters_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'chapters_remote_url' => [
                'type' => 'VARCHAR',
                'constraint' => 512,
                'null' => true,
            ],
            'parental_advisory' => [
                'type' => 'ENUM',
                'constraint' => ['clean', 'explicit'],
                'null' => true,
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
            'posts_count' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 0,
            ],
            'comments_count' => [
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
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey(['podcast_id', 'slug']);
        $this->forge->addForeignKey('podcast_id', 'podcasts', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('audio_id', 'media', 'id');
        $this->forge->addForeignKey('cover_id', 'media', 'id', '', 'SET NULL');
        $this->forge->addForeignKey('transcript_id', 'media', 'id', '', 'SET NULL');
        $this->forge->addForeignKey('chapters_id', 'media', 'id', '', 'SET NULL');
        $this->forge->addForeignKey('created_by', 'users', 'id');
        $this->forge->addForeignKey('updated_by', 'users', 'id');
        $this->forge->createTable('episodes');

        // Add Full-Text Search index on title and description_markdown
        $prefix = $this->db->getPrefix();
        $createQuery = <<<CODE_SAMPLE
            ALTER TABLE {$prefix}episodes
            ADD FULLTEXT(title, description_markdown);
        CODE_SAMPLE;
        $this->db->query($createQuery);
    }

    public function down(): void
    {
        $this->forge->dropTable('episodes');
    }
}
