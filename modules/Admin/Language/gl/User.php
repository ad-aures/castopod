<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_roles' => "Editar os roles de {username}",
    'forcePassReset' => 'Forzar restablecemento do contrasinal',
    'ban' => 'Vetar',
    'unban' => 'Retirar veto',
    'delete' => 'Eliminar',
    'create' => 'Nova usuaria',
    'view' => "Info de {username}",
    'all_users' => 'Tódalas usuarias',
    'list' => [
        'user' => 'Usuaria',
        'roles' => 'Roles',
        'banned' => 'Vetada?',
    ],
    'form' => [
        'email' => 'Email',
        'username' => 'Identificador',
        'password' => 'Contrasinal',
        'new_password' => 'Novo contrasinal',
        'roles' => 'Roles',
        'permissions' => 'Permisos',
        'submit_create' => 'Crear usuaria',
        'submit_edit' => 'Gardar',
        'submit_password_change' => 'Cambiar!',
    ],
    'roles' => [
        'superadmin' => 'Super admin',
    ],
    'messages' => [
        'createSuccess' =>
            'Usuaria creada correctamente! Váiselle pedir a {username} que cambie o seu contrasinal após o primeiro acceso.',
        'rolesEditSuccess' =>
            "{username}'s roles have been successfully updated.",
        'forcePassResetSuccess' =>
            '{username} will be prompted with a password reset upon next visit.',
        'banSuccess' => '{username} has been banned.',
        'unbanSuccess' => '{username} has been unbanned.',
        'banSuperAdminError' =>
            '{username} is a superadmin, one does not simply ban a superadmin…',
        'deleteSuperAdminError' =>
            '{username} is a superadmin, one does not simply delete a superadmin…',
        'deleteSuccess' => '{username} has been deleted.',
    ],
];
