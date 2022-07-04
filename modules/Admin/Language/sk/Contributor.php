<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => 'Podcast contributors',
    'view' => "{username}'s contribution to {podcastTitle}",
    'add' => 'Pridať prispievateľa',
    'add_contributor' => 'Pridať prispievateľa pre {0}',
    'edit_role' => 'Upraviť rolu pre {0}',
    'edit' => 'Upraviť',
    'remove' => 'Odstrániť',
    'list' => [
        'username' => 'Užívateľské meno',
        'role' => 'Rola',
    ],
    'form' => [
        'user' => 'Užívateľ',
        'user_placeholder' => 'Vybrať užívateľa…',
        'role' => 'Rola',
        'role_placeholder' => 'Vybrať jeho úlohu…',
        'submit_add' => 'Pridať prispievateľa',
        'submit_edit' => 'Update role',
    ],
    'roles' => [
        'podcast_admin' => 'Podcast admin',
    ],
    'messages' => [
        'removeOwnerError' => "You can't remove the podcast owner!",
        'removeSuccess' =>
            'You have successfully removed {username} from {podcastTitle}',
        'alreadyAddedError' =>
            "The contributor you're trying to add has already been added!",
    ],
];
