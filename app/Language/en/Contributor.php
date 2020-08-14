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
    'edit_role' => 'Update role for {0}',
    'edit' => 'Edit',
    'remove' => 'Remove',
    'form' => [
        'user' => 'User',
        'role' => 'Role',
        'submit_add' => 'Add contributor',
        'submit_edit' => 'Update role',
    ],
    'roles' => [
        'podcast_admin' => 'Podcast admin',
    ],
    'messages' => [
        'removeOwnerContributorError' => 'You can\'t remove the podcast owner!',
        'removeContributorSuccess' =>
            'You have successfully removed {username} from {podcastTitle}',
        'alreadyAddedError' =>
            'The contributor you\'re trying to add has already been added!',
    ],
];
