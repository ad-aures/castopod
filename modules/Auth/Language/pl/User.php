<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_role' => "Edytuj role użytkownika {username}",
    'ban' => 'Zablokuj',
    'unban' => 'Odblokuj',
    'delete' => 'Usuń',
    'create' => 'Nowy użytkownik',
    'view' => "Informacje użytkownika {username}",
    'all_users' => 'Wszyscy użytkownicy',
    'list' => [
        'user' => 'Użytkownik',
        'role' => 'Rola',
        'banned' => 'Zablokowany?',
    ],
    'form' => [
        'email' => 'Email',
        'username' => 'Nazwa użytkownika',
        'password' => 'Hasło',
        'new_password' => 'Nowe hasło',
        'role' => 'Rola',
        'roles' => 'Role',
        'permissions' => 'Uprawnienia',
        'submit_create' => 'Stwórz użytkownika',
        'submit_edit' => 'Zapisz',
        'submit_password_change' => 'Zmień!',
    ],
    'delete_form' => [
        'title' => 'Usuń użytkownika {user}',
        'disclaimer' =>
            "Zamierzasz usunąć {user} na stałe. Nie będą już mogli uzyskać dostępu do obszaru administratora.",
        'understand' => 'Rozumiem, chcę trwale usunąć {user}',
        'submit' => 'Usuń',
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
        'deleteOwnerError' =>
            '{username} jest właścicielem instancji, nie można usunąć właściciela…',
        'deleteSuperAdminError' =>
            '{username} jest superadministratorem, nie można po prostu usunąć superadministratora…',
        'deleteSuccess' => '{username} został usunięty.',
    ],
];
