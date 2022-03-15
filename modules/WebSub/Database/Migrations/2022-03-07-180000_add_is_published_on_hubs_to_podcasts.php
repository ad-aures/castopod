<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\WebSub\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsPublishedOnHubsToPodcasts extends Migration
{
    public function up(): void
    {
        $prefix = $this->db->getPrefix();

        $createQuery = <<<CODE_SAMPLE
            ALTER TABLE {$prefix}podcasts
            ADD COLUMN `is_published_on_hubs` BOOLEAN NOT NULL DEFAULT 0 AFTER `custom_rss`;
        CODE_SAMPLE;

        $this->db->query($createQuery);
    }

    public function down(): void
    {
        $prefix = $this->db->getPrefix();

        $this->forge->dropColumn($prefix . 'podcasts', 'is_published_on_hubs');
    }
}
