<?php

declare(strict_types=1);

/**
 * Class AddCreatedByToPosts Adds created_by field to posts table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFullTextSearchIndexes extends Migration
{
    public function up(): void
    {
        $prefix = $this->db->getPrefix();

        $createQuery = <<<CODE_SAMPLE
            ALTER TABLE {$prefix}episodes
            ADD FULLTEXT episodes_search (title, description_markdown, slug, location_name);
        CODE_SAMPLE;

        $this->db->query($createQuery);

        $createQuery = <<<CODE_SAMPLE
            ALTER TABLE {$prefix}podcasts
            ADD FULLTEXT podcasts_search (title, description_markdown, handle);
        CODE_SAMPLE;

        $this->db->query($createQuery);
    }


    public function down()
    {
        $prefix = $this->db->getPrefix();

        $createQuery = <<<CODE_SAMPLE
            ALTER TABLE {$prefix}episodes
            DROP INDEX IF EXISTS  episodes_search;
        CODE_SAMPLE;

        $this->db->query($createQuery);

        $createQuery = <<<CODE_SAMPLE
            ALTER TABLE {$prefix}podcasts
            DROP INDEX IF EXISTS  podcasts_searcg;
        CODE_SAMPLE;

        $this->db->query($createQuery);


    }
}
