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
            'title' => 'Właściciel instancji',
            'description' => 'Właściciel Castopoda.',
        ],
        'superadmin' => [
            'title' => 'Superadministrator',
            'description' => 'Ma pełną kontrolę nad Castopod.',
        ],
        'manager' => [
            'title' => 'Manager',
            'description' => 'Zarządza zawartością Castopoda.',
        ],
        'podcaster' => [
            'title' => 'Podcaster',
            'description' => 'Zwykli użytkownicy Castopoda.',
        ],
    ],
    'instance_permissions' => [
        'admin.access' => 'Ma dostęp do panelu administracyjnego Castopoda.',
        'admin.settings' => 'Ma dostęp do ustawień Castopoda.',
        'users.manage' => 'Może zarządzać użytkownikami Castopoda.',
        'persons.manage' => 'Może zarządzać osobami.',
        'pages.manage' => 'Może zarządzać stronami.',
        'podcasts.view' => 'Może wyświetlać wszystkie podcasty.',
        'podcasts.create' => 'Może tworzyć nowe podcasty.',
        'podcasts.import' => 'Może importować podcasty.',
        'fediverse.manage-blocks' => 'Można blokować aktorów/domeny z fediwersum przed interakcjami z Castopodem.',
    ],
    'podcast_groups' => [
        'owner' => [
            'title' => 'Właściciel Podcastu',
            'description' => 'Właściciel podcastu.',
        ],
        'admin' => [
            'title' => 'Admin',
            'description' => 'Ma pełną kontrolę nad podcastem #{id}.',
        ],
        'editor' => [
            'title' => 'Edytor',
            'description' => 'Zarządza treścią i publikacjami podcastu #{id}.',
        ],
        'author' => [
            'title' => 'Autor',
            'description' => 'Zarządza zawartością podcastu #{id}, ale nie może jej opublikować.',
        ],
        'guest' => [
            'title' => 'Gość',
            'description' => 'Główny współtwórca podcastu #{id}.',
        ],
    ],
    'podcast_permissions' => [
        'view' => 'Może wyświetlań panel zarządzania oraz analitykę podcastu #{id}.',
        'edit' => 'Może edytować podcast #{id}.',
        'delete' => 'Może usunąć podcast #{id}.',
        'manage-import' => 'Może synchronizować importowany podcast #{id}.',
        'manage-persons' => 'Może zarządzać subskrypcjami podcastu #{id}.',
        'manage-subscriptions' => 'Może zarządzać subskrypcjami podcastu #{id}.',
        'manage-contributors' => 'Może zarządzać współtwórcami podcastu #{id}.',
        'manage-platforms' => 'Można ustawić/usunąć linki platformy podcastu #{id}.',
        'manage-publications' => 'Może publikować podcast #{id}.',
        'manage-notifications' => 'Może wyświetlać i oznaczać powiadomienia jako przeczytane dla podcastu #{id}.',
        'interact-as' => 'Może jako podcast #{id} dodawać do ulubionych, udostępniać lub odpowiadać na posty.',
        'episodes' => [
            'view' => 'Może wyświetlać panel zarządzania oraz analitykę odcinków podcastu #{id}.',
            'create' => 'Może tworzyć odcinki dla podcastu #{id}.',
            'edit' => 'Może edytować odcinki podcastu #{id}.',
            'delete' => 'Można usuwać odcinki podcastu #{id}.',
            'manage-persons' => 'Może zarządzać osobami w odcinkach podcastu #{id}.',
            'manage-clips' => 'Może zarządzać klipami wideo lub zajawkami podcastu #{id}.',
            'manage-publications' => 'Może publikować/cofać publikowanie odcinków i postów podcastu #{id}.',
            'manage-comments' => 'Może tworzyć/usuwać komentarze odcinka podcastu #{id}.',
        ],
    ],

    // missing keys
    'code' => 'Twój 6-cyfrowy kod',

    'set_password' => 'Ustaw swoje hasło',

    // Welcome email
    'welcomeSubject' => 'Zostałeś zaproszony do {siteName}',
    'emailWelcomeMailBody' => 'Na {domain} zostało utworzone dla Ciebie konto, kliknij poniższy link logowania, aby ustawić hasło. Link jest ważny przez {numberOfHours} godzin po wysłaniu tego e-maila.',
];
