<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Η δημοσίευση του {actorDisplayName}",
    'back_to_actor_posts' => 'Επιστροφή στις δημοσιεύσεις του {actor}',
    'actor_shared' => 'Ο {actor} μοιράστηκε',
    'reply_to' => 'Απαντήστε στον χρήστη @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Δημιουργία ενός μηνύματος…',
        'episode_message_placeholder' => 'Γράψτε ένα μήνυμα για το επεισόδιο…',
        'episode_url_placeholder' => 'URL Επεισόδίου',
        'reply_to_placeholder' => 'Απαντήστε στο χρήστη @{actorUsername}',
        'submit' => 'Αποστολή',
        'submit_reply' => 'Απάντηση',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# αγαπημένο}
        other {# αγαπημένα}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# κοινοποίηση}
        other {# κοινοποιήσεις}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# απάντηση}
        other {# απαντήσεις}
    }',
    'expand' => 'Επέκταση δημοσίευσης',
    'block_actor' => 'Μπλοκάρισμα χρήστη @{actorUsername}',
    'block_domain' => 'Αποκλεισμός του τομέα @{actorDomain}',
    'delete' => 'Διαγραφή δημοσίευσης',
];
