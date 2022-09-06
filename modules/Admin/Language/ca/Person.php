<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'persons' => 'Persones',
    'all_persons' => 'Totes les persones',
    'no_person' => 'No s\'ha trobat ningú.',
    'create' => 'Crear una persona',
    'view' => 'Veure la persona',
    'edit' => 'Editar la persona',
    'delete' => 'Esborrar la persona',
    'messages' => [
        'createSuccess' => 'S\'ha creat la persona.',
        'editSuccess' => 'S\'ha actualitzat la persona.',
        'deleteSuccess' => 'S\'ha esborrat la persona.',
    ],
    'form' => [
        'avatar' => 'Avatar',
        'avatar_size_hint' =>
            'L\'avatar ha de ser quadrat i com a mínim de 400 px d\'amplada i alçada.',
        'full_name' => 'Nom complet',
        'full_name_hint' => 'Aquest és el nom complet o àlies de la persona.',
        'unique_name' => 'Nom únic',
        'unique_name_hint' => 'Emprat en adreces URLs',
        'information_url' => 'URL informativa',
        'information_url_hint' =>
            'URL d\'un recurs d\'informació rellevant sobre la persona, com ara una pàgina d\'inici o un perfil a una plataforma de tercers.',
        'submit_create' => 'Crear una persona',
        'submit_edit' => 'Desar canvis de la persona',
    ],
    'podcast_form' => [
        'title' => 'Administrar persones',
        'add_section_title' => 'Afegir una persona a aquest podcast',
        'add_section_subtitle' => 'Podeu triar diverses persones i rols.',
        'persons' => 'Persones',
        'persons_hint' =>
            'Podeu seleccionar una o diverses persones amb les mateixes funcions. Primer heu de crear les persones.',
        'roles' => 'Rols',
        'roles_hint' =>
            'Podeu seleccionar cap, un o diversos rols per a una persona.',
        'submit_add' => 'Afegir  persones',
        'remove' => 'Eliminar',
    ],
    'episode_form' => [
        'title' => 'Administrar persones',
        'add_section_title' => 'Afegir persones a aquest episodi',
        'add_section_subtitle' => 'Podeu triar diverses persones i rols.',
        'persons' => 'Persones',
        'persons_hint' =>
            'Podeu seleccionar una o diverses persones amb les mateixes funcions. Primer heu de crear les persones.',
        'roles' => 'Rols',
        'roles_hint' =>
            'Podeu seleccionar cap, un o diversos rols per a una persona.',
        'submit_add' => 'Afegir  persones',
        'remove' => 'Eliminar',
    ],
    'credits' => 'Crèdits',
];
