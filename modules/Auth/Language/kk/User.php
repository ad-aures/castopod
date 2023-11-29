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
    'delete' => 'Delete',
    'create' => 'New user',
    'view' => "{username}'s info",
    'all_users' => 'All users',
    'list' => [
        'user' => 'User',
        'role' => 'Role',
        'banned' => 'Banned?',
    ],
    'form' => [
        'email' => 'Email',
        'username' => 'Username',
        'password' => 'Password',
        'new_password' => 'New Password',
        'role' => 'Role',
        'roles' => 'Roles',
        'permissions' => 'Permissions',
        'submit_create' => 'Create user',
        'submit_edit' => 'Save',
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
            'User created successfully! A welcome email was sent to {username} with a login link, they will be prompted with a password reset upon first authentication.',
        'roleEditSuccess' =>
            "{username}'s roles have been successfully updated.",
        'banSuccess' => '{username} has been banned.',
        'unbanSuccess' => '{username} has been unbanned.',
        'editOwnerError' =>
            '{username} is the instance owner, one does not simply touch the owner…',
        'banSuperAdminError' =>
            '{username} is a superadmin, one does not simply ban a superadmin…',
        'deleteOwnerError' =>
            '{username} is the instance owner, one does not simply delete the owner…',
        'deleteSuperAdminError' =>
            '{username} is a superadmin, one does not simply delete a superadmin…',
        'deleteSuccess' => '{username} has been deleted.',
    ],
];
