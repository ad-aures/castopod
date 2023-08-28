<?php

declare(strict_types=1);

namespace App\Database\Migrations;

class AddEpisodePreviewId extends BaseMigration
{
    public function up(): void
    {
        $fields = [
            'preview_id' => [
                'type'       => 'BINARY',
                'constraint' => 16,
                'after'      => 'podcast_id',
            ],
        ];

        $this->forge->addColumn('episodes', $fields);

        // set preview_id as unique key
        $prefix = $this->db->getPrefix();
        $uniquePreviewId = <<<CODE_SAMPLE
            ALTER TABLE `{$prefix}episodes`
            ADD CONSTRAINT `preview_id` UNIQUE (`preview_id`);
        CODE_SAMPLE;

        $this->db->query($uniquePreviewId);
    }

    public function down(): void
    {
        $fields = ['preview_id'];
        $this->forge->dropColumn('episodes', $fields);
    }
}
