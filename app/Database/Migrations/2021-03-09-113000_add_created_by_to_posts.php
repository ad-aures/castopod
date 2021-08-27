<?php

declare(strict_types=1);

/**
 * Class AddCreatedByToPosts Adds created_by field to posts table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCreatedByToPosts extends Migration
{
    public function up(): void
    {
        $prefix = $this->db->getPrefix();
        $fediverseTablesPrefix = config('Fediverse')
            ->tablesPrefix;

        $createQuery = <<<CODE_SAMPLE
            ALTER TABLE {$prefix}{$fediverseTablesPrefix}posts
            ADD COLUMN `created_by` INT UNSIGNED AFTER `episode_id`,
            ADD FOREIGN KEY {$prefix}{$fediverseTablesPrefix}posts_created_by_foreign(created_by) REFERENCES {$prefix}users(id) ON DELETE CASCADE;
        CODE_SAMPLE;
        $this->db->query($createQuery);
    }

    public function down(): void
    {
        $fediverseTablesPrefix = config('Fediverse')
            ->tablesPrefix;

        $this->forge->dropForeignKey(
            $fediverseTablesPrefix . 'posts',
            $fediverseTablesPrefix . 'posts_created_by_foreign'
        );
        $this->forge->dropColumn($fediverseTablesPrefix . 'posts', 'created_by');
    }
}
