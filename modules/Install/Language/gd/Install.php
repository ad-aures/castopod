<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Inneal-stàlaidh Chastopod',
    'manual_config' => 'Rèiteachadh a làimh',
    'manual_config_subtitle' =>
        'Cruthaich faidhle `.env` leis na roghainnean agad agus ath-nuadhaich an duilleag a leantainn air adhart leis an stàladh.',
    'form' => [
        'instance_config' => 'Rèiteachadh an ionstans',
        'hostname' => 'Ainm an òstair',
        'media_base_url' => 'URL bunaiteach nam meadhanan',
        'media_base_url_hint' =>
            'Ma tha thu a’ cleachdadh CDN agus/no seirbheis anailiseachd air an taobh a-muigh, faodaidh tu an suidheachadh an-seo.',
        'admin_gateway' => 'Balach na rianachd',
        'admin_gateway_hint' =>
            'Seo an t-slighe airson raon na rianachd inntrigeadh (m.e. https://ball-eisimpleir.com/cp-admin). Thèid seo a shuidheachadh air cp-admin a ghnàth ach mholamaid gun atharraich thu seo air adhbhar tèarainteachd.',
        'auth_gateway' => 'Bealach an dearbhaidh',
        'auth_gateway_hint' =>
            'Seo an t-slighe airson duilleagan an dearbhaidh inntrigeadh (m.e. https://ball-eisimpleir.com/cp-auth). Thèid seo a shuidheachadh air cp-auth a ghnàth ach mholamaid gun atharraich thu seo air adhbhar tèarainteachd.',
        'database_config' => 'Rèiteachadh an stòir-dhàta',
        'database_config_hint' =>
            'Feumaidh Castopod ceangal ris an stòr-dàta MySQL (no MariaDB) agad. Mur eil am fiosrachadh riatanach seo agad, cuir fios tu rianaire an fhrithealaiche agad.',
        'db_hostname' => 'Ainm òstair an stòir-dhàta',
        'db_name' => 'Ainm an stòir-dhàta',
        'db_username' => 'Ainm-cleachdaiche an stòir-dhàta',
        'db_password' => 'Facal-faire an stòir-dhàta',
        'db_prefix' => 'Ro-leasachan an stòir-dhàta',
        'db_prefix_hint' =>
            "Seo ro-leasachan do dh’ainmean clàran Chastopod, fàg e mar a tha e mur eil thu a’ tuigsinn dè as ciall dha.",
        'cache_config' => 'Rèiteachadh an tasgadain',
        'cache_config_hint' =>
            'Tagh an làimhsichear as fheàrr leat dhan tasgadan. Fàg air an luach bhunaiteach e mur eil thu a’ tuigsinn dè as ciall dha.',
        'cache_handler' => 'Làimhsichear an tasgadain',
        'cacheHandlerOptions' => [
            'file' => 'Faidhle',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => 'Air adhart',
        'submit' => 'Cuir crìoch air an stàladh',
        'create_superadmin' => 'Cruthaich an cunntas sàr-rianaire agad',
        'email' => 'Post-d',
        'username' => 'Ainm-cleachdaiche',
        'password' => 'Facal-faire',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Chaidh an cunntas sàr-rianaire agad a chruthachadh. Clàraich a-steach a thòiseachadh leis a’ phod-chraoladh!',
        'databaseConnectError' =>
            'Cha b’ urrainn do Chastopod ceangal ris an stòr-dàta agad. Deasaich rèiteachadh an stòir-dhàta agad is feuch ris a-rithist.',
        'writeError' =>
            "Cha b’ urrainn dhuinn am faidhle `.env` a chruthachadh/sgrìobhadh thuige. Feumaidh tu a chruthachadh a làimh a leantainn ris an fhaidhle-teamplaid `.env.example` sa phacaid Castopod.",
    ],
];
