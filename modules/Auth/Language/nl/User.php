<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_role' => "Rol van {username} wijzigen",
    'ban' => 'Blokkeren',
    'unban' => 'Deblokkeren',
    'delete' => 'Verwijderen',
    'create' => 'Nieuwe gebruiker',
    'view' => "Info van {username}",
    'all_users' => 'Alle gebruikers',
    'list' => [
        'user' => 'Gebruiker',
        'role' => 'Rol',
        'banned' => 'Geblokkeerd?',
    ],
    'form' => [
        'email' => 'E-mail',
        'username' => 'Gebruikersnaam',
        'password' => 'Wachtwoord',
        'new_password' => 'Nieuw Wachtwoord',
        'role' => 'Rol',
        'roles' => 'Rollen',
        'permissions' => 'Rechten',
        'submit_create' => 'Gebruiker aanmaken',
        'submit_edit' => 'Opslaan',
        'submit_password_change' => 'Wijzigen!',
    ],
    'delete_form' => [
        'title' => 'Verwijder {user}',
        'disclaimer' =>
            "Je staat op het punt {user} permanent te verwijderen. Deze zal geen toegang meer hebben tot de beheerdersomgeving.",
        'understand' => 'Ik begrijp het, ik wil {user} permanent verwijderen',
        'submit' => 'Verwijderen',
    ],
    'messages' => [
        'createSuccess' =>
            'Gebruiker succesvol aangemaakt! Een welkomsmail is naar {username} verzonden met een inloglink, bij de eerste authenticatie zal er om een wachtwoordreset gevraagd worden.',
        'roleEditSuccess' =>
            "De rollen van {username} zijn succesvol bijgewerkt.",
        'banSuccess' => '{username} is geblokkeerd.',
        'unbanSuccess' => '{username} is gedeblokkeerd.',
        'editOwnerError' =>
            '{username} is de instance eigenaar, men raakt niet zomaar de eigenaar aan…',
        'banSuperAdminError' =>
            '{username} is een super beheerder, men raakt niet zomaar een super beheerder aan…',
        'deleteOwnerError' =>
            '{username} is de instance eigenaar, men verwijderd niet zomaar de eigenaar…',
        'deleteSuperAdminError' =>
            '{username} is een superadmin, men verwijderd niet zomaar een superadmin…',
        'deleteSuccess' => '{username} is verwijderd.',
    ],
];
