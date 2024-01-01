<?php

declare(strict_types=1);

/**
 * Class AddPodcastsOwnerEmailRemovedFromFeed adds is_owner_email_removed_from_feed field to podcast table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

class AddPodcastsOwnerEmailRemovedFromFeed extends BaseMigration
{
    public function up(): void
    {
        $fields = [
            'is_owner_email_removed_from_feed' => [
                'type'    => 'BOOLEAN',
                'null'    => false,
                'default' => 0,
                'after'   => 'owner_email',
            ],
        ];

        $this->forge->addColumn('podcasts', $fields);
    }

    public function down(): void
    {
        $fields = ['is_owner_email_removed_from_feed'];
        $this->forge->dropColumn('podcasts', $fields);
    }
}
