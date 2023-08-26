<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\WebSub\Database\Migrations;

use App\Database\Migrations\BaseMigration;

class AddIsPublishedOnHubsToEpisodes extends BaseMigration
{
    public function up(): void
    {
        $this->forge->addColumn('episodes', [
            'is_published_on_hubs' => [
                'type'    => 'BOOLEAN',
                'null'    => false,
                'default' => 0,
                'after'   => 'custom_rss',
            ],
        ]);
    }

    public function down(): void
    {
        $this->forge->dropColumn('episodes', 'is_published_on_hubs');
    }
}
