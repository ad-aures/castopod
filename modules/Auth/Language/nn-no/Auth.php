<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'instance_groups' => [
        'owner' => [
            'title' => 'Nettstadeigar',
            'description' => 'Castopod-eigaren.',
        ],
        'superadmin' => [
            'title' => 'Superstyrar',
            'description' => 'Har full kontroll over Castopod.',
        ],
        'manager' => [
            'title' => 'Leiar',
            'description' => 'Styrer innhaldet på Castopod.',
        ],
        'podcaster' => [
            'title' => 'Podkastar',
            'description' => 'Vanlege Castopod-brukarar.',
        ],
    ],
    'instance_permissions' => [
        'admin.access' => 'Kan bruka styringspanelet for Castopod.',
        'admin.settings' => 'Kan få tilgang til innstillingane for Castopod.',
        'users.manage' => 'Kan handtera Castopod-brukarar.',
        'persons.manage' => 'Kan handtera folk.',
        'pages.manage' => 'Kan handtera sider.',
        'podcasts.view' => 'Kan sjå alle podkastane.',
        'podcasts.create' => 'Kan laga nye podkastar.',
        'podcasts.import' => 'Kan importera podkastar.',
        'fediverse.manage-blocks' => 'Kan blokkera folk og domene på allheimen frå å samhandla med Castopod.',
    ],
    'podcast_groups' => [
        'owner' => [
            'title' => 'Podkasteigar',
            'description' => 'Podkasteigaren.',
        ],
        'admin' => [
            'title' => 'Administrator',
            'description' => 'Har full kontroll over podkasten #{id}.',
        ],
        'editor' => [
            'title' => 'Redaktør',
            'description' => 'Styrer innhald og publisering for podkasten #{id}.',
        ],
        'author' => [
            'title' => 'Skapar',
            'description' => 'Styrer innhald for podkasten #{id}, men kan ikkje publisera dei.',
        ],
        'guest' => [
            'title' => 'Gjest',
            'description' => 'Vanleg bidragsytar til podkasten #{id}.',
        ],
    ],
    'podcast_permissions' => [
        'view' => 'Kan sjå styringspanelet og analysedata for podkasten #{id}.',
        'edit' => 'Kan redigera podkasten #{id}.',
        'delete' => 'Kan sletta podkasten #{id}.',
        'manage-import' => 'Kan synkronisera den importerte podkasten #{id}.',
        'manage-persons' => 'Kan handtera abonnement for podkasten #{id}.',
        'manage-subscriptions' => 'Kan handtera abonnement for podkasten #{id}.',
        'manage-contributors' => 'Kan handtera bidragsytarar for podkasten #{id}.',
        'manage-platforms' => 'Kan oppretta og fjerna plattformlenkjer for podkasten #{id}.',
        'manage-publications' => 'Kan publisera podkasten #{id}.',
        'manage-notifications' => 'Kan lesa og merka varsel som lesne for podkasten #{id}.',
        'interact-as' => 'Kan merka podkasten #{id} som favoritt, dela og svara på innlegg.',
        'episodes' => [
            'view' => 'Kan sjå styringspanelet og analysedata for episodane av podkasten #{id}.',
            'create' => 'Kan laga epoisodar for podkasten #{id}.',
            'edit' => 'Kan redigera episodane av podkasten #{id}.',
            'delete' => 'Kan sletta episodar av podkasten #{id}.',
            'manage-persons' => 'Kan handtera bidragsytarar til episodar av podkasten #{id}.',
            'manage-clips' => 'Kan handtera film- og lydklypp av podkasten #{id}.',
            'manage-publications' => 'Kan publisera og avpublisera episodar og innlegg for podkasten #{id}.',
            'manage-comments' => 'Kan skriva og sletta kommentarar til episodane av podkasten #{id}.',
        ],
    ],

    // missing keys
    'code' => 'Den sekssifra koden din',

    'set_password' => 'Lag eit passord',

    // Welcome email
    'welcomeSubject' => 'Du er invitert til {siteName}',
    'emailWelcomeMailBody' => 'Me har laga ein konto til deg på {domain}. Klikk på lenka under for å laga eit passord. Lenka er gyldig i {numberOfHours} timar etter eposten vart send.',
];
