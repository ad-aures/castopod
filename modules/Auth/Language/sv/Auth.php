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
            'title' => 'Instans Ägare',
            'description' => 'Castopod ägaren.',
        ],
        'superadmin' => [
            'title' => 'Super administratör',
            'description' => 'Har fullständig kontroll över Castopod.',
        ],
        'manager' => [
            'title' => 'Hanterare',
            'description' => 'Hanterar Castopods innehåll.',
        ],
        'podcaster' => [
            'title' => 'Podcaster',
            'description' => 'Generella användare av Castopod.',
        ],
    ],
    'instance_permissions' => [
        'admin.access' => 'Kan komma åt Castopod admin-området.',
        'admin.settings' => 'Kan komma åt Castopod-inställningarna.',
        'users.manage' => 'Kan hantera Castopod-användare.',
        'persons.manage' => 'Kan hantera personer.',
        'pages.manage' => 'Kan hantera sidor.',
        'podcasts.view' => 'Kan se alla podcasts.',
        'podcasts.create' => 'Kan skapa nya podcasts.',
        'podcasts.import' => 'Kan importera podcasts.',
        'fediverse.manage-blocks' => 'Kan blockera fediverse skådespelare/domäner från att interagera med Castopod.',
    ],
    'podcast_groups' => [
        'owner' => [
            'title' => 'Podcast ägare',
            'description' => 'Podcast ägaren.',
        ],
        'admin' => [
            'title' => 'Admin',
            'description' => 'Har fullständig kontroll över podcast #{id}.',
        ],
        'editor' => [
            'title' => 'Redigerare',
            'description' => 'Hanterar innehåll och publikationer i podcast #{id}.',
        ],
        'author' => [
            'title' => 'Författare',
            'description' => 'Hanterar innehåll i podcast #{id} men kan inte publicera dem.',
        ],
        'guest' => [
            'title' => 'Gäst',
            'description' => 'Generell bidragsgivare till podcasten #{id}.',
        ],
    ],
    'podcast_permissions' => [
        'view' => 'Kan visa instrumentpanelen och analysen av podcast #{id}.',
        'edit' => 'Kan redigera podcast #{id}.',
        'delete' => 'Kan ta bort podcast #{id}.',
        'manage-import' => 'Kan synkronisera importerad podcast #{id}.',
        'manage-persons' => 'Kan hantera prenumerationer på podcast #{id}.',
        'manage-subscriptions' => 'Kan hantera prenumerationer på podcast #{id}.',
        'manage-contributors' => 'Kan hantera bidragsgivare för podcast #{id}.',
        'manage-platforms' => 'Kan sätta/ta bort plattformslänkar för podcast #{id}.',
        'manage-publications' => 'Kan publicera podcast #{id}.',
        'manage-notifications' => 'Can view and mark notifications as read for podcast #{id}.',
        'interact-as' => 'Kan interagera som podcasten #{id} för att favorita, dela eller svara på inlägg.',
        'episodes.view' => 'Kan visa instrumentpaneler och analyser av podcast #{id}s avsnitt.',
        'episodes.create' => 'Kan skapa avsnitt för podcast #{id}.',
        'episodes.edit' => 'Kan redigera avsnitt av podcast #{id}.',
        'episodes.delete' => 'Kan ta bort avsnitt av podcast #{id}.',
        'episodes.manage-persons' => 'Kan hantera avsnittpersoner i podcast #{id}.',
        'episodes.manage-clips' => 'Kan hantera videoklipp eller ljudklipp från podcasten #{id}.',
        'episodes.manage-publications' => 'Kan publicera/avpublicera avsnitt och inlägg i podcast #{id}.',
        'episodes.manage-comments' => 'Kan skapa/ta bort avsnitt kommentarer från podcasten #{id}.',
    ],

    // missing keys
    'code' => 'Din 6-siffriga kod',

    'notEnoughPrivilege' => 'Du har inte tillräcklig behörighet att komma åt sidan.',
    'set_password' => 'Välj ett lösenord',

    // Welcome email
    'welcomeSubject' => 'Du har blivit inbjuden till {siteName}',
    'emailWelcomeMailBody' => 'Ett konto skapades för dig på {domain}, klicka på inloggningslänken nedan för att ange ditt lösenord. Länken är giltig i {numberOfHours} timmar efter att detta e-postmeddelande skickats.',
];
