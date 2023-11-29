<?php

declare(strict_types=1);

use Modules\Admin\Config\Admin;

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'label' => 'okruszki',
    config(Admin::class)
        ->gateway => 'Początek',
    'podcasts' => 'podcasty',
    'episodes' => 'odcinki',
    'subscriptions' => 'subskrypcja',
    'contributors' => 'kontrybutorzy',
    'pages' => 'strony',
    'settings' => 'ustawienia',
    'theme' => 'motyw',
    'about' => 'informacje',
    'add' => 'dodaj',
    'new' => 'nowy',
    'edit' => 'edytuj',
    'persons' => 'osoby',
    'publish' => 'publikuj',
    'publish-edit' => 'edytuj publikację',
    'publish-date-edit' => 'edytuj datę publikacji',
    'unpublish' => 'cofnij publikację',
    'delete' => 'usuń',
    'remove' => 'usuń',
    'fediverse' => 'fediverse',
    'blocked-actors' => 'zablokowani aktorzy',
    'blocked-domains' => 'zablokowane domeny',
    'users' => 'użytkownicy',
    'my-account' => 'moje konto',
    'change-password' => 'zmień hasło',
    'imports' => 'imports',
    'sync-feeds' => 'synchronize feeds',
    'platforms' => 'platformy',
    'social' => 'sieci społecznościowe',
    'funding' => 'finansowanie',
    'monetization-other' => 'other monetization',
    'analytics' => 'analityka',
    'locations' => 'lokalizacje',
    'webpages' => 'strony internetowe',
    'unique-listeners' => 'unikalni słuchacze',
    'players' => 'odtwarzacze',
    'listening-time' => 'czas odsłuchu',
    'time-periods' => 'okresy czasu',
    'soundbites' => 'zajawki',
    'video-clips' => 'klipy wideo',
    'embed' => 'odtwarzacz do osadzenia',
    'notifications' => 'powiadomienia',
    'suspend' => 'wstrzymaj',
];
