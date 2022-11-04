<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => 'Συντελεστές Podcast',
    'view' => "Ο χρήστης {username} συνείσφερε στο {podcastTitle}",
    'add' => 'Προσθήκη συντελεστή',
    'add_contributor' => 'Προσθέστε έναν συνεισφέροντα για {0}',
    'edit_role' => 'Ενημέρωση ρόλου για {0}',
    'edit' => 'Επεξεργασία',
    'remove' => 'Διαγραφή',
    'list' => [
        'username' => 'Όνομα Χρήστη',
        'role' => 'Ρόλος',
    ],
    'form' => [
        'user' => 'Χρήστης',
        'user_placeholder' => 'Επιλέξτε χρήστη…',
        'role' => 'Ρόλος',
        'role_placeholder' => 'Επιλέξτε το ρόλο του χρήστη…',
        'submit_add' => 'Προσθήκη συντελεστή',
        'submit_edit' => 'Ενημέρωση ρόλου',
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
        'removeOwnerError' => "Δεν μπορείτε να καταργήσετε τον ιδιοκτήτη podcast!",
        'removeSuccess' =>
            'Έχετε αφαιρέσει με επιτυχία τον χρήστη {username} από το {podcastTitle}',
        'alreadyAddedError' =>
            "Ο συνεισφέροντας που προσπαθείτε να προσθέσετε έχει ήδη προστεθεί!",
    ],
];
