<?php

declare(strict_types=1);

/**
 * Class AddActivitiesTriggerAfterInsert Creates activities trigger in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddActivitiesTriggerAfterInsert extends Migration
{
    public function up(): void
    {
        $activitiesTable = $this->db->prefixTable(config('Fediverse')->tablesPrefix . 'activities');
        $notificationsTable = $this->db->prefixTable('notifications');
        $createQuery = <<<CODE_SAMPLE
        CREATE TRIGGER `{$activitiesTable}_after_insert`
        AFTER INSERT ON `{$activitiesTable}`
        FOR EACH ROW
        BEGIN
        -- only create notification if new incoming activity with NULL status is created
        IF NEW.target_actor_id AND NEW.target_actor_id != NEW.actor_id AND NEW.status IS NULL THEN
            IF NEW.type = 'Follow' THEN
                INSERT INTO `{$notificationsTable}` (`actor_id`, `target_actor_id`, `activity_id`, `type`, `created_at`, `updated_at`)
                VALUES (NEW.actor_id, NEW.target_actor_id, NEW.id, 'follow', NEW.created_at, NEW.created_at);
            ELSEIF NEW.type = 'Undo_Follow' THEN
                DELETE FROM `{$notificationsTable}`
                WHERE `actor_id` = NEW.actor_id
                AND `target_actor_id` = NEW.target_actor_id
                AND `type` = 'follow';
            END IF;
        END IF;
        END
        CODE_SAMPLE;
        $this->db->query($createQuery);
    }

    public function down(): void
    {
        $activitiesTable = $this->db->prefixTable(config('Fediverse')->tablesPrefix . 'activities');
        $this->db->query("DROP TRIGGER IF EXISTS `{$activitiesTable}_after_insert`");
    }
}
