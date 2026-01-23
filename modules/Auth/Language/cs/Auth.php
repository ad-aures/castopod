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
            'title' => 'Vlastník instance',
            'description' => 'Vlastník Castopodu.',
        ],
        'superadmin' => [
            'title' => 'Super Admin',
            'description' => 'Má úplnou kontrolu nad Castopodem.',
        ],
        'manager' => [
            'title' => 'Manažer',
            'description' => 'Spravuje obsah Castopodu.',
        ],
        'podcaster' => [
            'title' => 'Podcaster',
            'description' => 'Obecní uživatelé Castopod.',
        ],
    ],
    'instance_permissions' => [
        'admin.access' => 'Může se dostat do oblasti administrace Castopod.',
        'admin.settings' => 'Může přistupovat k nastavení Castopodu.',
        'users.manage' => 'Může spravovat uživatele Castopod.',
        'persons.manage' => 'Může řídit osoby.',
        'pages.manage' => 'Může spravovat stránky.',
        'podcasts.view' => 'Může zobrazit všechny podcasty.',
        'podcasts.create' => 'Může vytvářet nové podcasty.',
        'podcasts.import' => 'Může importovat podcasty.',
        'fediverse.manage-blocks' => 'Může blokovat fediverse aktéry/domény a jejch interakce s Castopodem.',
    ],
    'podcast_groups' => [
        'owner' => [
            'title' => 'Vlastník podcastu',
            'description' => 'Vlastník podcastu.',
        ],
        'admin' => [
            'title' => 'Admin',
            'description' => 'Má úplnou kontrolu nad podcastem #{id}.',
        ],
        'editor' => [
            'title' => 'Editor',
            'description' => 'Spravuje obsah a publikace podcastu #{id}.',
        ],
        'author' => [
            'title' => 'Autor',
            'description' => 'Spravuje obsah kanálu #{id} , ale nemůže jej publikovat.',
        ],
        'guest' => [
            'title' => 'Návštěvník',
            'description' => 'Obecný přispěvatel podcastu #{id}.',
        ],
    ],
    'podcast_permissions' => [
        'view' => 'Může prohlížet dashboard a analyzovat podcast #{id}.',
        'edit' => 'Může upravovat podcast #{id}.',
        'delete' => 'Může odstranit podcast #{id}.',
        'manage-import' => 'Může synchronizovat importovaný podcast #{id}.',
        'manage-persons' => 'Může spravovat odběry podcastu #{id}.',
        'manage-subscriptions' => 'Může spravovat odběry podcastu #{id}.',
        'manage-contributors' => 'Může spravovat přispěvatele podcastu #{id}.',
        'manage-platforms' => 'Může nastavit/odebrat odkazy na platformu podcastu #{id}.',
        'manage-publications' => 'Může publikovat podcast #{id}.',
        'manage-notifications' => 'Může zobrazovat a označovat oznámení jako přečtená pro podcast #{id}.',
        'interact-as' => 'Může komunikovat jako podcast #{id}, označovat jako oblíbené, sdílet nebo odpovědět na příspěvky.',
        'episodes' => [
            'view' => 'Může prohlížet nástěnky a analyzovat epizody podcastu #{id}.',
            'create' => 'Může vytvářet epizody pro podcast #{id}.',
            'edit' => 'Může upravovat epizody vysílání #{id}.',
            'delete' => 'Může odstranit epizody podcastu #{id}.',
            'manage-persons' => 'Může spravovat osoby u epizod z podcastu #{id}.',
            'manage-clips' => 'Může spravovat videoklipy nebo úryvky podcastu #{id}.',
            'manage-publications' => 'Může publikovat/zrušit publikování epizod a příspěvků podcastu #{id}.',
            'manage-comments' => 'Může vytvářet nebo odebrat komentáře epizod podcastu #{id}.',
        ],
    ],

    // missing keys
    'code' => 'Váš 6-místný kód',

    'set_password' => 'Natavte si heslo',

    // Welcome email
    'welcomeSubject' => 'Byli jste pozváni do {siteName}',
    'emailWelcomeMailBody' => 'Na {domain} byl pro Vás vytvořen účet, klikněte na přihlášení níže pro nastavení hesla. Odkaz je platný po {numberOfHours} hodin po zaslání tohoto e-mailu.',
];
