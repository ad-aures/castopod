<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => 'Podcast contributors',
    'view' => '{username}\'s contribution to {podcastName}',
    'add' => 'Add contributor',
    'add_contributor' => 'Add a contributor for {0}',
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
        'submit_add' => 'Add contributor',
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
            'The contributor you\'re trying to add has already been added!',
    ],
];
