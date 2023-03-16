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
            'title' => 'Instance eigenaar',
            'description' => 'De Castopod eigenaar.',
        ],
        'superadmin' => [
            'title' => 'Super beheerder',
            'description' => 'Heeft de volledige controle over Castopod.',
        ],
        'manager' => [
            'title' => 'Beheerder',
            'description' => 'Beheert de inhoud van Castopod.',
        ],
        'podcaster' => [
            'title' => 'Podcaster',
            'description' => 'Algemene gebruikers van Castopod.',
        ],
    ],
    'instance_permissions' => [
        'admin.access' => 'Kan toegang krijgen tot de beheeromgeving van Castopod.',
        'admin.settings' => 'Kan toegang krijgen tot de instellingen van Castopod.',
        'users.manage' => 'Kan Castopod-gebruikers beheren.',
        'persons.manage' => 'Kan personen beheren.',
        'pages.manage' => 'Kan pagina\'s beheren.',
        'podcasts.view' => 'Kan alle podcasts bekijken.',
        'podcasts.create' => 'Kan nieuwe podcast aanmaken.',
        'podcasts.import' => 'Kan podcasts importeren.',
        'fediverse.manage-blocks' => 'Kan fediverse actors/domains blokkeren voor interactie met Castopod.',
    ],
    'podcast_groups' => [
        'owner' => [
            'title' => 'Podcast Eigenaar',
            'description' => 'De eigenaar van de podcast.',
        ],
        'admin' => [
            'title' => 'Beheerder',
            'description' => 'Heeft de volledige controle over podcast #{id}.',
        ],
        'editor' => [
            'title' => 'Redacteur',
            'description' => 'Beheert inhoud en publicaties van podcast #{id}.',
        ],
        'author' => [
            'title' => 'Auteur',
            'description' => 'Beheert de inhoud van podcast #{id} maar kan deze niet publiceren.',
        ],
        'guest' => [
            'title' => 'Gast',
            'description' => 'Algemene bijdrager van podcast #{id}.',
        ],
    ],
    'podcast_permissions' => [
        'view' => 'Kan dashboard en analyses van podcast #{id} zien.',
        'edit' => 'Kan podcast #{id} wijzigen.',
        'delete' => 'Kan podcast #{id} verwijderen.',
        'manage-import' => 'Kan de geïmporteerde podcast #{id} synchroniseren.',
        'manage-persons' => 'Kan abonnementen van podcast #{id} beheren.',
        'manage-subscriptions' => 'Kan abonnementen van podcast #{id} beheren.',
        'manage-contributors' => 'Kan bijdragers van podcast #{id} beheren.',
        'manage-platforms' => 'Kan platform links van podcast #{id} instellen of verwijderen.',
        'manage-publications' => 'Kan podcast #{id} publiceren.',
        'manage-notifications' => 'Kan meldingen bekijken en markeren als gelezen voor podcast #{id}.',
        'interact-as' => 'Kan als podcast #{id} handelen om te favorieten, te delen of te reageren op berichten.',
        'episodes.view' => 'Kan dashboard en analyses van de afleveringen van podcast #{id} zien.',
        'episodes.create' => 'Kan afleveringen voor podcast #{id} aanmaken.',
        'episodes.edit' => 'Kan afleveringen van podcast #{id} wijzigen.',
        'episodes.delete' => 'Kan afleveringen van podcast #{id} verwijderen.',
        'episodes.manage-persons' => 'Kan aflevering personen van podcast #{id} beheren.',
        'episodes.manage-clips' => 'Kan videoclips of soundbites van podcast #{id} beheren.',
        'episodes.manage-publications' => 'Kan afleveringen en berichten van podcast #{id} publiceren/depubliceren.',
        'episodes.manage-comments' => 'Kan opmerkingen van aflevering van podcast van #{id} maken of verwijderen.',
    ],

    // missing keys
    'code' => 'Jouw 6-cijferige code',

    'notEnoughPrivilege' => 'U heeft niet voldoende rechten om deze pagina te openen.',
    'set_password' => 'Stel je wachtwoord in',

    // Welcome email
    'welcomeSubject' => 'Je bent uitgenodigd voor {siteName}',
    'emailWelcomeMailBody' => 'Er is een account voor u aangemaakt op {domain}, klik op onderstaande inloglink om uw wachtwoord in te stellen. De link is geldig tot {numberOfHours} uur nadat deze e-mail is verzonden.',
];
