<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_role' => "Edit {username}'s role",
    'ban' => 'Ban',
    'unban' => 'Unban',
    'delete' => 'احذف',
    'create' => 'مستخدم جديد',
    'view' => "{username}'s info",
    'all_users' => 'كافة المستخدمين',
    'list' => [
        'user' => 'مستخدم',
        'role' => 'Role',
        'banned' => 'Banned?',
    ],
    'form' => [
        'email' => 'البريد الإلكتروني',
        'username' => 'اسم المستخدم',
        'password' => 'كلمة المرور',
        'new_password' => 'كلمة المرور الجديدة',
        'role' => 'Role',
        'roles' => 'الأدوار',
        'permissions' => 'Permissions',
        'submit_create' => 'Create user',
        'submit_edit' => 'حفظ',
        'submit_password_change' => 'Change!',
    ],
    'delete_form' => [
        'title' => 'Delete {user}',
        'disclaimer' =>
            "You are about to delete {user} permanently. They will not be able to access the admin area anymore.",
        'understand' => 'I understand, I want to delete {user} permanently',
        'submit' => 'Delete',
    ],
    'messages' => [
        'createSuccess' =>
            'User created successfully! {username} will be prompted with a password reset upon first authentication.',
        'roleEditSuccess' =>
            "{username}'s roles have been successfully updated.",
        'banSuccess' => '{username} has been banned.',
        'unbanSuccess' => '{username} has been unbanned.',
        'editOwnerError' =>
            '{username} is the instance owner, you cannot edit its roles.',
        'banSuperAdminError' =>
            '{username} is a superadmin, one does not simply ban a superadmin…',
        'deleteOwnerError' =>
            '{username} is the instance owner, one does not simply delete the owner…',
        'deleteSuperAdminError' =>
            '{username} is a superadmin, one does not simply delete a superadmin…',
        'deleteSuccess' => '{username} has been deleted.',
    ],
];
