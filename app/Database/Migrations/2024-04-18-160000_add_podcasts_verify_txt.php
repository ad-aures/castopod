<?php

declare(strict_types=1);

/**
 * Class AddPodcastsVerifyTxtField adds 1 field to podcast table in database to support podcast:txt tag
 *
 * @copyright  2024 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

class AddPodcastsVerifyTxtField extends BaseMigration
{
    public function up(): void
    {
        $fields = [
            'verify_txt' => [
                'type'  => 'TEXT',
                'null'  => true,
                'after' => 'location_osm',
            ],
        ];

        $this->forge->addColumn('podcasts', $fields);
    }

    public function down(): void
    {
        $this->forge->dropColumn('podcasts', 'verify_txt');
    }
}
