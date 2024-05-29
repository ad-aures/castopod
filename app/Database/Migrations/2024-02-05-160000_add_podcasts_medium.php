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

class AddPodcastsMediumField extends BaseMigration
{
    #[Override]
    public function up(): void
    {
        $fields = [
            'medium' => [
                'type'    => "ENUM('podcast','music','audiobook')",
                'null'    => false,
                'default' => 'podcast',
                'after'   => 'type',
            ],
        ];

        $this->forge->addColumn('podcasts', $fields);
    }

    #[Override]
    public function down(): void
    {
        $fields = ['medium'];
        $this->forge->dropColumn('podcasts', $fields);
    }
}
