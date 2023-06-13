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

class AddCreatedByToPosts extends BaseMigration
{
    public function up(): void
    {
        $prefix = $this->db->getPrefix();
        $fediverseTablesPrefix = config('Fediverse')
            ->tablesPrefix;

        $this->forge->addColumn("{$fediverseTablesPrefix}posts", [
            'created_by' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
                'after'    => 'episode_id',
            ],
        ]);

        $alterQuery = <<<CODE_SAMPLE
            ALTER TABLE {$prefix}{$fediverseTablesPrefix}posts
            ADD FOREIGN KEY {$prefix}{$fediverseTablesPrefix}posts_created_by_foreign(created_by) REFERENCES {$prefix}users(id) ON DELETE CASCADE;
        CODE_SAMPLE;
        $this->db->query($alterQuery);
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
