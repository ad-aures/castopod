<?php

/**
 * Class AddEpisodeIdToNotes
 * Adds episode_id field to activitypub_notes table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEpisodeIdToNotes extends Migration
{
    public function up()
    {
        $prefix = $this->db->getPrefix();

        $createQuery = <<<SQL
            ALTER TABLE ${prefix}activitypub_notes
            ADD COLUMN `episode_id` INT UNSIGNED NULL AFTER `replies_count`,
            ADD FOREIGN KEY ${prefix}activitypub_notes_episode_id_foreign(episode_id) REFERENCES ${prefix}episodes(id) ON DELETE CASCADE;
        SQL;
        $this->db->query($createQuery);
    }

    public function down()
    {
        $this->forge->dropForeignKey(
            'activitypub_notes',
            'activitypub_notes_episode_id_foreign',
        );
        $this->forge->dropColumn('activitypub_notes', 'episode_id');
    }
}
