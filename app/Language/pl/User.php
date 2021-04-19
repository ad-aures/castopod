<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_roles' => 'Edytuj role {username}',
    'forcePassReset' => 'Wymuś resetowanie hasła',
    'ban' => 'Zablokuj',
    'unban' => 'Odblokuj',
    'delete' => 'Usuń',
    'create' => 'Nowy użytkownik',
    'view' => 'Informacje o {username}',
    'all_users' => 'Wszyscy użytkownicy',
    'list' => [
        'user' => 'Użytkownik',
        'roles' => 'Role',
        'banned' => 'Zablokowano?',
    ],
    'form' => [
        'email' => 'Adres e-mail',
        'username' => 'Nazwa użytkownika',
        'password' => 'Hasło',
        'new_password' => 'Nowe hasło',
        'roles' => 'Role',
        'permissions' => 'Uprawnienia',
        'submit_create' => 'Utwórz użytkownika',
        'submit_edit' => 'Zapisz',
        'submit_password_change' => 'Zmień! ',
    ],
    'roles' => [
        'superadmin' => 'Super admin',
    ],
    'messages' => [
        'createSuccess' =>
            'Pomyślnie utworzono użytkownika! {username} otrzyma prośbę o zmianę hasła po pierwszym logowaniu.',
        'rolesEditSuccess' =>
            'Pomyslnie edytowano role użytkownika {username}.',
        'forcePassResetSuccess' =>
            '{username} otrzyma prośbę o zresetowanie hasła przy następnej wizycie.',
        'banSuccess' => 'Zablokowano {username}.',
        'unbanSuccess' => 'Odblokowano {username}.',
        'banSuperAdminError' =>
            '{username} jest super administratorem, nie można po prostu zablokować konta super administratora…',
        'deleteSuperAdminError' =>
            '{username} jest super administratorem, nie można po prostu usunąć konta super administratora.',
        'deleteSuccess' => 'Usunięto {username}.',
    ],
];
