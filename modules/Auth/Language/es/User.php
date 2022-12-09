<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_role' => "Editar rol de {username}",
    'ban' => 'Banear',
    'unban' => 'Desbanear',
    'delete' => 'Borrar',
    'create' => 'Nuevo usuario',
    'view' => "Información de {username}",
    'all_users' => 'Todos los usuarios',
    'list' => [
        'user' => 'Usuario',
        'role' => 'Rol',
        'banned' => '¿Baneado?',
    ],
    'form' => [
        'email' => 'Correo electrónico',
        'username' => 'Nombre de usuario',
        'password' => 'Contraseña',
        'new_password' => 'Nueva Contraseña',
        'role' => 'Rol',
        'roles' => 'Roles',
        'permissions' => 'Permisos',
        'submit_create' => 'Crear usuario',
        'submit_edit' => 'Guardar',
        'submit_password_change' => '¡Cambiar!',
    ],
    'delete_form' => [
        'title' => 'Eliminar {user}',
        'disclaimer' =>
            "Estás a punto de eliminar {user} permanentemente. Ya no podrán acceder al área de administración.",
        'understand' => 'Entiendo, quiero eliminar {user} permanentemente',
        'submit' => 'Eliminar',
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
            '{username} es el propietario de la instancia, uno no simplemente elimina al propietario…',
        'deleteSuperAdminError' =>
            '{username} es un superadmin, no puedes borrar a un superadministrador…',
        'deleteSuccess' => '{username} ha sido eliminado.',
    ],
];
