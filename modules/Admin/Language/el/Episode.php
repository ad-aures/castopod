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
        'scheduled' => 'Προγραμματισμένο',
        'not_published' => 'Δεν έχει δημοσιευτεί',
    ],
    'list' => [
        'episode' => 'Επεισόδιο',
        'visibility' => 'Ορατότητα',
        'comments' => 'Σχόλια',
        'actions' => 'Ενέργειες',
    ],
    'messages' => [
        'createSuccess' => 'Το επεισόδιο δημιουργήθηκε με επιτυχία!',
        'editSuccess' => 'Το επεισόδιο ενημερώθηκε με επιτυχία!',
        'publishCancelSuccess' => 'Η δημοσίευση του επεισοδίου ακυρώθηκε επιτυχώς!',
    ],
    'form' => [
        'file_size_error' =>
            'Το μέγεθος του αρχείου σας είναι πολύ μεγάλο! Το μέγιστο μέγεθος είναι {0}. Αυξήστε τις τιμές `memory_limit`, `upload_max_filesize` και `post_max_size` στο αρχείο ρυθμίσεων php και έπειτα επανεκκινήστε τον διακομιστή web για να ανεβάσετε το αρχείο σας.',
        'audio_file' => 'Αρχείο ήχου',
        'audio_file_hint' => 'Επιλέξτε ένα αρχείο ήχου .mp3 ή .m4a.',
        'info_section_title' => 'Πληροφορίες επεισοδίου',
        'cover' => 'Εξώφυλλο επισοδίου',
        'cover_hint' =>
            "Εάν δεν ορίσετε ένα εξώφυλλο, το εξώφυλλο του podcast θα χρησιμοποιηθεί αντ 'αυτού.",
        'cover_size_hint' => 'Το εξώφυλλο πρέπει να είναι τουλάχιστον 1400px πλάτος και ύψος.',
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
            'hint' => 'Does the episode contain explicit content?',
            'undefined' => 'undefined',
            'clean' => 'Clean',
            'explicit' => 'Explicit',
        ],
        'show_notes_section_title' => 'Show notes',
        'show_notes_section_subtitle' =>
            'Up to 4000 characters, be clear and concise. Show notes help potential listeners in finding the episode.',
        'description' => 'Description',
        'description_footer' => 'Description footer',
        'description_footer_hint' =>
            'This text is added at the end of each episode description, it is a good place to input your social links for example.',
        'additional_files_section_title' => 'Additional files',
        'additional_files_section_subtitle' =>
            'These files may be used by other platforms to provide better experience to your audience.<br />See the {podcastNamespaceLink} for more information.',
        'location_section_title' => 'Location',
        'location_section_subtitle' => 'What place is this episode about?',
        'location_name' => 'Location name or address',
        'location_name_hint' => 'This can be a real or fictional location',
        'transcript' => 'Transcript (subtitles / closed captions)',
        'transcript_hint' => 'Only .srt are allowed.',
        'transcript_download' => 'Download transcript',
        'transcript_file' => 'Transcript file (.srt)',
        'transcript_remote_url' => 'Remote url for transcript',
        'transcript_file_delete' => 'Delete transcript file',
        'chapters' => 'Chapters',
        'chapters_hint' => 'File must be in JSON Chapters format.',
        'chapters_download' => 'Download chapters',
        'chapters_file' => 'Chapters file',
        'chapters_remote_url' => 'Remote url for chapters file',
        'chapters_file_delete' => 'Delete chapters file',
        'advanced_section_title' => 'Advanced Parameters',
        'advanced_section_subtitle' =>
            'If you need RSS tags that Castopod does not handle, set them here.',
        'custom_rss' => 'Custom RSS tags for the episode',
        'custom_rss_hint' => 'This will be injected within the ❬item❭ tag.',
        'block' => 'Episode should be hidden from all platforms',
        'block_hint' =>
            'The episode show or hide post. If you want this episode removed from the Apple directory, toggle this on.',
        'submit_create' => 'Create episode',
        'submit_edit' => 'Save episode',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Back to episode dashboard',
        'post' => 'Your announcement post',
        'post_hint' =>
            "Write a message to announce the publication of your episode. The message will be broadcasted to all your followers in the fediverse and be featured in your podcast's homepage.",
        'message_placeholder' => 'Write your message…',
        'publication_date' => 'Publication date',
        'publication_method' => [
            'now' => 'Now',
            'schedule' => 'Schedule',
        ],
        'scheduled_publication_date' => 'Scheduled publication date',
        'scheduled_publication_date_clear' => 'Clear publication date',
        'scheduled_publication_date_hint' =>
            'You can schedule the episode release by setting a future publication date. This field must be formatted as YYYY-MM-DD HH:mm',
        'submit' => 'Publish',
        'submit_edit' => 'Edit publication',
        'cancel_publication' => 'Cancel publication',
        'message_warning' => 'You did not write a message for your announcement post!',
        'message_warning_hint' => 'Having a message increases social engagement, resulting in a better visibility for your episode.',
        'message_warning_submit' => 'Δημοσίευση ούτως ή άλλως',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Η κατάργηση της δημοσίευσης του επεισοδίου θα διαγράψει όλες τις δημοσιεύσεις που σχετίζονται με αυτό και θα τις αφαιρέσει από τη ροή RSS του podcast.",
        'understand' => 'I understand, I want to unpublish the episode',
        'submit' => 'Unpublish',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Deleting the episode will delete all the posts associated with it and remove it from the podcast's RSS feed.",
        'understand' => 'I understand, I want to delete the episode',
        'submit' => 'Delete',
    ],
    'embed' => [
        'title' => 'Embeddable player',
        'label' =>
            'Pick a theme color, copy the embeddable player to clipboard, then paste it on your website.',
        'clipboard_iframe' => 'Copy embeddable player to clipboard',
        'clipboard_url' => 'Copy address to clipboard',
        'dark' => 'Dark',
        'dark-transparent' => 'Dark transparent',
        'light' => 'Light',
        'light-transparent' => 'Light transparent',
    ],
];
