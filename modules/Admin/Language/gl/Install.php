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
        'Crear un ficheiro `.env` cos teus axustes e actualizar a páxina para continuar coa instalación.',
    'form' => [
        'instance_config' => 'Configuración da instancia',
        'hostname' => 'Servidor',
        'media_base_url' => 'URL base do multimedia',
        'media_base_url_hint' =>
            'Se usas unha CDN e/ou un servizo externo de análise, debes indicalo aquí.',
        'admin_gateway' => 'Pasarela de administración',
        'admin_gateway_hint' =>
            'A ruta para acceder á área de administración (ex. https://exemplo.com/cp-admin). Por defecto establécese cp-admin, recomendámosche cambialo por razóns de seguridade.',
        'auth_gateway' => 'Pasarela de autenticación',
        'auth_gateway_hint' =>
            'A ruta para acceder á páxina de autenticación (ex. https://exemplo.com/cp-auth). Por defecto establécese como cp-auth, pero recomendámosche cambialo por razóns de seguridade.',
        'database_config' => 'Configuración da base de datos',
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
            "Couldn't create/write the `.env` file. You must create it manually by following the `.env.example` file template in the Castopod package.",
    ],
];
