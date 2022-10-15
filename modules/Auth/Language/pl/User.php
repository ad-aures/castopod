<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_roles' => "Edytuj role użytkownika {username}",
    'ban' => 'Zablokuj',
    'unban' => 'Odblokuj',
    'delete' => 'Usuń',
    'create' => 'Nowy użytkownik',
    'view' => "Informacje użytkownika {username}",
    'all_users' => 'Wszyscy użytkownicy',
    'list' => [
        'user' => 'Użytkownik',
        'roles' => 'Role',
        'banned' => 'Zablokowany?',
    ],
    'form' => [
        'email' => 'Email',
        'username' => 'Nazwa użytkownika',
        'password' => 'Hasło',
        'new_password' => 'Nowe hasło',
        'roles' => 'Role',
        'permissions' => 'Uprawnienia',
        'submit_create' => 'Stwórz użytkownika',
        'submit_edit' => 'Zapisz',
        'submit_password_change' => 'Zmień!',
    ],
    'roles' => [
        'superadmin' => 'Superadministrator',
    ],
    'messages' => [
        'createSuccess' =>
            'Pomyślnie utworzono użytkownika! {username} zostanie poproszony o zresetowanie hasła przy pierwszym uwierzytelnieniu.',
        'roleEditSuccess' =>
            "Role {username} zostały pomyślnie zaktualizowane.",
        'banSuccess' => '{username} został zablokowany.',
        'unbanSuccess' => '{username} został odblokowany.',
        'editOwnerError' =>
            '{username} is the instance owner, you cannot edit its roles.',
        'banSuperAdminError' =>
            '{username} jest superadministratorem, nie można po prostu zablokować superadministratora…',
        'deleteSuperAdminError' =>
            '{username} jest superadministratorem, nie można po prostu usunąć superadministratora…',
        'deleteSuccess' => '{username} został usunięty.',
    ],
];
