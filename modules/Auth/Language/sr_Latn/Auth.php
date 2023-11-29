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
            'title' => 'Vlasnik instance',
            'description' => 'Vlasnik Castopoda.',
        ],
        'superadmin' => [
            'title' => 'Super administrator',
            'description' => 'Ima kompletnu kontrolu nad Castopod-om.',
        ],
        'manager' => [
            'title' => 'Menadžer',
            'description' => 'Upravlja sadržajem na Castopod-u.',
        ],
        'podcaster' => [
            'title' => 'Podkaster',
            'description' => 'Opšti korisnici Castopod-a.',
        ],
    ],
    'instance_permissions' => [
        'admin.access' => 'Može pristupiti administratorskom delu Castopod-a.',
        'admin.settings' => 'Može pristupiti podešavanjima Castopod-a.',
        'users.manage' => 'Može upravljati korisnicima Castopod-a.',
        'persons.manage' => 'Može upravljati osobama.',
        'pages.manage' => 'Može upravljati stranicama.',
        'podcasts.view' => 'Može videti sve podkaste.',
        'podcasts.create' => 'Može napraviti nove podkaste.',
        'podcasts.import' => 'Može uvesti nove podkaste.',
        'fediverse.manage-blocks' => 'Može blokirati interakciju Castopoda i fedivers naloga/domena.',
    ],
    'podcast_groups' => [
        'owner' => [
            'title' => 'Vlasnik podkasta',
            'description' => 'Vlasnik podkasta.',
        ],
        'admin' => [
            'title' => 'Administrator',
            'description' => 'Ima kompletnu kontrolu nad podkastom #{id}.',
        ],
        'editor' => [
            'title' => 'Urednik',
            'description' => 'Upravlja sadržajem i objavama podkasta #{id}.',
        ],
        'author' => [
            'title' => 'Autor',
            'description' => 'Upravlja sadržajem podkasta #{id} ali ne može da ga objavi.',
        ],
        'guest' => [
            'title' => 'Gost',
            'description' => 'Saradnik na podkastu #{id}.',
        ],
    ],
    'podcast_permissions' => [
        'view' => 'Može videti upravljačku tablu i analitiku podkasta #{id}.',
        'edit' => 'Može uređivati podkast #{id}.',
        'delete' => 'Može obrisati podkast #{id}.',
        'manage-import' => 'Može sinhronizovati uvezen podkast #{id}.',
        'manage-persons' => 'Može upravljati pretplatama na podkast #{id}.',
        'manage-subscriptions' => 'Može upravljati pretplatama na podkast #{id}.',
        'manage-contributors' => 'Može upravljati saradnicima na podkastu #{id}.',
        'manage-platforms' => 'Može ubaciti/izbaciti veze ka platformama podkasta #{id}.',
        'manage-publications' => 'Može objaviti podkast #{id}.',
        'manage-notifications' => 'Može videti obaveštenja i označiti ih kao pročitana za podkast #{id}.',
        'interact-as' => 'Može da komunicira kao podkast #{id} i deli, odgovara na i stavlja u omiljene postove.',
        'episodes.view' => 'Može videti upravljačku tablu i analitiku epizoda podkasta #{id}.',
        'episodes.create' => 'Može napraviti epizode podkasta #{id}.',
        'episodes.edit' => 'Može uređivati epizode podkasta #{id}.',
        'episodes.delete' => 'Može obrisati epizode podkasta #{id}.',
        'episodes.manage-persons' => 'Može upravljati osobama na epizodama podkasta #{id}.',
        'episodes.manage-clips' => 'Može upravljati video klipovima i zvučnim isečcima podkasta #{id}.',
        'episodes.manage-publications' => 'Može da objavi/poništi objavljivanje epizoda i postova podkasta #{id}.',
        'episodes.manage-comments' => 'Može dodati/obrisati komentar na epizodi podkasta #{id}.',
    ],

    // missing keys
    'code' => 'Vaša šestocifrena šifra',

    'set_password' => 'Podesi lozinku',

    // Welcome email
    'welcomeSubject' => 'Pozvani ste na {siteName}',
    'emailWelcomeMailBody' => 'Za vas je napravljen nalog na {domain}, kliknite na link za prijavu ispod da biste postavili lozinku. Veza je važeća {numberOfHours} sati nakon slanja ove e-pošte.',
];
