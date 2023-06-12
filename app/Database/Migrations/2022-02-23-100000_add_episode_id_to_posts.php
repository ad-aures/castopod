<?php

declare(strict_types=1);

/**
 * Class AddEpisodeIdToPosts Adds episode_id field to posts table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEpisodeIdToPosts extends Migration
{
    public function up(): void
    {
        $prefix = $this->db->getPrefix();
        $fediverseTablesPrefix = config('Fediverse')
            ->tablesPrefix;

        $this->forge->addColumn("{$fediverseTablesPrefix}posts", [
            'episode_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
                'after'    => 'replies_count',
            ],
        ]);

        $alterQuery = <<<CODE_SAMPLE
            ALTER TABLE {$prefix}{$fediverseTablesPrefix}posts
            ADD FOREIGN KEY {$prefix}{$fediverseTablesPrefix}posts_episode_id_foreign(episode_id) REFERENCES {$prefix}episodes(id) ON DELETE CASCADE;
        CODE_SAMPLE;
        $this->db->query($alterQuery);
    }

    public function down(): void
    {
        $fediverseTablesPrefix = config('Fediverse')
            ->tablesPrefix;

        $this->forge->dropForeignKey(
            $fediverseTablesPrefix . 'posts',
            $fediverseTablesPrefix . 'posts_episode_id_foreign'
        );
        $this->forge->dropColumn($fediverseTablesPrefix . 'posts', 'episode_id');
    }
}
