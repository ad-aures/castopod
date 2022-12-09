<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => 'Contribúen ao podcast',
    'view' => "Contribución de {username} a {podcastTitle}",
    'add' => 'Engadir colaboración',
    'add_contributor' => 'Engadir unha colaboración a {0}',
    'edit_role' => 'Actualizar rol de {0}',
    'edit' => 'Editar',
    'remove' => 'Eliminar',
    'list' => [
        'username' => 'Identificador',
        'role' => 'Rol',
    ],
    'form' => [
        'user' => 'Usuaria',
        'user_placeholder' => 'Elixe unha usuaria…',
        'role' => 'Rol',
        'role_placeholder' => 'Elixe o seu rol…',
        'submit_add' => 'Engadir colaboración',
        'submit_edit' => 'Actualizar rol',
    ],
    'delete_form' => [
        'title' => 'Eliminar {contributor}',
        'disclaimer' =>
            'Vas a eliminar a {contributor} de entre as contribuíntes. Non poderá volver acceder a "{podcastTitle}".',
        'understand' => 'Enténdoo, quero eliminar a {contributor} de "{podcastTitle}"',
        'submit' => 'Eliminar',
    ],
    'messages' => [
        'editSuccess' => 'Rol cambiado correctamente!',
        'editOwnerError' => "Non podes editar a propietaria do podcast!",
        'removeOwnerError' => "Non podes eliminar a propietaria do podcast!",
        'removeSuccess' =>
            'Quitaches correctamente a {username} de {podcastTitle}',
        'alreadyAddedError' =>
            "A colaboradora que intentas engadir xa está engadida!",
    ],
];
