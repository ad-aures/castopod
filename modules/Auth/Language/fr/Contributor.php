<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => 'Contributeurs du podcast',
    'view' => "Contribution de {username} à {podcastTitle}",
    'add' => 'Ajouter un contributeur',
    'add_contributor' => 'Ajouter un contributeur pour {0}',
    'edit_role' => 'Modifier le rôle de {0}',
    'edit' => 'Modifier',
    'remove' => 'Supprimer',
    'list' => [
        'username' => 'Identifiant',
        'role' => 'Rôle',
    ],
    'form' => [
        'user' => 'Utilisateur',
        'user_placeholder' => 'Sélectionnez un utilisateur…',
        'role' => 'Rôle',
        'role_placeholder' => 'Sélectionnez son rôle…',
        'submit_add' => 'Ajouter le contributeur',
        'submit_edit' => 'Mettre à jour le rôle',
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
        'removeOwnerError' => "Vous ne pouvez pas retirer le propriétaire du podcast !",
        'removeSuccess' =>
            'Vous avez retiré {username} de {podcastTitle}',
        'alreadyAddedError' =>
            "Le contributeur que vous essayez d’ajouter est déjà présent.",
    ],
];
