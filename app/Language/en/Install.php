<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'form' => [
        'castopod_config' => 'Castopod configuration',
        'hostname' => 'Hostname',
        'admin_gateway' => 'Admin gateway',
        'auth_gateway' => 'Auth gateway',
        'db_config' => 'Database configuration',
        'db_hostname' => 'Database hostname',
        'db_name' => 'Database name',
        'db_username' => 'Database username',
        'db_password' => 'Database password',
        'db_prefix' => 'Database prefix',
        'submit_install' => 'Install!',
        'create_superadmin' => 'Create your superadmin account',
        'email' => 'Email',
        'username' => 'Username',
        'password' => 'Password',
        'submit_create_superadmin' => 'Create superadmin!',
    ],
    'messages' => [
        'migrateSuccess' =>
            'Database has been created successfully, and all required data have been stored!',
        'createSuperAdminSuccess' =>
            'Your superadmin account has been created successfully. Let\'s login to the admin area!',
        'databaseConnectError' =>
            'Unable to connect to the database. Make sure the values in .env are correct. If not, edit them and refresh the page or delete the .env file to restart install.',
        'migrationError' =>
            'There was an issue during migration. Make sure the values in .env are correct. If not, edit them and refresh the page or delete the .env file to restart install.',
        'seedError' =>
            'There was an issue when seeding the database. Make sure the values in .env are correct. If not, edit them and refresh the page or delete the .env file to restart install.',
        'error' =>
            '<strong>An error occurred during install</strong><br/> {message}',
    ],
];
