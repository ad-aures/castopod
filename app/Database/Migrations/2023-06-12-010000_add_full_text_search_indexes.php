<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use Override;

class AddFullTextSearchIndexes extends BaseMigration
{
    #[Override]
    public function up(): void
    {
        $prefix = $this->db->getPrefix();

        $createQuery = <<<SQL
            ALTER TABLE {$prefix}episodes DROP INDEX title;
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

    #[Override]
    public function down(): void
    {
        $prefix = $this->db->getPrefix();

        $createQuery = <<<SQL
            ALTER TABLE {$prefix}episodes
            DROP INDEX  episodes_search;
        SQL;

        $this->db->query($createQuery);

        $createQuery = <<<SQL
            ALTER TABLE {$prefix}podcasts
            DROP INDEX  podcasts_search;
        SQL;

        $this->db->query($createQuery);
    }
}
