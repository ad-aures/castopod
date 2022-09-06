<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'persons' => 'Personas',
    'all_persons' => 'Todas las personas',
    'no_person' => 'No se encontró a nadie!',
    'create' => 'Crear una nueva persona',
    'view' => 'Ver persona',
    'edit' => 'Editar persona',
    'delete' => 'Eliminar persona',
    'messages' => [
        'createSuccess' => '¡El episodio ha sido creado correctamente!',
        'editSuccess' => '¡El episodio ha sido actualizado correctamente!',
        'deleteSuccess' => '¡La persona ha sido eliminada!',
    ],
    'form' => [
        'avatar' => 'Avatar',
        'avatar_size_hint' =>
            'El avatar debe ser cuadrado y al menos 400 px de ancho y alto.',
        'full_name' => 'Nombre completo',
        'full_name_hint' => 'Este es el nombre completo o el alias de la persona.',
        'unique_name' => 'Nombre único',
        'unique_name_hint' => 'Utilizado para URLs',
        'information_url' => 'URL de información',
        'information_url_hint' =>
            'Url a un recurso relevante de información sobre la persona, como una página de inicio o una plataforma de perfil de terceros.',
        'submit_create' => 'Crear una nueva persona',
        'submit_edit' => 'Guardar persona',
    ],
    'podcast_form' => [
        'title' => 'Administrar personas',
        'add_section_title' => 'Añadir personas a este podcast',
        'add_section_subtitle' => 'Usted puede elegir varias personas y roles.',
        'persons' => 'Personas',
        'persons_hint' =>
            'Usted puede seleccionar una o varias personas con los mismos roles. Necesitas crear primero las personas.',
        'roles' => 'Roles',
        'roles_hint' =>
            'No puedes seleccionar ninguno, uno o varios roles para una persona.',
        'submit_add' => 'Añadir persona(s)',
        'remove' => 'Eliminar',
    ],
    'episode_form' => [
        'title' => 'Administrar personas',
        'add_section_title' => 'Añadir personas a este episodio',
        'add_section_subtitle' => 'Usted puede elegir varias personas y roles.',
        'persons' => 'Personas',
        'persons_hint' =>
            'Usted puede seleccionar una o varias personas con los mismos roles.',
        'roles' => 'Roles',
        'roles_hint' =>
            'No puedes seleccionar ninguno, uno o varios roles para una persona.',
        'submit_add' => 'Añadir persona(s)',
        'remove' => 'Eliminar',
    ],
    'credits' => 'Créditos',
];
