<?php

/**
 * Class AddCreditView
 * Creates Credit View in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCreditView extends Migration
{
    public function up()
    {
        // Creates View for credit UNION query
        $viewName = $this->db->prefixTable('credits');
        $personTable = $this->db->prefixTable('persons');
        $podcastPersonTable = $this->db->prefixTable('podcasts_persons');
        $episodePersonTable = $this->db->prefixTable('episodes_persons');
        $createQuery = <<<EOD
CREATE VIEW `$viewName` AS
    SELECT `person_group`, `person_id`, `full_name`, `person_role`, `podcast_id`, NULL AS `episode_id` FROM `$podcastPersonTable`
        INNER JOIN `$personTable`
            ON (`person_id`=`$personTable`.`id`)
    UNION
    SELECT `person_group`, `person_id`, `full_name`, `person_role`, `podcast_id`, `episode_id` FROM `$episodePersonTable`
        INNER JOIN `$personTable`
            ON (`person_id`=`$personTable`.`id`)
    ORDER BY `person_group`, `full_name`, `person_role`, `podcast_id`, `episode_id`;
EOD;
        $this->db->query($createQuery);
    }

    public function down()
    {
        $viewName = $this->db->prefixTable('credits');
        $this->db->query("DROP VIEW IF EXISTS `$viewName`");
    }
}
