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
            'title' => 'Instanzbesitzer',
            'description' => 'Der Castopod-Besitzer.',
        ],
        'superadmin' => [
            'title' => 'Super-Administrator',
            'description' => 'Hat die vollständige Kontrolle über Castopod.',
        ],
        'manager' => [
            'title' => 'Manager',
            'description' => 'Verwaltet Castopods Inhalte.',
        ],
        'podcaster' => [
            'title' => 'Podcaster',
            'description' => 'Allgemeine Benutzer von Castopod.',
        ],
    ],
    'instance_permissions' => [
        'admin.access' => 'Kann auf den Admin-Bereich von Castopod zugreifen.',
        'admin.settings' => 'Kann auf die Einstellungen von Castopod zugreifen.',
        'users.manage' => 'Kann Castopod-Benutzer verwalten.',
        'persons.manage' => 'Kann Mitwirkende verwalten.',
        'pages.manage' => 'Kann Seiten verwalten.',
        'podcasts.view' => 'Kann alle Podcasts einsehen.',
        'podcasts.create' => 'Kann neue Podcasts erstellen.',
        'podcasts.import' => 'Kann Podcasts importieren.',
        'fediverse.manage-blocks' => 'Kann föderierte Nutzer/Domains davon abhalten, mit Castopod zu interagieren.',
    ],
    'podcast_groups' => [
        'owner' => [
            'title' => 'Podcast-Besitzer',
            'description' => 'Der Podcast-Besitzer.',
        ],
        'admin' => [
            'title' => 'Administrator',
            'description' => 'Hat die vollständige Kontrolle über Podcast #{id}.',
        ],
        'editor' => [
            'title' => 'Editor',
            'description' => 'Verwaltet Inhalte und Veröffentlichungen von Podcast #{id}.',
        ],
        'author' => [
            'title' => 'Autor',
            'description' => 'Verwaltet Inhalte von Podcast #{id}, kann diese aber nicht veröffentlichen.',
        ],
        'guest' => [
            'title' => 'Gast',
            'description' => 'Allgemeiner Mitwirkender des Podcasts #{id}.',
        ],
    ],
    'podcast_permissions' => [
        'view' => 'Kann das Dashboard und Analysen des Podcasts #{id} einsehen.',
        'edit' => 'Kann Podcast #{id} bearbeiten.',
        'delete' => 'Kann Podcast #{id} löschen.',
        'manage-import' => 'Kann den importierten Podcast #{id} synchronisieren.',
        'manage-persons' => 'Kann Abonnements des Podcasts #{id} verwalten.',
        'manage-subscriptions' => 'Kann Abonnements des Podcasts #{id} verwalten.',
        'manage-contributors' => 'Kann Mitwirkende des Podcasts #{id} verwalten.',
        'manage-platforms' => 'Kann Plattform-Links des Podcasts #{id} verwalten.',
        'manage-publications' => 'Kann Podcast #{id} veröffentlichen.',
        'manage-notifications' => 'Kann Benachrichtigungen des Podcasts #{id} einsehen und als gelesen markieren.',
        'interact-as' => 'Kann als Podcast #{id} interagieren, um Beiträge zu favorisieren, zu teilen oder diese zu beantworten.',
        'episodes' => [
            'view' => 'Kann Dashboards und Analysen von Episoden des Podcasts #{id} einsehen.',
            'create' => 'Kann Folgen für Podcast #{id} erstellen.',
            'edit' => 'Kann Folgen von Podcast #{id} bearbeiten.',
            'delete' => 'Kann Folgen von Podcast #{id} löschen.',
            'manage-persons' => 'Kann Personen von Episoden des Podcasts #{id} verwalten.',
            'manage-clips' => 'Kann Videoclips und Soundbites des Podcasts #{id} verwalten.',
            'manage-publications' => 'Kann Episoden und Posts von Podcast #{id} veröffentlichen/zurückziehen.',
            'manage-comments' => 'Kann Kommentare von Folgen des Podcasts #{id} erstellen und löschen.',
        ],
    ],

    // missing keys
    'code' => 'Ihr 6-stelliger Code',

    'set_password' => 'Legen Sie Ihr Passwort fest',

    // Welcome email
    'welcomeSubject' => 'Sie wurden zu {siteName} eingeladen',
    'emailWelcomeMailBody' => 'Ein Account auf {domain} wurde für Sie angelegt, klicken Sie auf den unten stehenden Login-Link, um Ihr Passwort festzulegen. Der Link ist mit Versand der Mail für {numberOfHours} gültig.',
];
