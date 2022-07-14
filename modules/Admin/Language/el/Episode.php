<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Σεζόν {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Επεισόδιο {episodeNumber}',
    'number_abbr' => 'Επ. {episodeNumber}',
    'season_episode' => 'Σεζόν {seasonNumber} επεισόδιο {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'number_of_comments' => '{numberOfComments, plural,
        one {# σχόλιο}
        other {# σχόλεια}
    }',
    'all_podcast_episodes' => 'Όλα τα επεισόδια του podcast',
    'back_to_podcast' => 'Μετάβαση πίσω στο podcast',
    'edit' => 'Επεξεργασία',
    'publish' => 'Δημοσίευση',
    'publish_edit' => 'Επεξεργασία δημοσίευσης',
    'unpublish' => 'Αναίρεση δημοσίευσης',
    'publish_error' => 'Το επεισόδιο έχει ήδη δημοσιευθεί.',
    'publish_edit_error' => 'Το επεισόδιο έχει ήδη δημοσιευθεί.',
    'publish_cancel_error' => 'Το επεισόδιο έχει ήδη δημοσιευθεί.',
    'unpublish_error' => 'Το επεισόδιο δεν έχει δημοσιευθεί.',
    'delete' => 'Διαγραφή',
    'go_to_page' => 'Μετάβαση στη σελίδα',
    'create' => 'Προσθήκη επεισοδίου',
    'publication_status' => [
        'published' => 'Δημοσιευμένο',
        'with_podcast' => 'Published',
        'scheduled' => 'Προγραμματισμένο',
        'not_published' => 'Δεν έχει δημοσιευτεί',
    ],
    'with_podcast_hint' => 'To be published at the same time as the podcast',
    'list' => [
        'search' => [
            'placeholder' => 'Search for an episode',
            'clear' => 'Clear search',
            'submit' => 'Search',
        ],
        'number_of_episodes' => '{numberOfEpisodes, plural,
            one {# episode}
            other {# episodes}
        }',
        'episode' => 'Επεισόδιο',
        'visibility' => 'Ορατότητα',
        'comments' => 'Σχόλια',
        'actions' => 'Ενέργειες',
    ],
    'messages' => [
        'createSuccess' => 'Το επεισόδιο δημιουργήθηκε με επιτυχία!',
        'editSuccess' => 'Το επεισόδιο ενημερώθηκε με επιτυχία!',
        'publishSuccess' => '{publication_status, select,
            published {Episode successfully published!}
            scheduled {Episode publication successfully scheduled!}
            with_podcast {This episode will be published at the same time as the podcast.}
            other {This episode is not published.}
        }',
        'publishCancelSuccess' => 'Η δημοσίευση του επεισοδίου ακυρώθηκε επιτυχώς!',
        'unpublishBeforeDeleteTip' => 'You must unpublish the episode before deleting it.',
        'scheduleDateError' => 'Schedule date must be set!',
        'deletePublishedEpisodeError' => 'Please unpublish the episode before deleting it.',
        'deleteSuccess' => 'Episode successfully deleted!',
        'deleteError' => 'Failed to delete episode {type, select,
            transcript {transcript}
            chapters {chapters}
            image {cover}
            audio {audio}
            other {media}
        }.',
        'deleteFileError' => 'Failed to delete {type, select,
            transcript {transcript}
            chapters {chapters}
            image {cover}
            audio {audio}
            other {media}
        } file {file_path}. You may manually remove it from your disk.',
        'sameSlugError' => 'An episode with the chosen slug already exists.',
    ],
    'form' => [
        'file_size_error' =>
            'Το μέγεθος του αρχείου σας είναι πολύ μεγάλο! Το μέγιστο μέγεθος είναι {0}. Αυξήστε τις τιμές `memory_limit`, `upload_max_filesize` και `post_max_size` στο αρχείο ρυθμίσεων php και έπειτα επανεκκινήστε τον διακομιστή web για να ανεβάσετε το αρχείο σας.',
        'audio_file' => 'Αρχείο ήχου',
        'audio_file_hint' => 'Επιλέξτε ένα αρχείο ήχου .mp3 ή .m4a.',
        'info_section_title' => 'Πληροφορίες επεισοδίου',
        'cover' => 'Εξώφυλλο επισοδίου',
        'cover_hint' =>
            'Εάν δεν ορίσετε ένα εξώφυλλο, το εξώφυλλο του podcast θα χρησιμοποιηθεί αντ \'αυτού.',
        'cover_size_hint' => 'Cover must be squared and at least 1400px wide and tall.',
        'title' => 'Τίτλος',
        'title_hint' =>
            'Θα πρέπει να υπάρχει ένα σαφές και συνοπτικό όνομα επεισοδίου. Μην καθορίσετε εδώ το επεισόδιο ή τους αριθμούς της σεζόν.',
        'permalink' => 'Μόνιμος σύνδεσμος',
        'season_number' => 'Σεζόν',
        'episode_number' => 'Επεισόδιο',
        'type' => [
            'label' => 'Είδος',
            'full' => 'Πλήρης',
            'full_hint' => 'Πλήρες περιεχόμενο (το επεισόδιο)',
            'trailer' => 'Τρέιλερ',
            'trailer_hint' => 'Σύντομο, προωθητικό περιεχόμενο που αντιπροσωπεύει μια προεπισκόπηση της τρέχουσας εμφάνισης',
            'bonus' => 'Μπόνους',
            'bonus_hint' => 'Επιπλέον περιεχόμενο για την παράσταση (για παράδειγμα, πίσω από τις σκηνές πληροφορίες ή συνεντεύξεις με τη cast) ή δια-διαφημιστικό περιεχόμενο για μια άλλη παράσταση',
        ],
        'parental_advisory' => [
            'label' => 'Γονικός σύμβουλος',
            'hint' => 'Μήπως το επεισόδιο περιέχει ακατάλληλο περιεχόμενο;',
            'undefined' => 'απροσδιόριστο',
            'clean' => 'Καθαρισμός',
            'explicit' => 'Άσεμνο περιεχόμενο',
        ],
        'show_notes_section_title' => 'Εμφάνιση σημειώσεων',
        'show_notes_section_subtitle' =>
            'Μέχρι 4000 χαρακτήρες, να είναι σαφείς και συνοπτικές. Η εμφάνιση σημειώσεων βοηθάει πιθανούς ακροατές στην εύρεση του επεισοδίου.',
        'description' => 'Περιγραφή',
        'description_footer' => 'Υποσέλιδο περιγραφής',
        'description_footer_hint' =>
            'Αυτό το κείμενο προστίθεται στο τέλος του κάθε επεισοδίου, είναι ένα καλό μέρος για να εισάγετε κοινωνικές συνδέσεις για παράδειγμα.',
        'additional_files_section_title' => 'Επιπρόσθετα αρχεία',
        'additional_files_section_subtitle' =>
            'Αυτά τα αρχεία μπορούν να χρησιμοποιηθούν από άλλες πλατφόρμες για την παροχή καλύτερης εμπειρίας στο κοινό σας. Δείτε το {podcastNamespaceLink} για περισσότερες πληροφορίες.',
        'location_section_title' => 'Τοποθεσία',
        'location_section_subtitle' => 'Σε ποιο μέρος είναι αυτό το επεισόδιο;',
        'location_name' => 'Όνομα τοποθεσίας ή διεύθυνση',
        'location_name_hint' => 'Αυτή μπορεί να είναι μια πραγματική ή φανταστική τοποθεσία',
        'transcript' => 'Απομαγνητοφώνηση (υπότιτλοι / κλειστοί υπότιτλοι)',
        'transcript_hint' => 'Επιτρέπονται μόνο .srt αρχεία.',
        'transcript_download' => 'Λήψη απομαγνητοφώνησης',
        'transcript_file' => 'Αρχείο απομαγνητοφώνησης (.srt)',
        'transcript_remote_url' => 'Απομακρυσμένη διεύθυνση url για απομαγνητοφώνηση',
        'transcript_file_delete' => 'Διαγραφή αρχείου απομαγνητοφώνησης',
        'chapters' => 'Κεφάλαια',
        'chapters_hint' => 'Το αρχείο πρέπει να είναι σε μορφή JSON.',
        'chapters_download' => 'Κατεβάστε τα κεφάλαια',
        'chapters_file' => 'Αρχεία κεφαλαίων',
        'chapters_remote_url' => 'Απομακρυσμένη διεύθυνση url για αρχεία κεφαλαίων',
        'chapters_file_delete' => 'Διαγραφή αρχείου κεφαλαίων',
        'advanced_section_title' => 'Προηγμένες Παράμετροι',
        'advanced_section_subtitle' =>
            'Αν χρειάζεστε ετικέτες RSS που δεν χειρίζεται το Castopod, ορίστε τις εδώ.',
        'custom_rss' => 'Προσαρμοσμένες ετικέτες RSS για το επεισόδιο',
        'custom_rss_hint' => 'Αυτό θα ενεθεί εντός της ετικέτας "item".',
        'block' => 'Episode should be hidden from public catalogues',
        'block_hint' =>
            'The episode show or hide status: toggling this on prevents the episode from appearing in Apple Podcasts, Google Podcasts, and any third party apps that pull shows from these directories. (Not guaranteed)',
        'submit_create' => 'Δημιουργία επεισοδίου',
        'submit_edit' => 'Αποθήκευση επεισοδίου',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Πίσω στον Πίνακα Ελέγχου',
        'post' => 'Η ανακοίνωσή σας',
        'post_hint' =>
            "Γράψτε ένα μήνυμα για να ανακοινώσετε τη δημοσίευση του επεισοδίου σας. Το μήνυμα θα μεταδοθεί σε όλους τους οπαδούς σας στο fediverse και θα εμφανίζεται στην αρχική σελίδα του podcast σας.",
        'message_placeholder' => 'Γράψτε το μήνυμά σας…',
        'publication_date' => 'Ημερομηνία δημοσίευσης',
        'publication_method' => [
            'now' => 'Τώρα',
            'schedule' => 'Προγραμματισμός',
            'with_podcast' => 'Publish alongside podcast',
        ],
        'scheduled_publication_date' => 'Ημερομηνία προγραμματισμένης δημοσίευσης',
        'scheduled_publication_date_clear' => 'Εκκαθάριση ημερομηνίας δημοσίευσης',
        'scheduled_publication_date_hint' =>
            'Μπορείτε να προγραμματίσετε την έκδοση επεισοδίων ορίζοντας μια μελλοντική ημερομηνία δημοσίευσης. Αυτό το πεδίο πρέπει να μορφοποιηθεί ως ΕΕΕ-ΜΜ-ΗΗ HH:mm',
        'submit' => 'Δημοσίευση',
        'submit_edit' => 'Επεξεργασία δημοσίευσης',
        'cancel_publication' => 'Ακύρωση δημοσίευσης',
        'message_warning' => 'Δεν γράψατε μήνυμα για την ανακοίνωσή σας!',
        'message_warning_hint' => 'Έχοντας ένα μήνυμα αυξάνει την κοινωνική δέσμευση, με αποτέλεσμα μια καλύτερη προβολή για το επεισόδιο σας.',
        'message_warning_submit' => 'Δημοσίευση ούτως ή άλλως',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Η κατάργηση της δημοσίευσης του επεισοδίου θα διαγράψει όλες τις δημοσιεύσεις που σχετίζονται με αυτό και θα τις αφαιρέσει από τη ροή RSS του podcast.",
        'understand' => 'Καταλαβαίνω, θέλω να αποδημοσιεύσει το επεισόδιο',
        'submit' => 'Αναίρεση δημοσίευσης',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Deleting the episode will delete all media files, comments, video clips and soundbites associated with it.",
        'understand' => 'Καταλαβαίνω, θέλω να διαγράψω το επεισόδιο',
        'submit' => 'Delete',
    ],
    'embed' => [
        'title' => 'Ενσωματώσιμος αναπαραγωγέας',
        'label' =>
            'Επιλέξτε ένα χρώμα θέματος, αντιγράψτε τον ενσωματωμένο παίκτη στο πρόχειρο και στη συνέχεια επικολλήστε το στην ιστοσελίδα σας.',
        'clipboard_iframe' => 'Αντιγραφή ενσωματωμένου αναπαραγωγέα στο πρόχειρο',
        'clipboard_url' => 'Αντιγραφή διεύθυνσης στο πρόχειρο',
        'dark' => 'Σκοτεινό',
        'dark-transparent' => 'Σκούρο διαφανές',
        'light' => 'Ανοιχτόχρωμο',
        'light-transparent' => 'Ανοιχτό διαφανές',
    ],
];
