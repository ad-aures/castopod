<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_role' => "Die Rolle(n) von {username} bearbeiten",
    'ban' => 'Sperren',
    'unban' => 'Entsperren',
    'delete' => 'Löschen',
    'create' => 'Neuer Benutzer',
    'view' => "{username}-Infos",
    'all_users' => 'Alle Benutzer',
    'list' => [
        'user' => 'Benutzer',
        'role' => 'Rolle',
        'banned' => 'Gesperrt?',
    ],
    'form' => [
        'email' => 'E-mail',
        'username' => 'Benutzername',
        'password' => 'Passwort',
        'new_password' => 'Neues Passwort',
        'role' => 'Rolle',
        'roles' => 'Rollen',
        'permissions' => 'Berechtigungen',
        'submit_create' => 'Benutzer erstellen',
        'submit_edit' => 'Speichern',
        'submit_password_change' => 'Verändern!',
    ],
    'delete_form' => [
        'title' => '{user} löschen',
        'disclaimer' =>
            "Sie sind dabei {user} dauerhaft zu löschen. Es wird für den Benutzer nicht mehr möglich sein, den Admin-Bereich zu nutzen.",
        'understand' => 'Ich verstehe, Ich will {user} dauerhaft löschen',
        'submit' => 'Löschen',
    ],
    'messages' => [
        'createSuccess' =>
            'Benutzer wurde erfolgreich erstellt! {username} wird bei der ersten Authentifizierung zu einer Passwortzurücksetzung aufgefordert.',
        'roleEditSuccess' =>
            "{username}'s Rollen wurden erfolgreich aktualisiert.",
        'banSuccess' => '{username} wurde gebannt.',
        'unbanSuccess' => '{username} wurde entbannt.',
        'editOwnerError' =>
            '{username} ist Eigentümer der Instanz, Eigentümer können nicht gelöscht werden…',
        'banSuperAdminError' =>
            '{username} ist ein Superadmin, man bannt nicht einfach einen Superadmin…',
        'deleteOwnerError' =>
            '{username} ist Eigentümer der Instanz, Eigentümer können nicht gelöscht werden…',
        'deleteSuperAdminError' =>
            '{username} ist ein Superadmin, man löscht nicht einfach einen Superadmin…',
        'deleteSuccess' => '{username} wurde gelöscht.',
    ],
];
