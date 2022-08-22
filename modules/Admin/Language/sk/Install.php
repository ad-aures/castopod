<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'manual_config' => 'Vlastnoručné nastavenie',
    'manual_config_subtitle' =>
        'Create a `.env` file with your settings and refresh the page to continue installation.',
    'form' => [
        'instance_config' => 'Instance configuration',
        'hostname' => 'Hostname',
        'media_base_url' => 'Media base URL',
        'media_base_url_hint' =>
            'If you use a CDN and/or an external analytics service, you may set them here.',
        'admin_gateway' => 'Admin gateway',
        'admin_gateway_hint' =>
            'The route to access the admin area (eg. https://example.com/cp-admin). It is set by default as cp-admin, we recommend you change it for security reasons.',
        'auth_gateway' => 'Auth gateway',
        'auth_gateway_hint' =>
            'The route to access the authentication pages (eg. https://example.com/cp-auth). It is set by default as cp-auth, we recommend you change it for security reasons.',
        'database_config' => 'Database configuration',
        'database_config_hint' =>
            'Castopod needs to connect to your MySQL (or MariaDB) database. If you do not have these required info, please contact your server administrator.',
        'db_hostname' => 'Database hostname',
        'db_name' => 'Database name',
        'db_username' => 'Database username',
        'db_password' => 'Database password',
        'db_prefix' => 'Database prefix',
        'db_prefix_hint' =>
            "The prefix of the Castopod table names, leave as is if you don't know what it means.",
        'cache_config' => 'Cache configuration',
        'cache_config_hint' =>
            'Choose your preferred cache handler. Leave it as the default value if you have no clue what it means.',
        'cache_handler' => 'Obslužný mechanizmus vyrovnávacej pamäte',
        'cacheHandlerOptions' => [
            'file' => 'Súbor',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => 'Ďalej',
        'submit' => 'Dokončiť inštaláciu',
        'create_superadmin' => 'Vytvoriť účet hlavného správcu',
        'email' => 'Email',
        'username' => 'Meno používateľa',
        'password' => 'Heslo',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Účet hlavného správcu je úspešne vytvorený. Prihláste sa a začnite podcastovať!',
        'databaseConnectError' =>
            'Castopod sa nedokáže pripojiť k databáze. Upravte konfiguráciu a skúste znovu.',
        'writeError' =>
            "Nie je možné vytvoriť/zapísať súbor `.env`. Mali by ste ho vytvoriť ručne podľa vzoru v súbore `.env.example` v balíku castopod.",
    ],
];
