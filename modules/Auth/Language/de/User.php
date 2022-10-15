<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_roles' => "Bearbeite {username}'s Rollen",
    'ban' => 'Bannen',
    'unban' => 'Entbannen',
    'delete' => 'Löschen',
    'create' => 'Neuer Benutzer',
    'view' => "{username}'s Info",
    'all_users' => 'Alle Benutzer',
    'list' => [
        'user' => 'Benutzer',
        'roles' => 'Rollen',
        'banned' => 'Gebannt?',
    ],
    'form' => [
        'email' => 'E-mail',
        'username' => 'Benutzername',
        'password' => 'Passwort',
        'new_password' => 'Neues Passwort',
        'roles' => 'Rollen',
        'permissions' => 'Berechtigungen',
        'submit_create' => 'Benutzer erstellen',
        'submit_edit' => 'Speichern',
        'submit_password_change' => 'Verändern!',
    ],
    'roles' => [
        'superadmin' => 'Super-Admin',
    ],
    'messages' => [
        'createSuccess' =>
            'Benutzer wurde erfolgreich erstellt! {username} wird bei der ersten Authentifizierung zu einer Passwortzurücksetzung aufgefordert.',
        'roleEditSuccess' =>
            "{username}'s Rollen wurden erfolgreich aktualisiert.",
        'banSuccess' => '{username} wurde gebannt.',
        'unbanSuccess' => '{username} wurde entbannt.',
        'editOwnerError' =>
            '{username} is the instance owner, you cannot edit its roles.',
        'banSuperAdminError' =>
            '{username} ist ein Superadmin, man bannt nicht einfach einen Superadmin…',
        'deleteSuperAdminError' =>
            '{username} ist ein Superadmin, man löscht nicht einfach einen Superadmin…',
        'deleteSuccess' => '{username} wurde gelöscht.',
    ],
];
