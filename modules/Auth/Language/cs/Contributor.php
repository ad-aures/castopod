<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => 'Přispěvatelé podcastu',
    'view' => "Příspěvek {username} do {podcastTitle}",
    'add' => 'Přidat přispěvatele',
    'add_contributor' => 'Přidat přispěvatele pro {0}',
    'edit_role' => 'Aktualizovat roli pro {0}',
    'edit' => 'Upravit',
    'remove' => 'Odstranit',
    'list' => [
        'username' => 'Uživatelské jméno',
        'role' => 'Role',
    ],
    'form' => [
        'user' => 'Uživatel',
        'user_placeholder' => 'Vyberte uživatele…',
        'role' => 'Role',
        'role_placeholder' => 'Vybrat roli…',
        'submit_add' => 'Přidat přispěvatele',
        'submit_edit' => 'Aktualizovat roli',
    ],
    'delete_form' => [
        'title' => 'Odebrat {contributor}',
        'disclaimer' =>
            'Chystáte se odebrat {contributor} z přispěvatelů. Už nebudou mít přístup k "{podcastTitle}".',
        'understand' => 'Chápu, chci odstranit {contributor} z "{podcastTitle}"',
        'submit' => 'Odstranit',
    ],
    'messages' => [
        'editSuccess' => 'Role úspěšně změněna!',
        'editOwnerError' => "Vlastníka podcastu nelze upravovat!",
        'removeOwnerError' => "Vlastníka podcastu nelze odstranit!",
        'removeSuccess' =>
            'Úspěšně jste odstranili {username} z {podcastTitle}',
        'alreadyAddedError' =>
            "Přispěvatel, který se pokoušíte přidat, již byl přidán!",
    ],
];
