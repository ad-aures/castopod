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
            'title' => 'Perc\'henn·ez an istañs',
            'description' => 'Perc\'henn·ez Castopod.',
        ],
        'superadmin' => [
            'title' => 'Dreistmerour·ez',
            'description' => 'Ur c\'hontroll klok en deus war Castopod.',
        ],
        'manager' => [
            'title' => 'Merour·ez',
            'description' => 'Merañ a ra endalc\'had Castopod.',
        ],
        'podcaster' => [
            'title' => 'Podkaster',
            'description' => 'Implijerien·ezed kustum Castopod.',
        ],
    ],
    'instance_permissions' => [
        'admin.access' => 'Gallout a ra gwelet taolenn-stur Castopod.',
        'admin.settings' => 'Gallout a ra gwelet arventennoù Castopod.',
        'users.manage' => 'Gallout a ra ober war-dro implijerien·ezed Castopod.',
        'persons.manage' => 'Gallout a ra merañ an emellerien·ezed.',
        'pages.manage' => 'Gallout a ra merañ ar pajennoù.',
        'podcasts.view' => 'Gallout a ra gwelet an holl bodkastoù.',
        'podcasts.create' => 'Gallout a ra krouiñ podkastoù nevez.',
        'podcasts.import' => 'Gallout a ra enporzhiañ podkastoù.',
        'fediverse.manage-blocks' => 'Gallout a ra mirout aktourien·ezed pe domanioù ar Fediverse ouzh kaout darempredoù gant Castopod.',
    ],
    'podcast_groups' => [
        'owner' => [
            'title' => 'Perc\'henn·ez ar podkast',
            'description' => 'Perc\'henn·ez ar podkast.',
        ],
        'admin' => [
            'title' => 'Merour·ez',
            'description' => 'Ur c\'hontroll klok en deus war ar podkast #{id}.',
        ],
        'editor' => [
            'title' => 'Embanner',
            'description' => 'Merañ a ra endalc\'had hag embannadurioù ar podkast #{id}.',
        ],
        'author' => [
            'title' => 'Aozer·ez',
            'description' => 'Merañ a ra endalc\'had ar podkast #{id} met ne c\'hall ket embann anezho.',
        ],
        'guest' => [
            'title' => 'Kouviad·ez',
            'description' => 'Perzhiad·ez eus ar podkast #{id}.',
        ],
    ],
    'podcast_permissions' => [
        'view' => 'Gallout a ra gwelet taolenn-stur ha muzulioù heklev ar podkast #{id}.',
        'edit' => 'Gallout a ra kemmañ ar podkast #{id}.',
        'delete' => 'Gallout a ra lemel ar podkast #{id}.',
        'manage-import' => 'Gallout a ra sinkronekaat ar podkast enporzhiet #{id}.',
        'manage-persons' => 'Gallout a ra merañ koumanantoù ar podkast #{id}.',
        'manage-subscriptions' => 'Gallout a ra merañ koumanantoù ar podkast #{id}.',
        'manage-contributors' => 'Gallout a ra merañ perzhidi ha perzhiadezed ar podkast #{id}.',
        'manage-platforms' => 'Gallout a ra ouzhpennañ pe lemel liammoù etrezek savennoù diavaez evit ar podkast #{id}.',
        'manage-publications' => 'Gallout a ra embann ar podkast #{id}.',
        'manage-notifications' => 'Gallout a ra gwelet kemennoù ar podkast #{id} ha lakaat anezho evel lennet.',
        'interact-as' => 'Gallout a ra ober traoù gant identelezh ar podkast #{id}: ouzhpennañ ur gemennadenn d\'ar re garetañ, rannañ anezhi pe respont dezhi.',
        'episodes.view' => 'Gallout a ra gwelet taolennoù-stur ha muzulioù heklev rannoù ar podkast #{id}.',
        'episodes.create' => 'Gallout a ra krouiñ rannoù evit podkast #{id}.',
        'episodes.edit' => 'Gallout a ra kemmañ rannoù ar podkast #{id}.',
        'episodes.delete' => 'Gallout a ra lemel rannoù ar podkast #{id}.',
        'episodes.manage-persons' => 'Gallout a ra merañ emellerien·ezed ar podkast #{id}.',
        'episodes.manage-clips' => 'Gallout a ra merañ klipoù video pe tennadoù son ar podkast #{id}.',
        'episodes.manage-publications' => 'Gallout a ra embann pe diembann rannoù ha kemennadennoù ar podkast #{id}.',
        'episodes.manage-comments' => 'Gallout a ra krouiñ/lemel evezhiadennoù evit rannoù ar podkast #{id}.',
    ],

    // missing keys
    'code' => 'Ho kod 6 sifr dezhañ',

    'set_password' => 'Skrivit ho ker-tremen',

    // Welcome email
    'welcomeSubject' => 'Pedet oc\'h bet da vont war {siteName}',
    'emailWelcomeMailBody' => 'Krouet ez eus bet ur gont deoc\'h war {domain}. Klikit war al liamm amañ-dindan evit choaz ur ger-tremen. Bev e vo al liamm betek {numberOfHours} eur goude m\'eo bet kaset ar postel-mañ.',
];
