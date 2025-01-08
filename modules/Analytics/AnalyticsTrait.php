<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics;

trait AnalyticsTrait
{
    protected function registerPodcastWebpageHit(int $podcastId): void
    {
        helper('analytics');

        set_user_session_deny_list_ip();
        set_user_session_browser();
        set_user_session_referer();
        set_user_session_entry_page();

        $session = service('session');

        if (! $session->get('denyListIp')) {
            $db = db_connect();

            $referer = $session->get('referer');
            $domain =
                parse_url((string) $referer, PHP_URL_HOST) ?? '- Direct -';
            parse_str((string) parse_url((string) $referer, PHP_URL_QUERY), $queries);
            $keywords = $queries['q'] ?? null;

            $procedureName = $db->prefixTable('analytics_website');
            $db->query("call {$procedureName}(?,?,?,?,?,?)", [
                $podcastId,
                $session->get('browser') ?? '',
                $session->get('entryPage'),
                $referer,
                $domain,
                $keywords,
            ]);
        }
    }
}
