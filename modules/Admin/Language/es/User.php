<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_roles' => "Editar rol de {username}",
    'forcePassReset' => 'Forzar el reseteo de la contraseña',
    'ban' => 'Banear',
    'unban' => 'Desbanear',
    'delete' => 'Borrar',
    'create' => 'Nuevo usuario',
    'view' => "Información de {username}",
    'all_users' => 'Todos los usuarios',
    'list' => [
        'user' => 'Usuario',
        'roles' => 'Roles',
        'banned' => '¿Baneado?',
    ],
    'form' => [
        'email' => 'Correo electrónico',
        'username' => 'Nombre de usuario',
        'password' => 'Contraseña',
        'new_password' => 'Nueva Contraseña',
        'roles' => 'Roles',
        'permissions' => 'Permisos',
        'submit_create' => 'Crear usuario',
        'submit_edit' => 'Guardar',
        'submit_password_change' => '¡Cambiar!',
    ],
    'roles' => [
        'superadmin' => 'Super administrador',
    ],
    'messages' => [
        'createSuccess' =>
            '¡Usuario creado con éxito! Se le pedirá a {username} que restablezca la contraseña en la primera autenticación.',
        'rolesEditSuccess' =>
            "Los roles de {username} se han actualizado correctamente.",
        'forcePassResetSuccess' =>
            'Se pedirá a {username} que restablezca su contraseña en la próxima visita.',
        'banSuccess' => '{username} ha sido baneado.',
        'unbanSuccess' => '{username} ha sido desbaneado.',
        'banSuperAdminError' =>
            '{username} es un superadmin, no puedes banear a un superadministrador…',
        'deleteSuperAdminError' =>
            '{username} es un superadmin, no puedes borrar a un superadministrador…',
        'deleteSuccess' => '{username} ha sido eliminado.',
    ],
];
