<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_roles' => "Kemm rolloù {username}",
    'forcePassReset' => 'Force pass reset',
    'ban' => 'Ban',
    'unban' => 'Unban',
    'delete' => 'Dilemel',
    'create' => 'Krouiñ un implijer·ez',
    'view' => "Titouroù diwar-benn {username}",
    'all_users' => 'An holl implijerien·ezed',
    'list' => [
        'user' => 'Implijer·ez',
        'roles' => 'Rolloù',
        'banned' => 'Banned?',
    ],
    'form' => [
        'email' => 'Postel',
        'username' => 'Anv implijer·ez',
        'password' => 'Ger-tremen',
        'new_password' => 'Ger-tremen nevez',
        'roles' => 'Rolloù',
        'permissions' => 'Aotreoù',
        'submit_create' => 'Krouiñ an implijer·ez',
        'submit_edit' => 'Enrollañ',
        'submit_password_change' => 'Kemm!',
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
        'editOwnerError' =>
            '{username} is the instance owner, you cannot edit its roles.',
        'banSuperAdminError' =>
            '{username} is a superadmin, one does not simply ban a superadmin…',
        'deleteSuperAdminError' =>
            '{username} is a superadmin, one does not simply delete a superadmin…',
        'deleteSuccess' => 'Dilamet eo bet {username}.',
    ],
];
