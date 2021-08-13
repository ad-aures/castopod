<?php

declare(strict_types=1);

/**
 * Class AddEpisodeIdToPosts Adds episode_id field to activitypub_posts table in database
 *
 * @copyright  2020 Podlibre
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

        $createQuery = <<<CODE_SAMPLE
            ALTER TABLE {$prefix}activitypub_posts
            ADD COLUMN `episode_id` INT UNSIGNED NULL AFTER `replies_count`,
            ADD FOREIGN KEY {$prefix}activitypub_posts_episode_id_foreign(episode_id) REFERENCES {$prefix}episodes(id) ON DELETE CASCADE;
        CODE_SAMPLE;
        $this->db->query($createQuery);
    }

    public function down(): void
    {
        $this->forge->dropForeignKey('activitypub_posts', 'activitypub_posts_episode_id_foreign');
        $this->forge->dropColumn('activitypub_posts', 'episode_id');
    }
}
