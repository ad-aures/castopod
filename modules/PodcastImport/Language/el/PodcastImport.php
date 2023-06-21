<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'warning' =>
        'Αυτή η διαδικασία μπορεί να διαρκέσει πολύ. Καθώς η τρέχουσα έκδοση δεν εμφανίζει καμία πρόοδο ενώ εκτελείται, δεν θα δείτε τίποτα να ενημερώνεται μέχρι να ολοκληρωθεί. Σε περίπτωση σφάλματος χρονικού ορίου, αυξήστε την τιμή `max_execution_time`.',
    'old_podcast_section_title' => 'Το podcast για εισαγωγή',
    'old_podcast_section_subtitle' =>
        'Βεβαιωθείτε ότι έχετε τα δικαιώματα για αυτό το podcast πριν από την εισαγωγή του. Η αντιγραφή και μετάδοση ενός podcast χωρίς τα κατάλληλα δικαιώματα είναι πειρατεία και μπορεί να διωχθεί.',
    'imported_feed_url' => 'Διεύθυνση URL Ροής',
    'imported_feed_url_hint' => 'To Url πρέπει να είναι σε μορφή xml ή rss.',
    'new_podcast_section_title' => 'Το νέο podcast',
    'advanced_params_section_title' => 'Παράμετροι για προχωρημένους',
    'advanced_params_section_subtitle' =>
        'Διατηρήστε τις προεπιλεγμένες τιμές αν δεν έχετε ιδέα για το ποια είναι τα πεδία.',
    'slug_field' => 'Πεδίο που πρέπει να χρησιμοποιείται για τον υπολογισμό του slug του επεισοδίου',
    'description_field' =>
        'Πεδίο πηγής που χρησιμοποιείται για την περιγραφή επεισοδίου / εμφάνιση σημειώσεων',
    'force_renumber' => 'Force episodes renumbering',
    'force_renumber_hint' =>
        'Use this if your podcast does not have episode numbers but wish to set them during import.',
    'season_number' => 'Αριθμός σεζόν',
    'season_number_hint' =>
        'Χρησιμοποιήστε αυτό αν το podcast σας δεν έχει αριθμό σεζόν αλλά επιθυμεί να ορίσει έναν κατά την εισαγωγή. Αφήστε κενό διαφορετικά.',
    'max_episodes' => 'Μέγιστος αριθμός επεισοδίων εισαγωγής',
    'max_episodes_hint' => 'Αφήστε κενό για την εισαγωγή όλων των επεισοδίων',
    'lock_import' =>
        'Αυτή η ροή προστατεύεται. Δεν μπορείτε να την εισάγετε. Αν είστε ο ιδιοκτήτης, μην την προστατεύετε στην πλατφόρμα προέλευσης.',
    'submit' => 'Εισαγωγή podcast',
];
