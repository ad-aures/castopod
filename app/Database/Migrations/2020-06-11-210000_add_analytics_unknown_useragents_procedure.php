<?php

/**
 * Class AddAnalyticsUnknownUseragentsProcedure
 * Creates analytics_unknown_useragents procedure in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAnalyticsUnknownUseragentsProcedure extends Migration
{
    public function up()
    {
        // Creates Procedure for data insertion
        // Example: CALL analytics_unknown_useragents('Podcasts/1430.46 CFNetwork/1125.2 Darwin/19.4.0');
        $procedureName = $this->db->prefixTable('analytics_unknown_useragents');
        $createQuery = <<<EOD
        CREATE PROCEDURE `$procedureName` (IN `p_useragent` VARCHAR(191) CHARSET utf8mb4)  MODIFIES SQL DATA
        DETERMINISTIC
        SQL SECURITY INVOKER
        COMMENT 'Add an unknown useragent to table $procedureName.'
        INSERT INTO `$procedureName`(`useragent`)
        VALUES (p_useragent)
        ON DUPLICATE KEY UPDATE `hits`=`hits`+1
        EOD;
        $this->db->query($createQuery);
    }

    public function down()
    {
        $procedureName = $this->db->prefixTable('analytics_unknown_useragents');
        $this->db->query("DROP PROCEDURE IF EXISTS `$procedureName`");
    }
}
