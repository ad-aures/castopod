<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\WebSub\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsPublishedOnHubsToEpisodes extends Migration
{
    public function up(): void
    {
        $prefix = $this->db->getPrefix();

        $createQuery = <<<CODE_SAMPLE
            ALTER TABLE {$prefix}episodes
            ADD COLUMN `is_published_on_hubs` BOOLEAN NOT NULL DEFAULT 0 AFTER `custom_rss`;
        CODE_SAMPLE;

        $this->db->query($createQuery);
    }

    public function down(): void
    {
        $this->forge->dropColumn('episodes', 'is_published_on_hubs');
    }
}
