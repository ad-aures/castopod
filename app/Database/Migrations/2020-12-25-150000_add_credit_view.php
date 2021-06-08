<?php

declare(strict_types=1);

/**
 * Class AddCreditView Creates Credit View in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCreditView extends Migration
{
    public function up(): void
    {
        // Creates View for credit UNION query
        $viewName = $this->db->prefixTable('credits');
        $personsTable = $this->db->prefixTable('persons');
        $podcastPersonsTable = $this->db->prefixTable('podcasts_persons');
        $episodePersonsTable = $this->db->prefixTable('episodes_persons');
        $episodesTable = $this->db->prefixTable('episodes');
        $createQuery = <<<CODE_SAMPLE
        CREATE VIEW `{$viewName}` AS
            SELECT `person_group`, `person_id`, `full_name`, `person_role`, `podcast_id`, NULL AS `episode_id` FROM `{$podcastPersonsTable}`
                INNER JOIN `{$personsTable}`
                    ON (`person_id`=`{$personsTable}`.`id`)
            UNION
            SELECT `person_group`, `person_id`, `full_name`, `person_role`, {$episodePersonsTable}.`podcast_id`, `episode_id` FROM `{$episodePersonsTable}`
                INNER JOIN `{$personsTable}`
                    ON (`person_id`=`{$personsTable}`.`id`)
                INNER JOIN `{$episodesTable}`
                    ON (`episode_id`=`{$episodesTable}`.`id`)
            WHERE `{$episodesTable}`.published_at <= NOW()
            ORDER BY `person_group`, `full_name`, `person_role`, `podcast_id`, `episode_id`;
        CODE_SAMPLE;
        $this->db->query($createQuery);
    }

    public function down(): void
    {
        $viewName = $this->db->prefixTable('credits');
        $this->db->query("DROP VIEW IF EXISTS `{$viewName}`");
    }
}
