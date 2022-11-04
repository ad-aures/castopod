<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_role' => "Edit {username}'s role",
    'ban' => 'Steng ute',
    'unban' => 'Slepp inn att',
    'delete' => 'Slett',
    'create' => 'Ny brukar',
    'view' => "{username} sin informasjon",
    'all_users' => 'Alle brukarane',
    'list' => [
        'user' => 'Brukar',
        'role' => 'Role',
        'banned' => 'Utestengd?',
    ],
    'form' => [
        'email' => 'Epost',
        'username' => 'Brukarnamn',
        'password' => 'Passord',
        'new_password' => 'Nytt passord',
        'role' => 'Role',
        'roles' => 'Roller',
        'permissions' => 'Løyve',
        'submit_create' => 'Lag brukar',
        'submit_edit' => 'Lagre',
        'submit_password_change' => 'Endre!',
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
            'Brukaren er oppretta! {username} vil få spørsmål om å endra passord fyrste gong hen loggar inn.',
        'roleEditSuccess' =>
            "Rollene til {username} er oppdaterte.",
        'banSuccess' => '{username} er utestengd.',
        'unbanSuccess' => '{username} fekk sleppa inn att.',
        'editOwnerError' =>
            '{username} is the instance owner, you cannot edit its roles.',
        'banSuperAdminError' =>
            '{username} er superstyrar, og du stengjer ikkje ute ein superstyrar…',
        'deleteOwnerError' =>
            '{username} is the instance owner, one does not simply delete the owner…',
        'deleteSuperAdminError' =>
            '{username} er superstyrar, og du slettar ikkje ein superstyrar…',
        'deleteSuccess' => '{username} er sletta.',
    ],
];
