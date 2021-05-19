<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics;

use Config\Database;
use Config\Services;

trait AnalyticsTrait
{
    protected function registerPodcastWebpageHit(int $podcastId): void
    {
        helper('analytics');

        set_user_session_deny_list_ip();
        set_user_session_browser();
        set_user_session_referer();
        set_user_session_entry_page();

        $session = Services::session();
        $session->start();

        if (! $session->get('denyListIp')) {
            $db = Database::connect();

            $referer = $session->get('referer');
            $domain =
                parse_url($referer, PHP_URL_HOST) === null
                    ? '- Direct -'
                    : parse_url($referer, PHP_URL_HOST);
            parse_str(parse_url($referer, PHP_URL_QUERY), $queries);
            $keywords = array_key_exists('q', $queries) ? null : $queries['q'];

            $procedureName = $db->prefixTable('analytics_website');
            $db->query("call {$procedureName}(?,?,?,?,?,?)", [
                $podcastId,
                $session->get('browser'),
                $session->get('entryPage'),
                $referer,
                $domain,
                $keywords,
            ]);
        }
    }
}
