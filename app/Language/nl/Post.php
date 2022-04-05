<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Bericht van {actorDisplayName}",
    'back_to_actor_posts' => 'Terug naar {actor} berichten',
    'actor_shared' => '{actor} deelde',
    'reply_to' => 'Reageer op @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Schrijf een bericht…',
        'episode_message_placeholder' => 'Schrijf een bericht voor deze aflevering…',
        'episode_url_placeholder' => 'Aflevering URL',
        'reply_to_placeholder' => 'Reageer op @{actorUsername}',
        'submit' => 'Verzenden',
        'submit_reply' => 'Reageer',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# favoriet}
        other {# favorieten}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# mededeling}
        other {# mededelingen}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# reactie}
        other {# reacties}
    }',
    'expand' => 'Bericht uitklappen',
    'block_actor' => 'Blokkeer gebruiker @{actorUsername}',
    'block_domain' => 'Blokkeer domein @{actorDomain}',
    'delete' => 'Bericht verwijderen',
];
