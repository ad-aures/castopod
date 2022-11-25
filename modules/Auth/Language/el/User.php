<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_role' => "Επεξεργασία ρόλων {username}",
    'ban' => 'Αποκλεισμός',
    'unban' => 'Κατάργηση αποκλεισμού',
    'delete' => 'Διαγραφή',
    'create' => 'Νέος χρήστης',
    'view' => "πληροφορίες του {username}",
    'all_users' => 'Όλοι οι χρήστες',
    'list' => [
        'user' => 'Χρήστης',
        'role' => 'Ρόλος',
        'banned' => 'Αποκλεισμένος;',
    ],
    'form' => [
        'email' => 'Ηλεκτρονικό ταχυδρομείο',
        'username' => 'Όνομα Χρήστη',
        'password' => 'Κωδικόs πρόσβασης',
        'new_password' => 'Νέος Κωδικός Πρόσβασης',
        'role' => 'Ρόλος',
        'roles' => 'Ρόλοι',
        'permissions' => 'Δικαιώματα',
        'submit_create' => 'Δημιουργία χρήστη',
        'submit_edit' => 'Αποθήκευση',
        'submit_password_change' => 'Αλλαγή!',
    ],
    'delete_form' => [
        'title' => 'Διαγραφή {user}',
        'disclaimer' =>
            "Πρόκειται να διαγράψετε το {user} οριστικά. Δεν θα μπορούν πλέον να έχουν πρόσβαση στην περιοχή διαχείρισης.",
        'understand' => 'Καταλαβαίνω, θέλω να διαγράψω {user} μόνιμα',
        'submit' => 'Διαγραφή',
    ],
    'messages' => [
        'createSuccess' =>
            'User created successfully! {username} will be prompted with a password reset upon first authentication.',
        'roleEditSuccess' =>
            "οι ρόλοι του {username} έχουν ενημερωθεί με επιτυχία.",
        'banSuccess' => 'Ο/Η {username} έχει αποκλειστεί.',
        'unbanSuccess' => '{username} has been unbanned.',
        'editOwnerError' =>
            '{username} is the instance owner, you cannot edit its roles.',
        'banSuperAdminError' =>
            '{username} is a superadmin, one does not simply ban a superadmin…',
        'deleteOwnerError' =>
            '{username} is the instance owner, one does not simply delete the owner…',
        'deleteSuperAdminError' =>
            '{username} is a superadmin, one does not simply delete a superadmin…',
        'deleteSuccess' => '{username} has been deleted.',
    ],
];
