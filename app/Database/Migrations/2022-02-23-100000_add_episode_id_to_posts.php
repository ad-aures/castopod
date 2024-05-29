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

use Override;

class AddEpisodeIdToPosts extends BaseMigration
{
    #[Override]
    public function up(): void
    {
        $prefix = $this->db->getPrefix();

        $this->forge->addColumn('fediverse_posts', [
            'episode_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
                'after'    => 'replies_count',
            ],
        ]);

        $this->forge->addForeignKey(
            'episode_id',
            'episodes',
            'id',
            '',
            'CASCADE',
            $prefix . 'fediverse_posts_episode_id_foreign'
        );
        $this->forge->processIndexes('fediverse_posts');
    }

    #[Override]
    public function down(): void
    {
        $prefix = $this->db->getPrefix();

        $this->forge->dropForeignKey('fediverse_posts', $prefix . 'fediverse_posts_episode_id_foreign');
        $this->forge->dropColumn('fediverse_posts', 'episode_id');
    }
}
