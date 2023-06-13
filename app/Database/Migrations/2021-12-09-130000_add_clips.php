<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

class AddClips extends BaseMigration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'podcast_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'episode_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'start_time' => [
                'type'     => 'DECIMAL(8,3)',
                'unsigned' => true,
            ],
            'duration' => [
                // clip duration cannot be higher than 9999,999 seconds ~ 2.77 hours
                'type'     => 'DECIMAL(7,3)',
                'unsigned' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 128,
            ],
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['audio', 'video'],
            ],
            'media_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'metadata' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['queued', 'pending', 'running', 'passed', 'failed'],
            ],
            'logs' => [
                'type' => 'TEXT',
            ],
            'created_by' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'updated_by' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'job_started_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'job_ended_at' => [
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

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('podcast_id', 'podcasts', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('episode_id', 'episodes', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('media_id', 'media', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('created_by', 'users', 'id');
        $this->forge->addForeignKey('updated_by', 'users', 'id');
        $this->forge->createTable('clips');
    }

    public function down(): void
    {
        $this->forge->dropTable('clips');
    }
}
