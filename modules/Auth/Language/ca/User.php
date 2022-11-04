<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_role' => "Edit {username}'s role",
    'ban' => 'Bandejar',
    'unban' => 'Re-admetre',
    'delete' => 'Eliminar',
    'create' => 'Nou usuari',
    'view' => "Informació de {username}",
    'all_users' => 'Tots els usuaris',
    'list' => [
        'user' => 'Usuari',
        'role' => 'Role',
        'banned' => 'Bandejat?',
    ],
    'form' => [
        'email' => 'Correu electrònic',
        'username' => 'Nom de l\'usuari',
        'password' => 'Contrasenya',
        'new_password' => 'Nova contrasenya',
        'role' => 'Role',
        'roles' => 'Rols',
        'permissions' => 'Permisos',
        'submit_create' => 'Crea un usuari',
        'submit_edit' => 'Desar',
        'submit_password_change' => 'Canviat!',
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
            'S\'ha creat l\'usuari! Es demanarà a {username} un restabliment de la contrasenya durant la primera autenticació.',
        'roleEditSuccess' =>
            "S'han actualitzat correctament els rols de {username}.",
        'banSuccess' => '{username} ha estat bandejat.',
        'unbanSuccess' => '{username} ha estat desbandejat.',
        'editOwnerError' =>
            '{username} is the instance owner, you cannot edit its roles.',
        'banSuperAdminError' =>
            '{username} és un superadministrador, hom simplement no bandeja a un superadministrador...',
        'deleteOwnerError' =>
            '{username} is the instance owner, one does not simply delete the owner…',
        'deleteSuperAdminError' =>
            '{username} és un superadministrador, hom simplement no elimina a un superadministrador...',
        'deleteSuccess' => '{username} ha estat eliminat.',
    ],
];
