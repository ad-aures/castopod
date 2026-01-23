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
            'title' => 'Serverio savininkas',
            'description' => '„Castopod“ serverio savininkas.',
        ],
        'superadmin' => [
            'title' => 'Superadministratorius',
            'description' => 'Turi visas įmanomas teises „Castopod“ serveryje.',
        ],
        'manager' => [
            'title' => 'Tvarkytojas',
            'description' => 'Tvarko „Castopod“ turinį.',
        ],
        'podcaster' => [
            'title' => 'Tinklalaidininkas',
            'description' => 'Įprastas „Castopod“ naudotojas.',
        ],
    ],
    'instance_permissions' => [
        'admin.access' => 'Turi prieigą prie „Castopod“ administravimo aplinkos.',
        'admin.settings' => 'Turi prieigą prie „Castopod“ nuostatų.',
        'users.manage' => 'Gali tvarkyti „Castopod“ naudotojus.',
        'persons.manage' => 'Gali tvarkyti asmenis.',
        'pages.manage' => 'Gali tvarkyti tinklalapius.',
        'podcasts.view' => 'Gali peržiūrėti visas tinklalaides.',
        'podcasts.create' => 'Gali kurti naujas tinklalaides.',
        'podcasts.import' => 'Gali importuoti tinklalaides.',
        'fediverse.manage-blocks' => 'Gali blokuoti Fedivisatos paskyrų ir domenų sąveikavimą su „Castopod“.',
    ],
    'podcast_groups' => [
        'owner' => [
            'title' => 'Tinklalaidės savininkas',
            'description' => 'Tinklalaidės savininkas.',
        ],
        'admin' => [
            'title' => 'Administratorius',
            'description' => 'Visapusiškai valdo tinklalaidę #{id}.',
        ],
        'editor' => [
            'title' => 'Redaktorius',
            'description' => 'Tvarko tinklalaidės #{id} turinį ir publikacijas.',
        ],
        'author' => [
            'title' => 'Autorius',
            'description' => 'Tvarko tinklalaidės #{id} turinį, bet negali jo skelbti.',
        ],
        'guest' => [
            'title' => 'Svečias',
            'description' => 'Paprastas tinklalaidės #{id} talkininkas.',
        ],
    ],
    'podcast_permissions' => [
        'view' => 'Gali matyti tinklalaidės #{id} skydelį ir analitiką.',
        'edit' => 'Gali taisyti tinklalaidę #{id}.',
        'delete' => 'Gali pašalinti tinklalaidę #{id}.',
        'manage-import' => 'Gali sinchronizuoti importuojamą tinklalaidę #{id}.',
        'manage-persons' => 'Gali tvarkyti tinklalaidės #{id} prenumeratas.',
        'manage-subscriptions' => 'Gali tvarkyti tinklalaidės #{id} prenumeratas.',
        'manage-contributors' => 'Gali tvarkyti tinklalaidės #{id} talkininkus.',
        'manage-platforms' => 'Gali pridėti ir šalinti tinklalaidės #{id} platformų nuorodas.',
        'manage-publications' => 'Gali skelbti tinklalaidę #{id}.',
        'manage-notifications' => 'Gali matyti ir žymėti kaip matytus tinklalaidės #{id} pranešimus.',
        'interact-as' => 'Gali tinklalaidės #{id} vardu žymėti įrašus kaip patinkančius, dalintis jais ir rašyti į juos atsakymus.',
        'episodes' => [
            'view' => 'Gali matyti tinklalaidės #{id} epizodų skydelius ir analitiką.',
            'create' => 'Gali kurti tinklalaidės #{id} epizodus.',
            'edit' => 'Gali taisyti tinklalaidės #{id} epizodus.',
            'delete' => 'Gali šalinti tinklalaidės #{id} epizodus.',
            'manage-persons' => 'Gali tvarkyti tinklalaidės #{id} epizodų asmenų sąrašus.',
            'manage-clips' => 'Gali tvarkyti tinklalaidės #{id} epizodų vaizdo įrašus ir garso ištraukas.',
            'manage-publications' => 'Gali skelbti tinklalaidės #{id} epizodus ir įrašus arba nutraukti jų skelbimą.',
            'manage-comments' => 'Gali rašyti ir šalinti tinklalaidės #{id} epizodų komentarus.',
        ],
    ],

    // missing keys
    'code' => 'Jūsų 6 skaitmenų kodas',

    'set_password' => 'Nustatykite savo slaptažodį',

    // Welcome email
    'welcomeSubject' => 'Jus pakvietė į „{siteName}“',
    'emailWelcomeMailBody' => 'Serveryje {domain} jums sukurta naudotojo paskyra. Spustelėkite žemiau esančią nuorodą ir nustatykite paskyros slaptažodį. Ši nuoroda galioja {numberOfHours} val. nuo laiško išsiuntimo momento.',
];
