<?php

declare(strict_types=1);

use Modules\Admin\Config\Admin;

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'label' => 'kruimelpad',
    config(Admin::class)
        ->gateway => 'Hoofdpagina',
    'podcasts' => 'podcasts',
    'episodes' => 'afleveringen',
    'subscriptions' => 'abonnementen',
    'contributors' => 'bijdragers',
    'pages' => 'paginas',
    'settings' => 'instellingen',
    'theme' => 'thema',
    'about' => 'over',
    'add' => 'toevoegen',
    'new' => 'nieuw',
    'edit' => 'bewerken',
    'persons' => 'personen',
    'publish' => 'publiceren',
    'publish-edit' => 'publicatie aanpassen',
    'publish-date-edit' => 'publicatiedatum bewerken',
    'unpublish' => 'publicatie ongedaan maken',
    'delete' => 'verwijder',
    'remove' => 'verwijder',
    'fediverse' => 'fediverse',
    'blocked-actors' => 'geblokkeerde actoren',
    'blocked-domains' => 'geblokkeerde domeinen',
    'users' => 'gebruikers',
    'my-account' => 'mijn account',
    'change-password' => 'wachtwoord wijzigen',
    'imports' => 'imports',
    'platforms' => 'platformen',
    'social' => 'sociale netwerken',
    'funding' => 'financiering',
    'analytics' => 'statistieken',
    'locations' => 'locaties',
    'webpages' => 'webpagina\'s',
    'unique-listeners' => 'unieke luisteraars',
    'players' => 'spelers',
    'listening-time' => 'afspeeltijd',
    'time-periods' => 'tijdspanne',
    'soundbites' => 'geluidsfragment',
    'video-clips' => 'videoclips',
    'embed' => 'embedbare speler',
    'notifications' => 'meldingen',
    'suspend' => 'opschorten',
];
