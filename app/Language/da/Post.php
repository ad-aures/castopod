<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName}'s indlæg",
    'back_to_actor_posts' => 'Tilbage til {actor} indlæg',
    'actor_shared' => '{actor} delt',
    'reply_to' => 'Svar @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Skriv en besked…',
        'episode_message_placeholder' => 'Skriv en besked til episoden…',
        'episode_url_placeholder' => 'Episode URL',
        'reply_to_placeholder' => 'Svar @{actorUsername}',
        'submit' => 'Send',
        'submit_reply' => 'Svar',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# kan lide}
        other {# kan lide}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# del}
        other {# delinger}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# svar}
        other {# svar}
    }',
    'expand' => 'Udvid opslag',
    'block_actor' => 'Blokér bruger @{actorUsername}',
    'block_domain' => 'Blokér domænet @{actorDomain}',
    'delete' => 'Slet indlæg',
];
