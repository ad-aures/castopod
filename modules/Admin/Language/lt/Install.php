<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'manual_config' => 'Rankinis konfigūravimas',
    'manual_config_subtitle' =>
        'Sukurkite failą `.env` su naudotinais nustatymais ir įkelkite šį tinklalapį iš naujo diegimui pratęsti.',
    'form' => [
        'instance_config' => 'Serverio konfigūracija',
        'hostname' => 'Serverio vardas',
        'media_base_url' => 'Daugialypės terpės failų bazinis URL',
        'media_base_url_hint' =>
            'Jei naudojatės CDN ir/ar išorine srauto analizės tarnyba, galite tai nurodyti čia.',
        'admin_gateway' => 'Administratoriaus skydelio adresas',
        'admin_gateway_hint' =>
            'Kelias administratoriaus skydeliui pasiekti (pvz., https://example.com/cp-admin). Numatytuoju atveju naudojamas kelias „cp-admin“, tačiau mes rekomenduojame jį pasikeisti saugumo sumetimais.',
        'auth_gateway' => 'Autentifikacijos tinklalapių adresas',
        'auth_gateway_hint' =>
            'Kelias autentifikacijos tinklalapiams pasiekti (pvz., https://example.com/cp-auth). Numatytuoju atveju naudojamas kelias „cp-auth“, tačiau mes rekomenduojame jį pasikeisti saugumo sumetimais.',
        'database_config' => 'Duomenų bazės konfigūracija',
        'database_config_hint' =>
            '„Castopod“ reikia prisijungti prie jūsų „MySQL“ ar „MariaDB“ duomenų bazės. Jei neturite prisijungimo prie duomenų bazės duomenų, kreipkitės į savo serverio administratorių.',
        'db_hostname' => 'DB serveris',
        'db_name' => 'DB pavadinimas',
        'db_username' => 'DB naudotojo vardas',
        'db_password' => 'DB slaptažodis',
        'db_prefix' => 'DB prefiksas',
        'db_prefix_hint' =>
            "„Castopod“ lentelių pavadinimų prefiksas. Jei nežinote, kas tai – palikite kas įrašyta.",
        'cache_config' => 'Podėlio konfigūracija',
        'cache_config_hint' =>
            'Pasirinkite ketinamą naudoti podėlio tipą. Jei nežinote, kas tai – palikite numatytąjį parinktį.',
        'cache_handler' => 'Podėlio tipas',
        'cacheHandlerOptions' => [
            'file' => 'Failas',
            'redis' => '„Redis“',
            'predis' => '„Predis“',
        ],
        'next' => 'Toliau',
        'submit' => 'Užbaigti diegimą',
        'create_superadmin' => 'Susikurkite savo superadministratoriaus paskyrą',
        'email' => 'El. paštas',
        'username' => 'Naudotojo vardas',
        'password' => 'Slaptažodis',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Jūsų superadministratoriaus paskyra sukurta sėkmingai. Prisijunkite ir kurkite savo pirmąją tinklalaidę!',
        'databaseConnectError' =>
            '„Castopod“ nepavyko prisijungti prie nurodytos duomenų bazės. Pakoreguokite DB konfigūraciją ir bandykite dar kartą.',
        'writeError' =>
            "Nepavyko sukurti/rašyti į jūsų `.env` failą. Užpildykite jį rankiniu būdu, pasinaudodami šabloniniu `.env.example` failu iš „Castopod“ paketo.",
    ],
];
