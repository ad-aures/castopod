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
            'title' => 'Ιδιοκτήτης Διακομιστή',
            'description' => 'Ο ιδιοκτήτης του Castopod.',
        ],
        'superadmin' => [
            'title' => 'Υπερδιαχειριστής',
            'description' => 'Έχει πλήρη έλεγχο του Castopod.',
        ],
        'manager' => [
            'title' => 'Διαχειριστής',
            'description' => 'Διαχείριση περιεχομένου του Castopod.',
        ],
        'podcaster' => [
            'title' => 'Podcaster',
            'description' => 'Γενικοί χρήστες του Castopod.',
        ],
    ],
    'instance_permissions' => [
        'admin.access' => 'Μπορεί να έχει πρόσβαση στην περιοχή διαχείρισης Castopod.',
        'admin.settings' => 'Μπορεί να έχει πρόσβαση στις ρυθμίσεις Castopod.',
        'users.manage' => 'Μπορεί να διαχειριστεί τους χρήστες Castopod.',
        'persons.manage' => 'Μπορεί να διαχειριστεί τα άτομα.',
        'pages.manage' => 'Μπορεί να διαχειριστεί τις σελίδες.',
        'podcasts.view' => 'Μπορεί να δει όλα τα podcasts.',
        'podcasts.create' => 'Μπορεί να δημιουργήσει νέα podcasts.',
        'podcasts.import' => 'Μπορεί να εισάγει podcasts.',
        'fediverse.manage-blocks' => 'Μπορεί να εμποδίσει τους ψευτογενείς ηθοποιούς/τομείς να αλληλεπιδρούν με το Castopod.',
    ],
    'podcast_groups' => [
        'owner' => [
            'title' => 'Ιδιοκτήτης Podcast',
            'description' => 'Ο ιδιοκτήτης του podcast.',
        ],
        'admin' => [
            'title' => 'Διαχειριστής',
            'description' => 'Έχει πλήρη έλεγχο του podcast #{id}.',
        ],
        'editor' => [
            'title' => 'Εκδότης',
            'description' => 'Διαχειρίζεται περιεχόμενο και δημοσιεύσεις του podcast #{id}.',
        ],
        'author' => [
            'title' => 'Συντάκτης',
            'description' => 'Manages content of podcast #{id} but cannot publish them.',
        ],
        'guest' => [
            'title' => 'Επισκέπτης',
            'description' => 'Γενικός συντελεστής του podcast #{id}.',
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
        'episodes.view' => 'Can view dashboards and analytics of podcast #{id}\'s episodes.',
        'episodes.create' => 'Can create episodes for podcast #{id}.',
        'episodes.edit' => 'Can edit episodes of podcast #{id}.',
        'episodes.delete' => 'Can delete episodes of podcast #{id}.',
        'episodes.manage-persons' => 'Can manage episode persons of podcast #{id}.',
        'episodes.manage-clips' => 'Can manage video clips or soundbites of podcast #{id}.',
        'episodes.manage-publications' => 'Can publish/unpublish episodes and posts of podcast #{id}.',
        'episodes.manage-comments' => 'Can create/remove episode comments of podcast #{id}.',
    ],

    // missing keys
    'code' => 'Your 6-digit code',

    'set_password' => 'Set your password',

    // Welcome email
    'welcomeSubject' => 'You\'ve been invited to {siteName}',
    'emailWelcomeMailBody' => 'An account was created for you on {domain}, click on the login link below to set your password. The link is valid for {numberOfHours} hours after this email was sent.',
];
