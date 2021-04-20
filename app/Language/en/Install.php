<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'manual_config' => 'Manual configuration',
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
            'The prefix of the Castopod table names, leave as is if you don\'t know what it means.',
        'cache_config' => 'Cache configuration',
        'cache_config_hint' =>
            'Choose your preferred cache handler. Leave it as the default value if you have no clue what it means.',
        'cache_handler' => 'Cache handler',
        'cacheHandlerOptions' => [
            'file' => 'File',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => 'Next',
        'submit' => 'Finish install',
        'create_superadmin' => 'Create your superadmin account',
        'email' => 'Email',
        'username' => 'Username',
        'password' => 'Password',
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
