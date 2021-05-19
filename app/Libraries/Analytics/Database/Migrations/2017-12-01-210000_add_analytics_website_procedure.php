<?php

/**
 * Class AddAnalyticsWebsiteProcedure Creates analytics_website stored procedure in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAnalyticsWebsiteProcedure extends Migration
{
    public function up(): void
    {
        // Creates Procedure for data insertion
        // Example: CALL analytics_website(1,'FR','Firefox');
        $procedureName = $this->db->prefixTable('analytics_website');
        $createQuery = <<<CODE_SAMPLE
        CREATE PROCEDURE `{$procedureName}` (IN `p_podcast_id` INT UNSIGNED, IN `p_browser` VARCHAR(191) CHARSET utf8mb4, IN `p_entry_page` VARCHAR(512) CHARSET utf8mb4, IN `p_referer_url` VARCHAR(512) CHARSET utf8mb4, IN `p_domain` VARCHAR(128) CHARSET utf8mb4, IN `p_keywords` VARCHAR(384) CHARSET utf8mb4)  MODIFIES SQL DATA
        DETERMINISTIC
        SQL SECURITY INVOKER
        COMMENT 'Add one hit in website logs tables.'
        BEGIN

        SET @current_date = DATE(NOW());

        INSERT INTO {$procedureName}_by_browser(`podcast_id`, `browser`, `date`)
            VALUES (p_podcast_id, p_browser, @current_date)
            ON DUPLICATE KEY UPDATE `hits`=`hits`+1;
        INSERT INTO {$procedureName}_by_referer(`podcast_id`, `referer_url`, `domain`, `keywords`, `date`)
            VALUES (p_podcast_id, p_referer_url, p_domain, p_keywords, @current_date)
            ON DUPLICATE KEY UPDATE `hits`=`hits`+1;
        INSERT INTO {$procedureName}_by_entry_page(`podcast_id`, `entry_page_url`, `date`)
            VALUES (p_podcast_id, p_entry_page, @current_date)
            ON DUPLICATE KEY UPDATE `hits`=`hits`+1;
        END
        CODE_SAMPLE;
        $this->db->query($createQuery);
    }

    public function down(): void
    {
        $procedureName = $this->db->prefixTable('analytics_website');
        $this->db->query("DROP PROCEDURE IF EXISTS `{$procedureName}`");
    }
}
