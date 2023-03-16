<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'manual_config' => 'Ручне налаштування',
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
        'db_hostname' => 'Ім\'я хоста бази даних',
        'db_name' => 'Назва бази даних',
        'db_username' => 'Ім\'я користувача бази даних',
        'db_password' => 'Пароль бази даних',
        'db_prefix' => 'Префікс бази даних',
        'db_prefix_hint' =>
            "The prefix of the Castopod table names, leave as is if you don't know what it means.",
        'cache_config' => 'Cache configuration',
        'cache_config_hint' =>
            'Choose your preferred cache handler. Leave it as the default value if you have no clue what it means.',
        'cache_handler' => 'Обробник кешу',
        'cacheHandlerOptions' => [
            'file' => 'Файл',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => 'Далі',
        'submit' => 'Завершити установку',
        'create_superadmin' => 'Створіть свій обліковий запис головного адміністратора',
        'email' => 'Пошта',
        'username' => 'Ім\'я користувача',
        'password' => 'Пароль',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Ваш обліковий запис суперадміністратора було успішно створено. Увійдіть, щоб почати подкасти!',
        'databaseConnectError' =>
            'Кастопод не зміг підключитись до бази даних. Змініть конфігурацію бази даних і повторіть спробу.',
        'writeError' =>
            "Не вдалося створити/записати файл `.env`. Ви повинні створити його вручну, перейшовши шаблон файлу `.env.example` в пакеті Castopode.",
    ],
];
