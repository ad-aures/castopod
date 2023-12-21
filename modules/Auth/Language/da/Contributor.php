<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => 'Podcast bidragsydere',
    'view' => "{username}s bidrag til {podcastTitle}",
    'add' => 'Tilføj bidragyder',
    'add_contributor' => 'Tilføj bidragyder til {0}',
    'edit_role' => 'Opdatér rolle for {0}',
    'edit' => 'Redigér',
    'remove' => 'Fjern',
    'list' => [
        'username' => 'Brugernavn',
        'role' => 'Rolle',
    ],
    'form' => [
        'user' => 'Bruger',
        'user_placeholder' => 'Vælg en bruger…',
        'role' => 'Rolle',
        'role_placeholder' => 'Vælg dens rolle…',
        'submit_add' => 'Tilføj bidragyder',
        'submit_edit' => 'Opdatér rolle',
    ],
    'delete_form' => [
        'title' => 'Fjern {contributor}',
        'disclaimer' =>
            'Du er ved at fjerne {contributor} fra bidragydere. De vil ikke længere kunne få adgang til "{podcastTitle}".',
        'understand' => 'Jeg forstår, jeg vil fjerne {contributor} fra "{podcastTitle}"',
        'submit' => 'Fjern',
    ],
    'messages' => [
        'editSuccess' => 'Rolle ændret!',
        'editOwnerError' => "Du kan ikke redigere podcast-ejeren!",
        'removeOwnerError' => "Du kan ikke fjerne podcast-ejeren!",
        'removeSuccess' =>
            'Du har fjernet {username} fra {podcastTitle}',
        'alreadyAddedError' =>
            "Den bidragsyder, du forsøger at tilføje, er allerede blevet tilføjet!",
    ],
];
