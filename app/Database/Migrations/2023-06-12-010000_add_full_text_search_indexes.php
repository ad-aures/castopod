<?php

declare(strict_types=1);

namespace App\Database\Migrations;

class AddFullTextSearchIndexes extends BaseMigration
{
    public function up(): void
    {
        $prefix = $this->db->getPrefix();

        $createQuery = <<<SQL
            ALTER TABLE {$prefix}episodes DROP INDEX IF EXISTS title;
        SQL;

        $this->db->query($createQuery);

        $createQuery = <<<SQL
            ALTER TABLE {$prefix}episodes
            ADD FULLTEXT episodes_search (title, description_markdown, slug, location_name);
        SQL;

        $this->db->query($createQuery);

        $createQuery = <<<SQL
            ALTER TABLE {$prefix}podcasts
            ADD FULLTEXT podcasts_search (title, description_markdown, handle, location_name);
        SQL;

        $this->db->query($createQuery);
    }

    public function down(): void
    {
        $prefix = $this->db->getPrefix();

        $createQuery = <<<SQL
            ALTER TABLE {$prefix}episodes
            DROP INDEX IF EXISTS  episodes_search;
        SQL;

        $this->db->query($createQuery);

        $createQuery = <<<SQL
            ALTER TABLE {$prefix}podcasts
            DROP INDEX IF EXISTS  podcasts_search;
        SQL;

        $this->db->query($createQuery);
    }
}
