<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Database\Migrations;

use App\Database\Migrations\BaseMigration;
use Override;

class AddAnalyticsPodcastsBySubscription extends BaseMigration
{
    #[Override]
    public function up(): void
    {
        $this->forge->addField([
            'podcast_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'episode_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'subscription_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'date' => [
                'type' => 'DATE',
            ],
            'hits' => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 1,
            ],
        ]);

        $this->forge->addPrimaryKey(['podcast_id', 'episode_id', 'subscription_id', 'date']);
        // `created_at` and `updated_at` are created with SQL because Model class won’t be used for insertion (Procedure will be used instead)
        $this->forge->addField('`created_at` timestamp NOT NULL DEFAULT current_timestamp()');
        $this->forge->addField(
            '`updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()',
        );
        $this->forge->createTable('analytics_podcasts_by_subscription');
    }

    #[Override]
    public function down(): void
    {
        $this->forge->dropTable('analytics_podcasts_by_subscription');
    }
}
