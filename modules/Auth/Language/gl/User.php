<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_role' => "Editar os roles de {username}",
    'ban' => 'Vetar',
    'unban' => 'Retirar veto',
    'delete' => 'Eliminar',
    'create' => 'Nova usuaria',
    'view' => "Info de {username}",
    'all_users' => 'Tódalas usuarias',
    'list' => [
        'user' => 'Usuaria',
        'role' => 'Rol',
        'banned' => 'Vetada?',
    ],
    'form' => [
        'email' => 'Email',
        'username' => 'Identificador',
        'password' => 'Contrasinal',
        'new_password' => 'Novo contrasinal',
        'role' => 'Rol',
        'roles' => 'Roles',
        'permissions' => 'Permisos',
        'submit_create' => 'Crear usuaria',
        'submit_edit' => 'Gardar',
        'submit_password_change' => 'Cambiar!',
    ],
    'delete_form' => [
        'title' => 'Eliminar {user}',
        'disclaimer' =>
            "Vas eliminar de xeito permanente a {user}. Non poderá volver a acceder á páxina de administración.",
        'understand' => 'Enténdoo, quero eliminar a {user} para sempre',
        'submit' => 'Eliminar',
    ],
    'messages' => [
        'createSuccess' =>
            'Usuaria creada correctamente! Váiselle pedir a {username} que cambie o seu contrasinal após o primeiro acceso.',
        'roleEditSuccess' =>
            "Os roles de {username} actualizáronse correctamente.",
        'banSuccess' => '{username} foi vetada.',
        'unbanSuccess' => 'Retirouse o veto sobre {username}.',
        'editOwnerError' =>
            'A instancia pertence a {username}, ti non podes editar os roles.',
        'banSuperAdminError' =>
            '{username} é superadmin, non se pode vetar a superadmin…',
        'deleteOwnerError' =>
            '{username} é dona da instancia, non se pode eliminar a propietaria…',
        'deleteSuperAdminError' =>
            '{username} é superadmin, non se pode eliminar a superadmin…',
        'deleteSuccess' => 'Eliminouse a {username}.',
    ],
];
