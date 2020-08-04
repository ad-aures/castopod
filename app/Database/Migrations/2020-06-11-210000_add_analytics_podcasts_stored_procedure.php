<?php

/**
 * Class AddAnalyticsPodcastsStoredProcedure
 * Creates analytics_podcasts stored procedure in database
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAnalyticsPodcastsStoredProcedure extends Migration
{
    public function up()
    {
        // Creates Stored Procedure for data insertion
        // Example: CALL analytics_podcasts(1,2,'FR','phone/android/Deezer');
        $procedureName = $this->db->prefixTable('analytics_podcasts');
        $episodesTableName = $this->db->prefixTable('analytics_episodes');
        $createQuery = <<<EOD
CREATE PROCEDURE `$procedureName` (IN `p_podcast_id` BIGINT(20) UNSIGNED, IN `p_episode_id` BIGINT(20) UNSIGNED, IN `p_country_code` VARCHAR(3) CHARSET utf8mb4, IN `p_player` VARCHAR(191) CHARSET utf8mb4)  MODIFIES SQL DATA
DETERMINISTIC
SQL SECURITY INVOKER
COMMENT 'Add one hit in podcast logs tables.'
BEGIN
INSERT INTO `{$procedureName}_by_country`(`podcast_id`, `country_code`, `date`) 
VALUES (p_podcast_id, p_country_code, DATE(NOW())) 
ON DUPLICATE KEY UPDATE `hits`=`hits`+1;
INSERT INTO `{$procedureName}_by_player`(`podcast_id`, `player`, `date`) 
VALUES (p_podcast_id, p_player, DATE(NOW())) 
ON DUPLICATE KEY UPDATE `hits`=`hits`+1;
INSERT INTO `{$episodesTableName}_by_country`(`podcast_id`, `episode_id`, `country_code`, `date`) 
VALUES (p_podcast_id, p_episode_id, p_country_code, DATE(NOW())) 
ON DUPLICATE KEY UPDATE `hits`=`hits`+1;
INSERT INTO `{$episodesTableName}_by_player`(`podcast_id`, `episode_id`,  `player`, `date`) 
VALUES (p_podcast_id, p_episode_id, p_player, DATE(NOW())) 
ON DUPLICATE KEY UPDATE `hits`=`hits`+1;
END
EOD;
        $this->db->query($createQuery);
    }

    public function down()
    {
        $procedureName = $this->db->prefixTable('analytics_podcasts');
        $this->db->query("DROP PROCEDURE IF EXISTS `$procedureName`");
    }
}
