<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName}'s Kommentar zu {episodeTitle}",
    'back_to_comments' => 'Zurück zu den Kommentaren',
    'form' => [
        'episode_message_placeholder' => 'Schreibe einen Kommentar…',
        'reply_to_placeholder' => 'Antwort zu @{actorUsername}',
        'submit' => 'Senden',
        'submit_reply' => 'Antwort senden',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# Like}
        other {# Likes}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# Antwort}
        other {# Antworten}
    }',
    'like' => 'Liken',
    'reply' => 'Antwort',
    'view_replies' => 'Antworten anzeigen ({numberOfReplies})',
    'block_actor' => '@{actorUsername} blockieren',
    'block_domain' => 'Domain @{actorDomain} blockieren',
    'delete' => 'Kommentar löschen',
];
