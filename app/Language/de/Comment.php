<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Kommentar von {actorDisplayName} für {episodeTitle}",
    'back_to_comments' => 'Zurück zu den Kommentaren',
    'form' => [
        'episode_message_placeholder' => 'Schreibe einen Kommentar…',
        'reply_to_placeholder' => 'Antworten auf @{actorUsername}',
        'submit' => 'Senden',
        'submit_reply' => 'Antwort senden',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# Beitrag}
        other {# Beiträge}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# Antwort}
        other {# Antworten}
    }',
    'like' => 'Gefällt mir',
    'reply' => 'Antworten',
    'view_replies' => 'Antworten anzeigen ({numberOfReplies})',
    'block_actor' => 'Benutzer @{actorUsername} blockieren',
    'block_domain' => 'Domain @{actorDomain} blockieren',
    'delete' => 'Kommentar löschen',
];
