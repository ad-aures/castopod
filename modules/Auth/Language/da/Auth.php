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
            'title' => 'Instance Owner',
            'description' => 'The Castopod owner.',
        ],
        'superadmin' => [
            'title' => 'Super admin',
            'description' => 'Has complete control over Castopod.',
        ],
        'manager' => [
            'title' => 'Manager',
            'description' => 'Manages Castopod\'s content.',
        ],
        'podcaster' => [
            'title' => 'Podcaster',
            'description' => 'General users of Castopod.',
        ],
    ],
    'instance_permissions' => [
        'admin.access' => 'Can access the Castopod admin area.',
        'admin.settings' => 'Can access the Castopod settings.',
        'users.manage' => 'Can manage Castopod users.',
        'persons.manage' => 'Can manage persons.',
        'pages.manage' => 'Can manage pages.',
        'podcasts.view' => 'Can view all podcasts.',
        'podcasts.create' => 'Can create new podcasts.',
        'podcasts.import' => 'Can import podcasts.',
        'fediverse.manage-blocks' => 'Can block fediverse actors/domains from interacting with Castopod.',
    ],
    'podcast_groups' => [
        'owner' => [
            'title' => 'Podcast Owner',
            'description' => 'The podcast owner.',
        ],
        'admin' => [
            'title' => 'Admin',
            'description' => 'Has complete control of podcast #{id}.',
        ],
        'editor' => [
            'title' => 'Editor',
            'description' => 'Manages content and publications of podcast #{id}.',
        ],
        'author' => [
            'title' => 'Author',
            'description' => 'Manages content of podcast #{id} but cannot publish them.',
        ],
        'guest' => [
            'title' => 'Guest',
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
        'manage-publications' => 'Can publish podcast #{id}.',
        'manage-notifications' => 'Can view and mark notifications as read for podcast #{id}.',
        'interact-as' => 'Can interact as the podcast #{id} to favourite, share or reply to posts.',
        'episodes' => [
            'view' => 'Can view dashboards and analytics of podcast #{id}\'s episodes.',
            'create' => 'Can create episodes for podcast #{id}.',
            'edit' => 'Can edit episodes of podcast #{id}.',
            'delete' => 'Can delete episodes of podcast #{id}.',
            'manage-persons' => 'Can manage episode persons of podcast #{id}.',
            'manage-clips' => 'Can manage video clips or soundbites of podcast #{id}.',
            'manage-publications' => 'Can publish/unpublish episodes and posts of podcast #{id}.',
            'manage-comments' => 'Can create/remove episode comments of podcast #{id}.',
        ],
    ],

    // missing keys
    'code' => 'Your 6-digit code',

    'set_password' => 'Set your password',

    // Welcome email
    'welcomeSubject' => 'You\'ve been invited to {siteName}',
    'emailWelcomeMailBody' => 'An account was created for you on {domain}, click on the login link below to set your password. The link is valid for {numberOfHours} hours after this email was sent.',
];
