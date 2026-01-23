<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_roles' => "Upravit role {username}",
    'forcePassReset' => 'Vynutit obnovení hesla',
    'ban' => 'Ban',
    'unban' => 'Odbanovat',
    'delete' => 'Smazat',
    'create' => 'Nový uživatel',
    'view' => "Informace o {username}",
    'all_users' => 'Všichni uživatelé',
    'list' => [
        'user' => 'Uživatel',
        'roles' => 'Role',
        'banned' => 'Zabanován?',
    ],
    'form' => [
        'email' => 'E-mail',
        'username' => 'Uživatelské jméno',
        'password' => 'Heslo',
        'new_password' => 'Nové heslo',
        'roles' => 'Role',
        'permissions' => 'Oprávnění',
        'submit_create' => 'Vytvořit uživatele',
        'submit_edit' => 'Uložit',
        'submit_password_change' => 'Změnit!',
    ],
    'roles' => [
        'superadmin' => 'Super admin',
    ],
    'messages' => [
        'createSuccess' =>
            'Uživatel byl úspěšně vytvořen! {username} bude požádán o obnovení hesla při prvním ověření.',
        'rolesEditSuccess' =>
            "Role {username} byly úspěšně aktualizovány.",
        'forcePassResetSuccess' =>
            '{username} bude požádán o obnovení hesla při příští návštěvě.',
        'banSuccess' => '{username} byl zabanován.',
        'unbanSuccess' => '{username} byl odbanován.',
        'editOwnerError' =>
            '{username} je vlastníkem instance, nemůžete upravit role.',
        'banSuperAdminError' =>
            '{username} je superadmin, ban superadmina asi neni to pravé ořechové…',
        'deleteSuperAdminError' =>
            '{username} je superadmin, ostranit jej neni dobrý nápad…',
        'deleteSuccess' => '{username} byl smazán.',
    ],
];
