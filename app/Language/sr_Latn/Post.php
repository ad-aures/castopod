<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName} objave",
    'back_to_actor_posts' => 'Nazad na objave {actor}',
    'actor_shared' => '{actor} podelio',
    'reply_to' => 'Odgovori @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Napiši poruku…',
        'episode_message_placeholder' => 'Napiši porkuku za epizodu…',
        'episode_url_placeholder' => 'URL epizode',
        'reply_to_placeholder' => 'Odgovori @{actorUsername}',
        'submit' => 'Pošalji',
        'submit_reply' => 'Odgovori',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# favourite}
        other {# favourites}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# share}
        other {# shares}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# reply}
        other {# replies}
    }',
    'expand' => 'Proširi objavu',
    'block_actor' => 'Blokiraj korisnika @{actorUsername}',
    'block_domain' => 'Blokiraj domen @{actorDomain}',
    'delete' => 'Obriši objavu',
];
