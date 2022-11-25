<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'list' => [
        'title' => 'Βίντεο κλιπ',
        'status' => [
            'label' => 'Κατάσταση',
            'queued' => 'στην ουρά',
            'queued_hint' => 'Το κλιπ περιμένει να υποβληθεί σε επεξεργασία.',
            'pending' => 'εκκρεμεί',
            'pending_hint' => 'Το κλιπ θα δημιουργηθεί σύντομα.',
            'running' => 'εκτελείται',
            'running_hint' => 'Το κλιπ δημιουργείται.',
            'failed' => 'απέτυχε',
            'failed_hint' => 'Το κλιπ δεν μπόρεσε να δημιουργηθεί: αποτυχία δέσμης ενεργειών.',
            'passed' => 'passed',
            'passed_hint' => 'Το κλιπ δημιουργήθηκε με επιτυχία!',
        ],
        'clip' => 'Αποσπάσματα',
        'duration' => 'Διάρκεια εργασίας',
    ],
    'title' => 'Βίντεο κλιπ: {videoClipLabel}',
    'download_clip' => 'Κατεβάστε το κλιπ',
    'create' => 'Νέο βίντεο κλιπ',
    'go_to_page' => 'Go to clip page',
    'retry' => 'Retry clip generation',
    'delete' => 'Διαγραφή κλιπ',
    'logs' => 'Αρχεία καταγραφής εργασίας',
    'messages' => [
        'alreadyExistingError' => 'Το βίντεο κλιπ που προσπαθείτε να δημιουργήσετε υπάρχει ήδη!',
        'addToQueueSuccess' => 'Το βίντεο κλιπ έχει προστεθεί στην ουρά αναμονής, αναμένοντας να δημιουργηθεί!',
        'deleteSuccess' => 'Το βίντεο κλιπ αφαιρέθηκε με επιτυχία!',
    ],
    'format' => [
        'landscape' => 'Οριζόντια',
        'portrait' => 'Κατακόρυφα',
        'squared' => 'Τετράγωνα',
    ],
    'form' => [
        'title' => 'Νέο βίντεο κλιπ',
        'params_section_title' => 'Παράμετροι βίντεο κλιπ',
        'clip_title' => 'Τίτλος κλιπ',
        'format' => [
            'label' => 'Επιλογή μορφής',
            'landscape_hint' => 'Με αναλογία 16:9, τα βίντεο τοπίου είναι υπέροχα για το PeerTube, το Youtube και το Vimeo.',
            'portrait_hint' => 'Με αναλογία 9:16, πορτρέτο βίντεο είναι μεγάλη για TikTok, shorts Youtube και ιστορίες Instagram.',
            'squared_hint' => 'Με αναλογία 1:1, τα τετράγωνα βίντεο είναι υπέροχα για Mastodon, Facebook, Twitter και LinkedIn.',
        ],
        'theme' => 'Επιλογή θέματος',
        'start_time' => 'Έναρξη από',
        'duration' => 'Διάρκεια',
        'trim_start' => 'Περικοπή έναρξης',
        'trim_end' => 'Περικοπή τέλους',
        'submit' => 'Δημιουργία βίντεο κλιπ',
    ],
    'requirements' => [
        'title' => 'Λείπουν προαπαιτούμενα',
        'missing' => 'Έχετε απαιτήσεις που λείπουν. Σιγουρευτείτε ότι προσθέστε όλα τα απαιτούμενα στοιχεία για να μπορέσετε να δημιουργήσετε ένα βίντεο για αυτό το επεισόδιο!',
        'ffmpeg' => 'FFmpeg',
        'gd' => 'Σχεδίαση Γραφικών (GD)',
        'freetype' => 'Βιβλιοθήκη Freetype για GD',
        'transcript' => 'Αρχείο απομαγνητοφώνησης (.srt)',
    ],
];
