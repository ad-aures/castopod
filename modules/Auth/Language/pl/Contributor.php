<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => 'Kontrybutorzy podcastu',
    'view' => "Wkład {username} do {podcastTitle}",
    'add' => 'Dodaj kontrybutora',
    'add_contributor' => 'Dodaj kontrybutora do {0}',
    'edit_role' => 'Zaktualizuj rolę dla {0}',
    'edit' => 'Edytuj',
    'remove' => 'Usuń',
    'list' => [
        'username' => 'Nazwa użytkownika',
        'role' => 'Rola',
    ],
    'form' => [
        'user' => 'Użytkownik',
        'user_placeholder' => 'Wybierz użytkownika…',
        'role' => 'Rola',
        'role_placeholder' => 'Wybierz jego rolę…',
        'submit_add' => 'Dodaj kontrybutora',
        'submit_edit' => 'Zaktualizuj rolę',
    ],
    'delete_form' => [
        'title' => 'Usuń {contributor}',
        'disclaimer' =>
            'Zamierzasz usunąć {contributor} z wspierających. Nie będzie miał już mieć dostępu do "{podcastTitle}".',
        'understand' => 'Rozumiem, chcę usunąć {contributor} z "{podcastTitle}"',
        'submit' => 'Usuń',
    ],
    'messages' => [
        'editSuccess' => 'Pomyślnie zmieniono rolę!',
        'editOwnerError' => "Nie możesz edytować właściciela podcastu!",
        'removeOwnerError' => "Nie możesz usunąć właściciela podcastu!",
        'removeSuccess' =>
            'Pomyślnie usunąłeś/aś {username} z {podcastTitle}',
        'alreadyAddedError' =>
            "Kontrybutor, którego próbujesz dodać, został już dodany!",
    ],
];
