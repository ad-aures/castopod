<?php

declare(strict_types=1);

use Modules\Admin\Config\Admin;

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'label' => 'breadcrumb polja',
    config(Admin::class)
        ->gateway => 'Početna',
    'podcasts' => 'podkasti',
    'episodes' => 'epizode',
    'subscriptions' => 'pretplate',
    'contributors' => 'saradnici',
    'pages' => 'stranice',
    'settings' => 'podešavanja',
    'theme' => 'tema',
    'about' => 'osnovni podaci',
    'add' => 'dodaj',
    'new' => 'nov',
    'edit' => 'izmeni',
    'persons' => 'osobe',
    'publish' => 'objavi',
    'publish-edit' => 'uredi objavu',
    'publish-date-edit' => 'uredi datum objave',
    'unpublish' => 'ukolni objavu',
    'delete' => 'obriši',
    'remove' => 'ukloni',
    'fediverse' => 'fediverse',
    'blocked-actors' => 'blokirani nalozi',
    'blocked-domains' => 'blokirani domeni',
    'users' => 'korisnici',
    'my-account' => 'moj nalog',
    'change-password' => 'promenite lozinku',
    'imports' => 'uvozi',
    'sync-feeds' => 'sinhronizuj snabdevače',
    'platforms' => 'platforme',
    'social' => 'društvene mreže',
    'funding' => 'finansiranje',
    'monetization-other' => 'druga monetizacija',
    'analytics' => 'analitika',
    'locations' => 'lokacije',
    'webpages' => 'veb strane',
    'unique-listeners' => 'jedinstveni slušaoci',
    'players' => 'plejeri',
    'listening-time' => 'ukupno vreme slušanja',
    'time-periods' => 'vremenski periodi',
    'soundbites' => 'zvučni isečci',
    'video-clips' => 'video isečci',
    'embed' => 'embedovan plejer',
    'notifications' => 'obaveštenja',
    'suspend' => 'obustavi',
];
