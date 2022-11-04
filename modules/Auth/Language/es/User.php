<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_role' => "Edit {username}'s role",
    'ban' => 'Banear',
    'unban' => 'Desbanear',
    'delete' => 'Borrar',
    'create' => 'Nuevo usuario',
    'view' => "Información de {username}",
    'all_users' => 'Todos los usuarios',
    'list' => [
        'user' => 'Usuario',
        'role' => 'Role',
        'banned' => '¿Baneado?',
    ],
    'form' => [
        'email' => 'Correo electrónico',
        'username' => 'Nombre de usuario',
        'password' => 'Contraseña',
        'new_password' => 'Nueva Contraseña',
        'role' => 'Role',
        'roles' => 'Roles',
        'permissions' => 'Permisos',
        'submit_create' => 'Crear usuario',
        'submit_edit' => 'Guardar',
        'submit_password_change' => '¡Cambiar!',
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
            '¡Usuario creado con éxito! Se le pedirá a {username} que restablezca la contraseña en la primera autenticación.',
        'roleEditSuccess' =>
            "Los roles de {username} se han actualizado correctamente.",
        'banSuccess' => '{username} ha sido baneado.',
        'unbanSuccess' => '{username} ha sido desbaneado.',
        'editOwnerError' =>
            '{username} is the instance owner, you cannot edit its roles.',
        'banSuperAdminError' =>
            '{username} es un superadmin, no puedes banear a un superadministrador…',
        'deleteOwnerError' =>
            '{username} is the instance owner, one does not simply delete the owner…',
        'deleteSuperAdminError' =>
            '{username} es un superadmin, no puedes borrar a un superadministrador…',
        'deleteSuccess' => '{username} ha sido eliminado.',
    ],
];
