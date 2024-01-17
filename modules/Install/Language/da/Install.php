<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Castopod installationsprogram',
    'manual_config' => 'Manuel konfiguration',
    'manual_config_subtitle' =>
        'Opret en `.env` fil med dine indstillinger og opdater siden for at fortsætte installationen.',
    'form' => [
        'instance_config' => 'Instanskonfiguration',
        'hostname' => 'Hostname',
        'media_base_url' => 'Medie base URL',
        'media_base_url_hint' =>
            'Hvis du bruger en CDN og/eller en ekstern analysetjeneste, kan du indstille dem her.',
        'admin_gateway' => 'Admin gateway',
        'admin_gateway_hint' =>
            'The route to access the admin area (eg. https://example.com/cp-admin). It is set by default as cp-admin, we recommend you change it for security reasons.',
        'auth_gateway' => 'Auth gateway',
        'auth_gateway_hint' =>
            'The route to access the authentication pages (eg. https://example.com/cp-auth). It is set by default as cp-auth, we recommend you change it for security reasons.',
        'database_config' => 'Database configuration',
        'database_config_hint' =>
            'Castopod skal oprette forbindelse til din MySQL (eller MariaDB) database. Hvis du ikke har disse nødvendige oplysninger, bedes du kontakte din serveradministrator.',
        'db_hostname' => 'Database host navn',
        'db_name' => 'Databasenavn',
        'db_username' => 'Database brugernavn',
        'db_password' => 'Database adgangskode',
        'db_prefix' => 'Database præfiks',
        'db_prefix_hint' =>
            "The prefix of the Castopod table names, leave as is if you don't know what it means.",
        'cache_config' => 'Cache configuration',
        'cache_config_hint' =>
            'Choose your preferred cache handler. Leave it as the default value if you have no clue what it means.',
        'cache_handler' => 'Cache handler',
        'cacheHandlerOptions' => [
            'file' => 'File',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => 'Næste',
        'submit' => 'Afslut installation',
        'create_superadmin' => 'Opret din Super Admin konto',
        'email' => 'Email',
        'username' => 'Brugernavn',
        'password' => 'Adgangskode',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Din superadmin konto er blevet oprettet. Log ind for at starte podcasting!',
        'databaseConnectError' =>
            'Castopod kunne ikke oprette forbindelse til din database. Rediger din database konfiguration og prøv igen.',
        'writeError' =>
            "Kunne ikke oprette/skrive `.env` filen. Du skal oprette den manuelt ved at følge `.env.example` filskabelon i Castopod-pakken.",
    ],
];
