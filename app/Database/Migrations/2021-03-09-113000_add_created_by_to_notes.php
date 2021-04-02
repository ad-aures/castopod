<?php

/**
 * Class AddCreatedByToNotes
 * Adds created_by field to activitypub_notes table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCreatedByToNotes extends Migration
{
    public function up()
    {
        $prefix = $this->db->getPrefix();

        $createQuery = <<<SQL
            ALTER TABLE ${prefix}activitypub_notes
            ADD COLUMN `created_by` INT UNSIGNED AFTER `episode_id`,
            ADD FOREIGN KEY ${prefix}activitypub_notes_created_by_foreign(created_by) REFERENCES ${prefix}users(id) ON DELETE CASCADE;
        SQL;
        $this->db->query($createQuery);
    }

    public function down()
    {
        $this->forge->dropForeignKey(
            'activitypub_notes',
            'activitypub_notes_created_by_foreign',
        );
        $this->forge->dropColumn('activitypub_notes', 'created_by');
    }
}
