<?php

declare(strict_types=1);

/**
 * Class AddAnalyticsWebsiteByEntryPage Creates analytics_website_by_entry_page table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Database\Migrations;

use App\Database\Migrations\BaseMigration;
use Override;

class AddAnalyticsWebsiteByEntryPage extends BaseMigration
{
    #[Override]
    public function up(): void
    {
        $this->forge->addField([
            'podcast_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'date' => [
                'type' => 'DATE',
            ],
            'entry_page_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 512,
            ],
            'hits' => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 1,
            ],
        ]);
        $this->forge->addPrimaryKey(['podcast_id', 'date', 'entry_page_url']);
        $this->forge->addField('`created_at` timestamp NOT NULL DEFAULT current_timestamp()');
        $this->forge->addField(
            '`updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()',
        );
        $this->forge->createTable('analytics_website_by_entry_page');
    }

    #[Override]
    public function down(): void
    {
        $this->forge->dropTable('analytics_website_by_entry_page');
    }
}
