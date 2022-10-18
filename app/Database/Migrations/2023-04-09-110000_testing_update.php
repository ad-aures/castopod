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

use CodeIgniter\Database\Migration;

class AddTestingUpdate extends Migration
{
    public function up(): void
    {
        $this->forge->addColumn('podcasts', [
            'cool_update' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
                'after' => 'custom_rss',
            ],
        ]);
    }

    public function down(): void
    {
        $this->forge->dropColumn('podcasts', 'cool_update');
    }
}
