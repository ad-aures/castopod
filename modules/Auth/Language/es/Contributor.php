<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => 'Colaboradores de Podcast',
    'view' => "Contribución de {username} a {podcastTitle}",
    'add' => 'Añadir colaborador',
    'add_contributor' => 'Agregar contrato a {0}',
    'edit_role' => 'Actualizar rol para {0}',
    'edit' => 'Editar',
    'remove' => 'Eliminar',
    'list' => [
        'username' => 'Nombre de usuario',
        'role' => 'Cargo',
    ],
    'form' => [
        'user' => 'Usuario',
        'user_placeholder' => 'Seleccione un usuario…',
        'role' => 'Cargo',
        'role_placeholder' => 'Seleccionar su rol…',
        'submit_add' => 'Añadir colaborador',
        'submit_edit' => 'Actualizar Cargo',
    ],
    'delete_form' => [
        'title' => 'Remove {contributor}',
        'disclaimer' =>
            'You are about to remove {contributor} from contributors. They will not be able to access "{podcastTitle}" anymore.',
        'understand' => 'I understand, I want to remove {contributor} from "{podcastTitle}"',
        'submit' => 'Remove',
    ],
    'messages' => [
        'editSuccess' => 'Role successfully changed!',
        'editOwnerError' => "You can't edit the podcast owner!",
        'removeOwnerError' => "¡No puedes eliminar al dueño del podcast!",
        'removeSuccess' =>
            'Has eliminado con éxito a {username} de {podcastTitle}',
        'alreadyAddedError' =>
            "¡El colaborador que estás intentando añadir ya ha sido añadido!",
    ],
];
