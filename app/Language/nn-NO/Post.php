<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Innlegget frå {actorDisplayName}",
    'back_to_actor_posts' => 'Tilbake til innlegga frå {actor}',
    'actor_shared' => '{actor} delte',
    'reply_to' => 'Svar til @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Skriv ei melding…',
        'episode_message_placeholder' => 'Skriv ei melding for episoden…',
        'episode_url_placeholder' => 'Episode-URL',
        'reply_to_placeholder' => 'Svar til @{actorUsername}',
        'submit' => 'Send',
        'submit_reply' => 'Svar',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# favoritt}
        other {# favorittar}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# deling}
        other {# delingar}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# svar}
        other {# svar}
    }',
    'expand' => 'Utvid innlegget',
    'block_actor' => 'Blokker brukaren @{actorUsername}',
    'block_domain' => 'Blokker domenet @{actorDomain}',
    'delete' => 'Slett innlegget',
];
