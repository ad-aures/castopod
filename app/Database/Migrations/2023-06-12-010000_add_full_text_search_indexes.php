<?php

declare(strict_types=1);

namespace App\Database\Migrations;

class AddFullTextSearchIndexes extends BaseMigration
{
    public function up(): void
    {
        $prefix = $this->db->getPrefix();

        $createQuery = <<<CODE_SAMPLE
            ALTER TABLE {$prefix}episodes DROP INDEX IF EXISTS title;
        CODE_SAMPLE;

        $this->db->query($createQuery);

        $createQuery = <<<CODE_SAMPLE
            ALTER TABLE {$prefix}episodes
            ADD FULLTEXT episodes_search (title, description_markdown, slug, location_name);
        CODE_SAMPLE;

        $this->db->query($createQuery);

        $createQuery = <<<CODE_SAMPLE
            ALTER TABLE {$prefix}podcasts
            ADD FULLTEXT podcasts_search (title, description_markdown, handle, location_name);
        CODE_SAMPLE;

        $this->db->query($createQuery);
    }

    public function down(): void
    {
        $prefix = $this->db->getPrefix();

        $createQuery = <<<CODE_SAMPLE
            ALTER TABLE {$prefix}episodes
            DROP INDEX IF EXISTS  episodes_search;
        CODE_SAMPLE;

        $this->db->query($createQuery);

        $createQuery = <<<CODE_SAMPLE
            ALTER TABLE {$prefix}podcasts
            DROP INDEX IF EXISTS  podcasts_search;
        CODE_SAMPLE;

        $this->db->query($createQuery);
    }
}
