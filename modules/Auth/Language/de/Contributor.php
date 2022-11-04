<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => 'Podcast-Administratoren',
    'view' => "{username}'s Administration von {podcastTitle}",
    'add' => 'Adminstrator zufügen',
    'add_contributor' => 'Administrator zufügen für {0}',
    'edit_role' => 'Rolle aktualisieren für {0}',
    'edit' => 'Bearbeiten',
    'remove' => 'Entfernen',
    'list' => [
        'username' => 'Benutzername',
        'role' => 'Rolle',
    ],
    'form' => [
        'user' => 'Benutzer',
        'user_placeholder' => 'Benutzer auswählen…',
        'role' => 'Rolle',
        'role_placeholder' => 'Rolle auswählen…',
        'submit_add' => 'Administrator zufügen',
        'submit_edit' => 'Rolle aktualisieren',
    ],
    'delete_form' => [
        'title' => 'Remove {contributor}',
        'disclaimer' =>
            'You are about to remove {contributor} from contributors. They will not be able to access "{podcastTitle}" anymore.',
        'understand' => 'I understand, I want to remove {contributor} from "{podcastTitle}"',
        'submit' => 'Remove',
    ],
    'messages' => [
        'editSuccess' => 'Role successfully changed!',
        'editOwnerError' => "You can't edit the podcast owner!",
        'removeOwnerError' => "Der Podcast Inhaber kann nicht entfernt werden!",
        'removeSuccess' =>
            '{username} wurde von {podcastTitle} entfernt',
        'alreadyAddedError' =>
            "Der Adminstrator wurde bereits zugefügt!",
    ],
];
