<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => 'Twórcy podcastu',
    'view' => 'Wkład {username} w {podcastName}',
    'add' => 'Dodaj twórcę',
    'add_contributor' => 'Dodaj twórcę dla {0}',
    'edit_role' => 'Zaktualizowano rolę {0}',
    'edit' => 'Edytuj',
    'remove' => 'Usuń',
    'list' => [
        'username' => 'Nazwa użytkownika',
        'role' => 'Rola',
    ],
    'form' => [
        'user' => 'Użytkownik',
        'role' => 'Rola',
        'submit_add' => 'Dodaj twórcę',
        'submit_edit' => 'Aktualizuj rolę',
    ],
    'roles' => [
        'podcast_admin' => 'Administrator podcastu',
    ],
    'messages' => [
        'removeOwnerContributorError' => 'Nie możesz usunąć właściciela podcastu!',
        'removeContributorSuccess' =>
            'Pomyślnie usunięto {username} z {podcastTitle}',
        'alreadyAddedError' =>
            'Twórca którego chcesz dodać już został dodany!',
    ],
];
