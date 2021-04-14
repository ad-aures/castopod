<?php

/**
 * Class AddAnalyticsPodcastsByEpisode
 * Creates analytics_episodes_by_episode table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAnalyticsPodcastsByEpisode extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'podcast_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'date' => [
                'type' => 'DATE',
            ],
            'episode_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'age' => [
                'type' => 'INT',
                'comment' => 'Days since episode publication date',
                'unsigned' => true,
            ],
            'hits' => [
                'type' => 'INT',
                'unsigned' => true,
                'default' => 1,
            ],
        ]);
        $this->forge->addPrimaryKey(['podcast_id', 'date', 'episode_id']);
        $this->forge->addField(
            '`created_at` timestamp NOT NULL DEFAULT current_timestamp()',
        );
        $this->forge->addField(
            '`updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()',
        );
        $this->forge->createTable('analytics_podcasts_by_episode');
    }

    public function down()
    {
        $this->forge->dropTable('analytics_podcasts_by_episode');
    }
}
