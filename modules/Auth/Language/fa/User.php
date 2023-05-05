<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_role' => "ویراش نقش {username}",
    'ban' => 'Ban',
    'unban' => 'Unban',
    'delete' => 'حذف',
    'create' => 'کاربر جدید',
    'view' => "اطّلاعات {username}",
    'all_users' => 'تمامی کاربران',
    'list' => [
        'user' => 'کاربر',
        'role' => 'نقش',
        'banned' => 'Banned?',
    ],
    'form' => [
        'email' => 'رایانامه',
        'username' => 'نام‌کاربری',
        'password' => 'گذرواژه',
        'new_password' => 'گذرواژه‌ٔ جدید',
        'role' => 'نقش',
        'roles' => 'نقش‌ها',
        'permissions' => 'اجازه‌ها',
        'submit_create' => 'ایجاد کاربر',
        'submit_edit' => 'ذخیره',
        'submit_password_change' => 'تغییر!',
    ],
    'delete_form' => [
        'title' => 'حذف {user}',
        'disclaimer' =>
            "You are about to delete {user} permanently. They will not be able to access the admin area anymore.",
        'understand' => 'I understand, I want to delete {user} permanently',
        'submit' => 'حذف',
    ],
    'messages' => [
        'createSuccess' =>
            'کاربر با موفّقیت ساخته شد! رایانامهٔ خوش‌آمدی به همراه پیوند ورود برای {username} فرستاده شد. در نخستین ورودش اعلانی برای بازنشانی گذرواژه دریافت خواهد کرد.',
        'roleEditSuccess' =>
            "{username}'s roles have been successfully updated.",
        'banSuccess' => '{username} has been banned.',
        'unbanSuccess' => '{username} has been unbanned.',
        'editOwnerError' =>
            '{username} مالک نمونه است. کسی به سادگی مالک را تغییر نمی‌دهد…',
        'banSuperAdminError' =>
            '{username} is a superadmin, one does not simply ban a superadmin…',
        'deleteOwnerError' =>
            '{username} is the instance owner, one does not simply delete the owner…',
        'deleteSuperAdminError' =>
            '{username} is a superadmin, one does not simply delete a superadmin…',
        'deleteSuccess' => '{username} has been deleted.',
    ],
];
