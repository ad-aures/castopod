<?php

declare(strict_types=1);

/**
 * Class AddAnalyticsPodcasts Creates analytics_podcasts table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAnalyticsPodcasts extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'podcast_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'date' => [
                'type' => 'DATE',
            ],
            'duration' => [
                // a hit in analytics podcast increments this value when a podcast is listened to in a given date.
                // Here, the "cumulative listening time" on a podcast per day
                // cannot surpass 999,999,999,999.999 seconds (~277,777,777 hours) - should be enough.
                'type' => 'DECIMAL(15,3)',
                'unsigned' => true,
            ],
            'bandwidth' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'unique_listeners' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 1,
            ],
            'hits' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 1,
            ],
        ]);
        $this->forge->addPrimaryKey(['podcast_id', 'date']);
        $this->forge->addField('`created_at` timestamp NOT NULL DEFAULT current_timestamp()');
        $this->forge->addField(
            '`updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()',
        );
        $this->forge->createTable('analytics_podcasts');
    }

    public function down(): void
    {
        $this->forge->dropTable('analytics_podcasts');
    }
}
