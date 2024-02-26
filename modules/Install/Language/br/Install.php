<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Stalier Castopod',
    'manual_config' => 'Kefluniañ dre zorn',
    'manual_config_subtitle' =>
        'Krouit ur restr `.env` gant hoc’h arventennoù ha nevesait ar bajenn evit kenderc\'hel gant ar staliañ.',
    'form' => [
        'instance_config' => 'Arventennoù an istañs',
        'hostname' => 'Anv an ostiz',
        'media_base_url' => 'Chomlec\'h diazez ar mediaoù',
        'media_base_url_hint' =>
            'Ma \'z implijit ur CDN pe ur servij diavaez evit muzuliañ heklev, e c\'hellit lakaat anezho amañ.',
        'admin_gateway' => 'Chomlec\'h an daolenn-stur',
        'admin_gateway_hint' =>
            'An hent evit mont d\'an daolenn-stur (da sk. https://skouer.bzh/cp-admin). Dre ziouer eo cp-admin, met erbedet oc\'h kemmañ anezhañ evit abegoù a denn d\'an diogelroez.',
        'auth_gateway' => 'Chomlec\'h ar c\'hennaskañ',
        'auth_gateway_hint' =>
            'An hent evit mont d\'ar bajenn gennaskañ (da sk. https://skouer.bzh/cp-auth). Dre ziouer eo cp-auth, met erbedet oc\'h kemmañ anezhañ evit abegoù a denn d\'an diogelroez.',
        'database_config' => 'Arventennoù ar stlennvon',
        'database_config_hint' =>
            'Castopod a rank bezañ kennesket ouzh ho stlennvon MySQL (pe MariaDB). Mont e darempred gant merour ho tafariad ma n\'emañ ket ganeoc\'h an titouroù-se.',
        'db_hostname' => 'Anv ostiz ar stlennvon',
        'db_name' => 'Anv ar stlennvon (an diaz)',
        'db_username' => 'Anv implijer ar stlennvon',
        'db_password' => 'Ger-tremen ar stlennvon',
        'db_prefix' => 'Rakger an taolennoù',
        'db_prefix_hint' =>
            "Rakger taolennoù Castopod. Laoskit evel m'emañ ma ne ouzoc'h ket petra a dalv.",
        'cache_config' => 'Arventennoù ar grubuilh (cache)',
        'cache_config_hint' =>
            'Dibabit hoc’h ardoer krubuilh muiañ plijet. Laoskit evel m\'emañ ma ne ouzoc\'h ket petra a dalv.',
        'cache_handler' => 'Aorder krubuilh',
        'cacheHandlerOptions' => [
            'file' => 'Restroù',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => 'War-lerc\'h',
        'submit' => 'Echuiñ ar staliañ',
        'create_superadmin' => 'Krouit ho kont gourverour·ez (superadmin)',
        'email' => 'Postel',
        'username' => 'Anv implijer·ez',
        'password' => 'Ger-tremen',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Ho kont gourverour·ez a zo bet krouet gant berzh. Kevreit ha krogit da bodkastiñ!',
        'databaseConnectError' =>
            'N\'en deus ket gellet Castopod kevreañ ouzh ho stlennvon. Kemmit arventennoù ar stlennvon ha klaskit en-dro.',
        'writeError' =>
            "N'haller ket krouiñ/skrivañ ar restr `.env`. Deoc'h-c'hwi da grouiñ anezhi dre zorn diwar ar patrom `.env.example` az o e pakad Castopod.",
    ],
];
