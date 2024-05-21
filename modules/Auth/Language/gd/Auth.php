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
            'title' => 'Sealbhadair an ionstans',
            'description' => 'Cò leis a tha an Castopod seo.',
        ],
        'superadmin' => [
            'title' => 'Sàr-rianaire',
            'description' => 'Smachd gu lèir air Castopod.',
        ],
        'manager' => [
            'title' => 'Manaidsear',
            'description' => 'Stiùireadh susbaint Chastopod.',
        ],
        'podcaster' => [
            'title' => 'Pod-chraoladair',
            'description' => 'Luchd-cleachdaidh coitcheann Chastopod.',
        ],
    ],
    'instance_permissions' => [
        'admin.access' => '’S urrainn dhaibh raon rianachd Chastopod inntrigeadh.',
        'admin.settings' => '’S urrainn dhaibh roghainnean Chastopod inntrigeadh.',
        'users.manage' => '’S urrainn dhaibh luchdc-leachdaidh Chastopod a stiùireadh.',
        'persons.manage' => '’S urrainn dhaibh daoine a stiùireadh.',
        'pages.manage' => '’S urrainn dhaibh duilleagan a stiùireadh.',
        'podcasts.view' => 'Chì iad a h-uile pod-chraoladh.',
        'podcasts.create' => '’S urrainn dhaibh pod-chraolaidhean ùra a chruthachadh.',
        'podcasts.import' => '’S urrainn dhaibh pod-chraolaidhean ion-phortadh.',
        'fediverse.manage-blocks' => '’S urrainn dhaibh actairean/àrainnean a cho-shaoghail a bhacadh o eadar-ghabhail le Castopod.',
    ],
    'podcast_groups' => [
        'owner' => [
            'title' => 'Seilbheadair a’ phod-chraolaidh',
            'description' => 'Cò leis a tha am pod-chraoladh.',
        ],
        'admin' => [
            'title' => 'Rianaire',
            'description' => 'Smachd gu lèir air air a’ phod-chraoladh #{id}.',
        ],
        'editor' => [
            'title' => 'Deasaiche',
            'description' => 'A’ stiùireadh susbaint is foillseachaidhean a’ phod-chraoladh #{id}.',
        ],
        'author' => [
            'title' => 'Ùghdar',
            'description' => 'A’ stiùireadh susbaint a’ phod-chraolaidh #{id} ach gun chomas foillseachaidh.',
        ],
        'guest' => [
            'title' => 'Aoigh',
            'description' => 'Neach-cuideachaidh a’ phod-chraolaidh #{id}.',
        ],
    ],
    'podcast_permissions' => [
        'view' => 'Cead an deas-bhòrd agus anailiseachd a’ phod-chraolaidh #{id} a shealltainn.',
        'edit' => '’S urrainn dhaibh am pod-chraoladh #{id} a dheasachadh.',
        'delete' => '’S urrainn dhaibh am pod-chraoladh #{id} a sguabadh às.',
        'manage-import' => '’S urrainn dhaibh am pod-chraoladh #{id} air ion-phortadh a shioncronachadh.',
        'manage-persons' => '’S urrainn dhaibh na fo-sgrìobhaidhean air a’ phod-chraoladh #{id} a stiùireadh.',
        'manage-subscriptions' => '’S urrainn dhaibh na fo-sgrìobhaidhean air a’ phod-chraoladh #{id} a stiùireadh.',
        'manage-contributors' => '’S urrainn dhaibh an luchd-cuideachaidh aig a’ phod-chraoladh #{id} a stiùireadh.',
        'manage-platforms' => '’S urrainn dhaibh ceanglaichean-ùrlair a’ phod-chraolaidh #{id} a shuidheachadh/a thoirt air falbh.',
        'manage-publications' => '’S urrainn dhaibh am pod-chraoladh #{id} fhoillseachadh.',
        'manage-notifications' => 'Chì iad brathan a’ phod-chraolaidh #{id} agus ’s urrainn dhaibh comharra a chur gun deach an leughadh.',
        'interact-as' => '’S urrainn dhaibh eadar-ghabhail ’na phod-chraoladh #{id} airson annsachdan, co-roinneadh is freagairtean do phostaichean.',
        'episodes' => [
            'view' => 'Chì iad deas-bhùird is anailiseachd do dh’eapasodan a’ phod-chraolaidh #{id}.',
            'create' => '’S urrainn dhaibh eapasodan a chruthachadh dhan phod-chraoladh #{id}.',
            'edit' => '’S urrainn dhaibh eapasodan a’ phod-chraolaidh #{id} a dheasachadh.',
            'delete' => '’S urrainn dhaibh eapasodan a’ phod-chraolaidh #{id} a sguabadh às.',
            'manage-persons' => '’S urrainn dhaibh daoine nan eapasodan aig a’ phod-chraoladh #{id} a stiùireadh.',
            'manage-clips' => '’S urrainn dhaibh cliopaichean video no blasan-fuaime aig a’ phod-chraoladh #{id} a stiùireadh.',
            'manage-publications' => '’S urrainn dhaibh eapasodan is postaichean a’ phod-chraolaidh #{id} fhoillseachadh/neo-fhoillseachadh.',
            'manage-comments' => '’S urrainn dhaibh beachdan air eapasod a’ phod-chraolaidh #{id} a chruthachadh/a thoirt air falbh.',
        ],
    ],

    // missing keys
    'code' => 'An còd 6-àireamhach agad',

    'set_password' => 'Suidhich am facal-faire agad',

    // Welcome email
    'welcomeSubject' => 'Fhuair thu cuireadh gu {siteName}',
    'emailWelcomeMailBody' => 'Chaidh cunntas a chruthachadh dhut air {domain}, briog air ceangal a’ chlàraidh a-steach gu h-ìosal airson am facal-faire agad a shuidheachadh. Bidh an ceangal dligheach fad {numberOfHours} uair a thìde às dèidh cur a’ phuist-d seo.',
];
