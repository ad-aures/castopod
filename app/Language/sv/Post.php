<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName}s inlägg",
    'back_to_actor_posts' => 'Tillbaka till {actor} inlägg',
    'actor_shared' => '{actor} delades',
    'reply_to' => 'Svara på @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Skriv ett meddelande…',
        'episode_message_placeholder' => 'Skriv ett meddelande för avsnittet…',
        'episode_url_placeholder' => 'Avsnitt URL',
        'reply_to_placeholder' => 'Svara på @{actorUsername}',
        'submit' => 'Skicka',
        'submit_reply' => 'Svara',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# favorit}
        other {# favoriter}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# delning}
        other {# delningar}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# svar}
        other {# svar}
    }',
    'expand' => 'Expandera inlägg',
    'block_actor' => 'Blockera användare @{actorUsername}',
    'block_domain' => 'Blockera domän @{actorDomain}',
    'delete' => 'Ta bort inlägg',
];
