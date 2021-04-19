<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'manual_config' => 'Ręczna konfiguracja',
    'manual_config_subtitle' =>
        'Utwórz plik `.env` z własnymi ustawieniami i odśwież stronę, aby kontynuować instalację.',
    'form' => [
        'instance_config' => 'Kondiguracja instancji',
        'hostname' => 'Nazwa hosta',
        'media_base_url' => 'Media base URL',
        'media_base_url_hint' =>
            'If you use a CDN and/or an external analytics service, you may set them here.',
        'admin_gateway' => 'Admin gateway',
        'admin_gateway_hint' =>
            'The route to access the admin area (eg. https://example.com/cp-admin). It is set by default as cp-admin, we recommend you change it for security reasons.',
        'auth_gateway' => 'Auth gateway',
        'auth_gateway_hint' =>
            'The route to access the authentication pages (eg. https://example.com/cp-auth). It is set by default as cp-auth, we recommend you change it for security reasons.',
        'database_config' => 'Konfiguracja bazy danych',
        'database_config_hint' =>
            'Castopod needs to connect to your MySQL (or MariaDB) database. If you do not have these required info, please contact your server administrator.',
        'db_hostname' => 'Nazwa hosta bazy danych',
        'db_name' => 'Nazwa bazy danych',
        'db_username' => 'Nazwa użytkownika bazy danych',
        'db_password' => 'Hasło bazy danych',
        'db_prefix' => 'Prefiks bazy danych',
        'db_prefix_hint' =>
            'Prefiks nazw tabeli Castopod, pozostaw obecny jeśli nie wiesz co to znaczy.',
        'cache_config' => 'Konfiguracja pamięci podręcznej',
        'cache_config_hint' =>
            'Choose your preferred cache handler. Leave it as the default value if you have no clue what it means.',
        'cache_handler' => 'Cache handler',
        'cacheHandlerOptions' => [
            'file' => 'Plik',
            'redis' => 'Redis',
            'memcached' => 'Memcached',
        ],
        'next' => 'Dalej',
        'submit' => 'Zakończ instalację',
        'create_superadmin' => 'Utwórz konto super administratora',
        'email' => 'Adres e-mail',
        'username' => 'Nazwa użytkownika',
        'password' => 'Hasło',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Your superadmin account has been created successfully. Login to start podcasting!',
        'databaseConnectError' =>
            'Castopod could not connect to your database. Edit your database configuration and try again.',
        'writeError' =>
            'Couldn\'t create/write the `.env` file. You must create it manually by following the `.env.example` file template in the Castopod package.',
    ],
];
