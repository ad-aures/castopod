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
    'delete' => 'Dilemel',
    'create' => 'Krouiñ un implijer·ez',
    'view' => "Titouroù diwar-benn {username}",
    'all_users' => 'An holl implijerien·ezed',
    'list' => [
        'user' => 'Implijer·ez',
        'role' => 'Role',
        'banned' => 'Banned?',
    ],
    'form' => [
        'email' => 'Postel',
        'username' => 'Anv implijer·ez',
        'password' => 'Ger-tremen',
        'new_password' => 'Ger-tremen nevez',
        'role' => 'Role',
        'roles' => 'Rolloù',
        'permissions' => 'Aotreoù',
        'submit_create' => 'Krouiñ an implijer·ez',
        'submit_edit' => 'Enrollañ',
        'submit_password_change' => 'Kemm!',
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
        'deleteSuccess' => 'Dilamet eo bet {username}.',
    ],
];
