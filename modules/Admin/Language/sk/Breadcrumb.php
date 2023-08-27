<?php

declare(strict_types=1);

use Modules\Admin\Config\Admin;

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'label' => 'omrvinky',
    config(Admin::class)
        ->gateway => 'Úvod',
    'podcasts' => 'podcasty',
    'episodes' => 'časti',
    'subscriptions' => 'odbery',
    'contributors' => 'prispievatelia',
    'pages' => 'stránky',
    'settings' => 'nastavenia',
    'theme' => 'vzhľad',
    'about' => 'informácie',
    'add' => 'pridať',
    'new' => 'pridať',
    'edit' => 'upraviť',
    'persons' => 'osobnosti',
    'publish' => 'zverejniť',
    'publish-edit' => 'upraviť zverejnené',
    'publish-date-edit' => 'upraviť dátum publikovania',
    'unpublish' => 'zrušiť zverejnenie',
    'delete' => 'vymazať',
    'remove' => 'odstrániť',
    'fediverse' => 'fediverse',
    'blocked-actors' => 'zablokovaní aktéri',
    'blocked-domains' => 'zablokované domény',
    'users' => 'používatelia',
    'my-account' => 'môj účet',
    'change-password' => 'zmeniť heslo',
    'imports' => 'imports',
    'platforms' => 'platformy',
    'social' => 'sociálne siete',
    'funding' => 'financovanie',
    'analytics' => 'analytika',
    'locations' => 'miesta',
    'webpages' => 'web stránky',
    'unique-listeners' => 'unikátni poslucháči',
    'players' => 'prehrávače',
    'listening-time' => 'čas počúvania',
    'time-periods' => 'časové obdobia',
    'soundbites' => 'zvukové ukážky',
    'video-clips' => 'video klipy',
    'embed' => 'vnorený',
    'notifications' => 'oboznámenia',
    'suspend' => 'pozastaviť',
];
