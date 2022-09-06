<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => 'Col·laboradors del podcast',
    'view' => "Aportació de {username} a {podcastTitle}",
    'add' => 'Afegir un col·laborador',
    'add_contributor' => 'Afegir un col·laborador de {0}',
    'edit_role' => 'Actualitzar el rol de {0}',
    'edit' => 'Editar',
    'remove' => 'Eliminar',
    'list' => [
        'username' => 'Nom de l\'usuari',
        'role' => 'Rol',
    ],
    'form' => [
        'user' => 'Usuari',
        'user_placeholder' => 'Seleccionar un usuari…',
        'role' => 'Rol',
        'role_placeholder' => 'Seleccionar el seu rol…',
        'submit_add' => 'Afegir un col·laborador',
        'submit_edit' => 'Actualitzar el rol',
    ],
    'roles' => [
        'podcast_admin' => 'Administrador del podcast',
    ],
    'messages' => [
        'removeOwnerError' => "No podeu eliminar al propietari del podcast!",
        'removeSuccess' =>
            'S\'ha eliminat a {username} de {podcastTitle}',
        'alreadyAddedError' =>
            "El col·laborador que esteu intentant afegir ja ha estat afegit!",
    ],
];
