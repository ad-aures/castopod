<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_roles' => "Edit {username}'s roles",
    'forcePassReset' => 'Force pass reset',
    'ban' => 'Ban',
    'unban' => 'Unban',
    'delete' => 'احذف',
    'create' => 'مستخدم جديد',
    'view' => "{username}'s info",
    'all_users' => 'كافة المستخدمين',
    'list' => [
        'user' => 'مستخدم',
        'roles' => 'الأدوار',
        'banned' => 'Banned?',
    ],
    'form' => [
        'email' => 'البريد الإلكتروني',
        'username' => 'اسم المستخدم',
        'password' => 'كلمة المرور',
        'new_password' => 'كلمة المرور الجديدة',
        'roles' => 'الأدوار',
        'permissions' => 'Permissions',
        'submit_create' => 'Create user',
        'submit_edit' => 'حفظ',
        'submit_password_change' => 'Change!',
    ],
    'roles' => [
        'superadmin' => 'Super admin',
    ],
    'messages' => [
        'createSuccess' =>
            'User created successfully! {username} will be prompted with a password reset upon first authentication.',
        'rolesEditSuccess' =>
            "{username}'s roles have been successfully updated.",
        'forcePassResetSuccess' =>
            '{username} will be prompted with a password reset upon next visit.',
        'banSuccess' => '{username} has been banned.',
        'unbanSuccess' => '{username} has been unbanned.',
        'banSuperAdminError' =>
            '{username} is a superadmin, one does not simply ban a superadmin…',
        'deleteSuperAdminError' =>
            '{username} is a superadmin, one does not simply delete a superadmin…',
        'deleteSuccess' => '{username} has been deleted.',
    ],
];
