<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Το σχόλιο του {actorDisplayName} για το {episodeTitle}",
    'back_to_comments' => 'Επιστροφή στα σχόλια',
    'form' => [
        'episode_message_placeholder' => 'Γράψε ένα σχόλιο…',
        'reply_to_placeholder' => 'Απαντήστε στο χρήστη {actorUsername}',
        'submit' => 'Αποστολή',
        'submit_reply' => 'Απάντηση',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# μου αρέσει}
        other {# μου αρέσει}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# απάντηση}
        other {# απαντήσεις}
    }',
    'like' => 'Μου αρέσει',
    'reply' => 'Απάντηση',
    'view_replies' => 'Προβολή απαντήσεων ({numberOfReplies})',
    'block_actor' => 'Αποκλεισμός χρήστη @{actorUsername}',
    'block_domain' => 'Αποκλεισμός του τομέα @{actorDomain}',
    'delete' => 'Διαγραφή σχολίου',
];
