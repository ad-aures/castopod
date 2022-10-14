<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Post di {actorDisplayName}",
    'back_to_actor_posts' => 'Torna ai post di {actor}',
    'actor_shared' => '{actor} ha condiviso',
    'reply_to' => 'Rispondi a @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Scrivi un messaggio…',
        'episode_message_placeholder' => 'Scrivi un messaggio per l\'episodio…',
        'episode_url_placeholder' => 'Url dell\'episodio',
        'reply_to_placeholder' => 'Rispondi a @{actorUsername}',
        'submit' => 'Invia',
        'submit_reply' => 'Rispondi',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# preferito}
        other {# preferiti}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# condivisione}
        other {# condivisioni}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# risposta}
        other {# risposte}
    }',
    'expand' => 'Espandi post',
    'block_actor' => 'Blocca utente @{actorUsername}',
    'block_domain' => 'Blocca dominio @{actorDomain}',
    'delete' => 'Cancella post',
];
