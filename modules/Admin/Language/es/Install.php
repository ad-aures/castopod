<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'manual_config' => 'Configuración manual',
    'manual_config_subtitle' =>
        'Create a `.env` file with your settings and refresh the page to continue installation.',
    'form' => [
        'instance_config' => 'Configuración de instancia',
        'hostname' => 'Nombre de host',
        'media_base_url' => 'Media base URL',
        'media_base_url_hint' =>
            'If you use a CDN and/or an external analytics service, you may set them here.',
        'admin_gateway' => 'Pasarela de administración',
        'admin_gateway_hint' =>
            'The route to access the admin area (eg. https://example.com/cp-admin). It is set by default as cp-admin, we recommend you change it for security reasons.',
        'auth_gateway' => 'Pasarela de autenticación',
        'auth_gateway_hint' =>
            'The route to access the authentication pages (eg. https://example.com/cp-auth). It is set by default as cp-auth, we recommend you change it for security reasons.',
        'database_config' => 'Configuración de la base de datos',
        'database_config_hint' =>
            'Castopod necesita conectarse a su base de datos MySQL (o MariaDB). Si no tiene esta información requerida, póngase en contacto con el administrador de su servidor.',
        'db_hostname' => 'Nombre de host de la base de datos',
        'db_name' => 'Nombre de la base de datos',
        'db_username' => 'Usuario la de base de datos',
        'db_password' => 'Database password',
        'db_prefix' => 'Database prefix',
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
        'next' => 'Siguiente',
        'submit' => 'Finalizar la instalación',
        'create_superadmin' => 'Crear la cuenta de administración',
        'email' => 'Correo electrónico',
        'username' => 'Nombre de usuario',
        'password' => 'Password',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Your superadmin account has been created successfully. Login to start podcasting!',
        'databaseConnectError' =>
            'Castopod could not connect to your database. Edit your database configuration and try again.',
        'writeError' =>
            "Couldn't create/write the `.env` file. You must create it manually by following the `.env.example` file template in the Castopod package.",
    ],
];
