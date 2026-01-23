<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_role' => "Upravit roli {username}",
    'ban' => 'Zabanovat',
    'unban' => 'Odbanovat',
    'delete' => 'Smazat',
    'create' => 'Nový uživatel',
    'view' => "Informace o {username}",
    'all_users' => 'Všichni uživatelé',
    'list' => [
        'user' => 'Uživatel',
        'role' => 'Role',
        'banned' => 'Zabanován?',
    ],
    'form' => [
        'email' => 'E-mail',
        'username' => 'Uživatelské jméno',
        'password' => 'Heslo',
        'new_password' => 'Nové heslo',
        'role' => 'Role',
        'roles' => 'Role',
        'permissions' => 'Oprávnění',
        'submit_create' => 'Vytvořit uživatele',
        'submit_edit' => 'Uložit',
        'submit_password_change' => 'Změnit!',
    ],
    'delete_form' => [
        'title' => 'Odstranit {user}',
        'disclaimer' =>
            "Chystáte se odstranit {user} trvale. Už nebude mít přístup do administrátorské oblasti.",
        'understand' => 'Chápu, chci trvale odstranit {user}',
        'submit' => 'Smazat',
    ],
    'messages' => [
        'createSuccess' =>
            'Uživatel byl úspěšně vytvořen! Uvítací e-mail byl odeslán {username} s odkazem pro přihlášení, bude požádán o obnovení hesla při prvním ověření.',
        'roleEditSuccess' =>
            "Role {username} byly úspěšně aktualizovány.",
        'banSuccess' => 'Uživatel {username} byl zabanován.',
        'unbanSuccess' => 'Uživatel {username} byl odblokován.',
        'editOwnerError' =>
            '{username} je vlastníkem instance, to přece nejde…',
        'banSuperAdminError' =>
            '{username} je superadmin, to se nesmí…',
        'deleteOwnerError' =>
            '{username} je vlastníkem instance, člověk prostě neodstraní vlastníka…',
        'deleteSuperAdminError' =>
            '{username} je superadmin, to neni dobrý nápad…',
        'deleteSuccess' => '{username} byl smazán.',
    ],
];
