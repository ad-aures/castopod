<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use Override;

class RefactorPlatforms extends Migration
{
    #[Override]
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
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['podcasting', 'social', 'funding'],
                'after'      => 'podcast_id',
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
            ],
            'link_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 512,
            ],
            'account_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 128,
                'null'       => true,
            ],
            'is_visible' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('podcast_id', 'podcasts', 'id', '', 'CASCADE', 'platforms_podcast_id_foreign');
        $this->forge->addUniqueKey(['podcast_id', 'type', 'slug']);
        $this->forge->createTable('platforms_temp');

        $platformsData = $this->db->table('podcasts_platforms')
            ->select('podcasts_platforms.*, type')
            ->join('platforms', 'platforms.slug = podcasts_platforms.platform_slug')
            ->get()
            ->getResultArray();

        $data = [];
        foreach ($platformsData as $platformData) {
            $data[] = [
                'podcast_id' => $platformData['podcast_id'],
                'type'       => $platformData['type'],
                'slug'       => $platformData['platform_slug'],
                'link_url'   => $platformData['link_url'],
                'account_id' => $platformData['account_id'],
                'is_visible' => $platformData['is_visible'],
            ];
        }

        if ($data !== []) {
            $this->db->table('platforms_temp')
                ->insertBatch($data);
        }

        $this->forge->dropTable('platforms');

        $this->forge->dropTable('podcasts_platforms');

        $this->forge->renameTable('platforms_temp', 'platforms');
    }

    #[Override]
    public function down(): void
    {
        // delete platforms
        $this->forge->dropTable('platforms');

        // recreate platforms and podcasts_platforms tables
        $this->forge->addField([
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
            ],
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['podcasting', 'social', 'funding'],
            ],
            'label' => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
            ],
            'home_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'submit_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 512,
                'null'       => true,
            ],
        ]);
        $this->forge->addField('`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP()');
        $this->forge->addField(
            '`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()',
        );
        $this->forge->addPrimaryKey('slug');
        $this->forge->createTable('platforms');

        $this->forge->addField([
            'podcast_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'platform_slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
            ],
            'link_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 512,
            ],
            'account_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 128,
                'null'       => true,
            ],
            'is_visible' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'is_on_embed' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
        ]);

        $this->forge->addPrimaryKey(['podcast_id', 'platform_slug']);
        $this->forge->addForeignKey('podcast_id', 'podcasts', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('platform_slug', 'platforms', 'slug', 'CASCADE');
        $this->forge->createTable('podcasts_platforms');
    }
}
