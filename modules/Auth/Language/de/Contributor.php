<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => 'Podcast-Administratoren',
    'view' => "{username}'s Mitwirkung an {podcastTitle}",
    'add' => 'Mitwirkenden zufügen',
    'add_contributor' => 'Mitwirkenden zufügen für {0}',
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
        'title' => '{contributor} entfernen',
        'disclaimer' =>
            'Sie sind dabei, {contributor} von den Mitwirkenden zu entfernen. Es wird kein Zugriff mehr auf "{podcastTitle}" möglich sein.',
        'understand' => 'Ich verstehe, ich möchte {contributor} von "{podcastTitle}" entfernen',
        'submit' => 'Entfernen',
    ],
    'messages' => [
        'editSuccess' => 'Rolle erfolgreich geändert!',
        'editOwnerError' => "Sie können den Podcast-Besitzer nicht verändern!",
        'removeOwnerError' => "Der Podcast Inhaber kann nicht entfernt werden!",
        'removeSuccess' =>
            '{username} wurde von {podcastTitle} entfernt',
        'alreadyAddedError' =>
            "Der Adminstrator wurde bereits zugefügt!",
    ],
];
