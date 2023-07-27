<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'manual_config' => 'پیکربندی دستی',
    'manual_config_subtitle' =>
        'Create a `.env` file with your settings and refresh the page to continue installation.',
    'form' => [
        'instance_config' => 'پیکربندی نمونه',
        'hostname' => 'نام میزبان',
        'media_base_url' => 'نشانی پایهٔ رسانه',
        'media_base_url_hint' =>
            'If you use a CDN and/or an external analytics service, you may set them here.',
        'admin_gateway' => 'دروازهٔ مدیر',
        'admin_gateway_hint' =>
            'The route to access the admin area (eg. https://example.com/cp-admin). It is set by default as cp-admin, we recommend you change it for security reasons.',
        'auth_gateway' => 'دروازهٔ هویت‌سنجی',
        'auth_gateway_hint' =>
            'The route to access the authentication pages (eg. https://example.com/cp-auth). It is set by default as cp-auth, we recommend you change it for security reasons.',
        'database_config' => 'پیکربندی پایگاه داده',
        'database_config_hint' =>
            'Castopod needs to connect to your MySQL (or MariaDB) database. If you do not have these required info, please contact your server administrator.',
        'db_hostname' => 'نام میزبان پایگاه داده',
        'db_name' => 'نام پایگاه‌داده',
        'db_username' => 'نام کاربری پایگاه‌داده',
        'db_password' => 'گذرواژهٔ پایگاه‌داده',
        'db_prefix' => 'پيشوند پايگاه‌داده',
        'db_prefix_hint' =>
            "The prefix of the Castopod table names, leave as is if you don't know what it means.",
        'cache_config' => 'پیکربندی انباره',
        'cache_config_hint' =>
            'Choose your preferred cache handler. Leave it as the default value if you have no clue what it means.',
        'cache_handler' => 'مدیر انباره',
        'cacheHandlerOptions' => [
            'file' => 'پرونده',
            'redis' => 'ردیس',
            'predis' => 'Predis',
        ],
        'next' => 'بعدی',
        'submit' => 'پایان نصب',
        'create_superadmin' => 'ایجاد حساب ابرمدیریتان',
        'email' => 'رایانامه',
        'username' => 'نام‌کاربری',
        'password' => 'گذرواژه',
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
