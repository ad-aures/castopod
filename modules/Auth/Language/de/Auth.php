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
            'description' => 'General users of Castopod.',
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
        'fediverse.manage-blocks' => 'Can block fediverse actors/domains from interacting with Castopod.',
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
            'description' => 'General contributor of the podcast #{id}.',
        ],
    ],
    'podcast_permissions' => [
        'view' => 'Can view dashboard and analytics of podcast #{id}.',
        'edit' => 'Can edit podcast #{id}.',
        'delete' => 'Can delete podcast #{id}.',
        'manage-import' => 'Can synchronize imported podcast #{id}.',
        'manage-persons' => 'Can manage subscriptions of podcast #{id}.',
        'manage-subscriptions' => 'Can manage subscriptions of podcast #{id}.',
        'manage-contributors' => 'Can manage contributors of podcast #{id}.',
        'manage-platforms' => 'Can set/remove platform links of podcast #{id}.',
        'manage-publications' => 'Kann Podcast #{id} veröffentlichen.',
        'manage-notifications' => 'Can view and mark notifications as read for podcast #{id}.',
        'interact-as' => 'Can interact as the podcast #{id} to favourite, share or reply to posts.',
        'episodes.view' => 'Can view dashboards and analytics of podcast #{id}\'s episodes.',
        'episodes.create' => 'Kann Folgen für Podcast #{id} erstellen.',
        'episodes.edit' => 'Kann Folgen von Podcast #{id} bearbeiten.',
        'episodes.delete' => 'Kann Folgen von Podcast #{id} löschen.',
        'episodes.manage-persons' => 'Can manage episode persons of podcast #{id}.',
        'episodes.manage-clips' => 'Can manage video clips or soundbites of podcast #{id}.',
        'episodes.manage-publications' => 'Can publish/unpublish episodes and posts of podcast #{id}.',
        'episodes.manage-comments' => 'Can create/remove episode comments of podcast #{id}.',
    ],

    // missing keys
    'code' => 'Ihr 6-stelliger Code',

    'notEnoughPrivilege' => 'Sie haben keine ausreichenden Berechtigungen, um auf diese Seite zuzugreifen.',
    'set_password' => 'Legen Sie Ihr Passwort fest',

    // Welcome email
    'welcomeSubject' => 'Sie wurden zu {siteName} eingeladen',
    'emailWelcomeMailBody' => 'An account was created for you on {domain}, click on the login link below to set your password. The link is valid for {numberOfHours} hours after this email was sent.',
];
