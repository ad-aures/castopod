<?php

declare(strict_types=1);

/**
 * Class AddPodcastsMediumField adds medium field to podcast table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use Override;

class DropDeprecatedEpisodesFields extends BaseMigration
{
    #[Override]
    public function up(): void
    {
        $this->forge->dropColumn('episodes', 'custom_rss');
    }

    #[Override]
    public function down(): void
    {
        $fields = [
            'custom_rss' => [
                'type' => 'JSON',
                'null' => true,
            ],
        ];

        $this->forge->addColumn('episodes', $fields);
    }
}
