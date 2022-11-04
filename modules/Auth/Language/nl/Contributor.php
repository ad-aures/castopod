<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => 'Podcast bijdragers',
    'view' => "Bijdrage van {username} aan {podcastTitle}",
    'add' => 'Voeg bijdrager toe',
    'add_contributor' => 'Voeg een bijdrager toe voor {0}',
    'edit_role' => 'Rol bijwerken voor {0}',
    'edit' => 'Bewerken',
    'remove' => 'Verwijder',
    'list' => [
        'username' => 'Gebruikersnaam',
        'role' => 'Rol',
    ],
    'form' => [
        'user' => 'Gebruiker',
        'user_placeholder' => 'Selecteer een gebruiker…',
        'role' => 'Rol',
        'role_placeholder' => 'Selecteer de rol…',
        'submit_add' => 'Voeg bijdrager toe',
        'submit_edit' => 'Rol bijwerken',
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
        'removeOwnerError' => "Je kunt de eigenaar van podcast niet verwijderen!",
        'removeSuccess' =>
            'Je hebt {username} met succes verwijderd van {podcastTitle}',
        'alreadyAddedError' =>
            "De bijdrager die je probeert toe te voegen, is al toegevoegd!",
    ],
];
