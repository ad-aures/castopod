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
        // Example: CALL analytics_podcasts(1, 2, 'FR', 'IDF', 48.853, 2.349, PodcastAddict, 'phone', 'android', 0, 1);
        $prefix = $this->db->getPrefix();

        $createQuery = <<<EOD
CREATE PROCEDURE `{$prefix}analytics_podcasts` (
    IN `p_podcast_id` BIGINT(20) UNSIGNED,
    IN `p_episode_id` BIGINT(20) UNSIGNED,
    IN `p_country_code` VARCHAR(3) CHARSET utf8mb4,
    IN `p_region_code` VARCHAR(3) CHARSET utf8mb4,
    IN `p_latitude` FLOAT,
    IN `p_longitude` FLOAT,
    IN `p_service` VARCHAR(128) CHARSET utf8mb4,
    IN `p_app` VARCHAR(128) CHARSET utf8mb4,
    IN `p_device` VARCHAR(32) CHARSET utf8mb4,
    IN `p_os` VARCHAR(32) CHARSET utf8mb4,
    IN `p_bot` TINYINT(1) UNSIGNED,
    IN `p_new_listener` TINYINT(1) UNSIGNED
    )  MODIFIES SQL DATA
DETERMINISTIC
SQL SECURITY INVOKER
COMMENT 'Add one hit in podcast logs tables.'
BEGIN
IF NOT `p_bot` THEN
    INSERT INTO `{$prefix}analytics_podcasts`(`podcast_id`, `date`) 
        VALUES (p_podcast_id, DATE(NOW())) 
        ON DUPLICATE KEY UPDATE `hits`=`hits`+1, `unique_listeners`=`unique_listeners`+`p_new_listener`;
    INSERT INTO `{$prefix}analytics_podcasts_by_episode`(`podcast_id`, `episode_id`, `date`, `age`) 
    SELECT p_podcast_id, p_episode_id, DATE(NOW()), datediff(now(),`published_at`) FROM `{$prefix}episodes` WHERE `id`= p_episode_id
        ON DUPLICATE KEY UPDATE `hits`=`hits`+1;
    INSERT INTO `{$prefix}analytics_podcasts_by_country`(`podcast_id`, `country_code`, `date`) 
        VALUES (p_podcast_id, p_country_code, DATE(NOW())) 
        ON DUPLICATE KEY UPDATE `hits`=`hits`+1;
    INSERT INTO `{$prefix}analytics_podcasts_by_region`(`podcast_id`, `country_code`, `region_code`, `latitude`, `longitude`, `date`) 
        VALUES (p_podcast_id, p_country_code, p_region_code, p_latitude, p_longitude, DATE(NOW())) 
        ON DUPLICATE KEY UPDATE `hits`=`hits`+1;
END IF;
INSERT INTO `{$prefix}analytics_podcasts_by_player`(`podcast_id`, `service`, `app`, `device`, `os`, `bot`, `date`) 
    VALUES (p_podcast_id, p_service, p_app, p_device, p_os, p_bot, DATE(NOW())) 
    ON DUPLICATE KEY UPDATE `hits`=`hits`+1;
END
EOD;
        $this->db->query($createQuery);
    }

    public function down()
    {
        $prefix = $this->db->getPrefix();
        $this->db->query(
            "DROP PROCEDURE IF EXISTS `{$prefix}analytics_podcasts`"
        );
    }
}
