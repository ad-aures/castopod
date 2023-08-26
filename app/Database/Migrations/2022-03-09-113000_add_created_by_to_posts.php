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

        $this->forge->addColumn('fediverse_posts', [
            'created_by' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
                'after'    => 'episode_id',
            ],
        ]);

        $this->forge->addForeignKey(
            'created_by',
            'users',
            'id',
            '',
            'CASCADE',
            $prefix . 'fediverse_posts_created_by_foreign'
        );
        $this->forge->processIndexes('fediverse_posts');
    }

    public function down(): void
    {
        $prefix = $this->db->getPrefix();

        $this->forge->dropForeignKey('fediverse_posts', $prefix . 'fediverse_posts_created_by_foreign');
        $this->forge->dropColumn('fediverse_posts', 'created_by');
    }
}
