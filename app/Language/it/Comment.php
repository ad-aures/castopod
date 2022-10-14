<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Commento di {actorDisplayName} su {episodeTitle}",
    'back_to_comments' => 'Torna ai commenti',
    'form' => [
        'episode_message_placeholder' => 'Scrivi un commento…',
        'reply_to_placeholder' => 'Rispondi a @{actorUsername}',
        'submit' => 'Invia',
        'submit_reply' => 'Rispondi',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# like}
        other {# likes}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# like}
        other {# likes}
    }',
    'like' => 'Mi piace',
    'reply' => 'Rispondi',
    'view_replies' => 'Visualizza ({numberOfReplies}) risposte',
    'block_actor' => 'Blocca utente @{actorUsername}',
    'block_domain' => 'Blocca dominio @{actorDomain}',
    'delete' => 'Cancella commento',
];
