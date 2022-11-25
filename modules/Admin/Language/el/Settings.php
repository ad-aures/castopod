<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Γενικές ρυθμίσεις',
    'instance' => [
        'title' => 'Διακομιστής',
        'site_icon' => 'Εικονίδιο ιστοσελίδας',
        'site_icon_delete' => 'Διαγραφή εικονιδίου ιστότοπου',
        'site_icon_hint' => 'Τα εικονίδια της ιστοσελίδας είναι αυτά που βλέπετε στις καρτέλες του προγράμματος περιήγησης, στη γραμμή σελιδοδεικτών, και όταν προσθέτετε μια ιστοσελίδα ως συντόμευση σε κινητές συσκευές.',
        'site_icon_helper' => 'Το εικονίδιο πρέπει να είναι τετράγωνο και τουλάχιστον 512px πλάτος και ψηλό.',
        'site_name' => 'Όνομα ιστοτόπου',
        'site_description' => 'Περιγραφή ιστοτόπου',
        'submit' => 'Αποθήκευση',
        'editSuccess' => 'Ο Διακομιστής έχει ενημερωθεί με επιτυχία!',
        'deleteIconSuccess' => 'Το εικονίδιο της ιστοσελίδας έχει καταργηθεί με επιτυχία!',
    ],
    'images' => [
        'title' => 'Εικόνες',
        'subtitle' => 'Εδώ μπορείτε να επαναδημιουργήσετε όλες τις εικόνες με βάση τα πρωτότυπα που φορτώθηκαν. Για να χρησιμοποιηθεί αν βρείτε κάποιες εικόνες που λείπουν. Αυτή η εργασία μπορεί να διαρκέσει λίγο.',
        'regenerate' => 'Αναδημιουργία εικόνων',
        'regenerationSuccess' => 'Όλες οι εικόνες έχουν δημιουργηθεί επιτυχώς!',
    ],
    'housekeeping' => [
        'title' => 'Housekeeping',
        'subtitle' => 'Runs various housekeeping tasks. Use this feature if you ever encounter issues with media files or data integrity. These tasks may take a while.',
        'reset_counts' => 'Επαναφορά μετρήσεων',
        'reset_counts_helper' => 'Αυτή η επιλογή θα επαναϋπολογίσει και θα επαναφέρει όλους τους αριθμούς δεδομένων (αριθμός των ακολούθων, αναρτήσεις, σχόλια, …).',
        'rewrite_media' => 'Επανεγγραφή μεταδεδομένων πολυμέσων',
        'rewrite_media_helper' => 'Αυτή η επιλογή θα διαγράψει όλα τα περιττά αρχεία πολυμέσων και θα τα αναπαράγει (εικόνες, αρχεία ήχου, μεταγραφές, κεφάλαια, …)',
        'rename_episodes_files' => 'Μετονομασία αρχείων ήχου επεισοδίου',
        'rename_episodes_files_hint' => 'Αυτή η επιλογή θα μετονομάσει όλα τα αρχεία ήχου επεισόδια σε μια τυχαία συμβολοσειρά χαρακτήρων. Χρησιμοποιήστε αυτό αν διαρρεύσει ένας από τους ιδιωτικούς συνδέσμους επεισοδίων σας, καθώς αυτό θα τον αποκρύψει αποτελεσματικά.',
        'clear_cache' => 'Εκκαθάριση συνολικού cache',
        'clear_cache_helper' => 'Αυτή η επιλογή θα εκκαθαρίσει αρχεία cache redis ή εγγράψιμο/cache.',
        'run' => 'Run housekeeping',
        'runSuccess' => 'Housekeeping has been run successfully!',
    ],
    'theme' => [
        'title' => 'Θέμα',
        'accent_section_title' => 'Χρώμα έμφασης',
        'accent_section_subtitle' => 'Επιλέξτε το χρώμα για να καθορίσετε την εμφάνιση και την αίσθηση όλων των δημόσιων σελίδων.',
        'pine' => 'Πεύκο',
        'crimson' => 'Βυσσινί',
        'amber' => 'Κεχριμπάρι',
        'lake' => 'Λίμνη',
        'jacaranda' => 'Jacaranda',
        'onyx' => 'Όνυξ',
        'submit' => 'Αποθήκευση',
        'setInstanceThemeSuccess' => 'Το θέμα έχει ενημερωθεί με επιτυχία!',
    ],
];
