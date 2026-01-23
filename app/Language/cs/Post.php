<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Příspěvek {actorDisplayName}",
    'back_to_actor_posts' => 'Zpět na příspěvky {actor}',
    'actor_shared' => '{actor} sdílen(a)',
    'reply_to' => 'Odpovědět @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Napsat zprávu…',
        'episode_message_placeholder' => 'Napsat zprávu pro epizodu…',
        'episode_url_placeholder' => 'URL epizody',
        'reply_to_placeholder' => 'Odpovědět @{actorUsername}',
        'submit' => 'Odeslat',
        'submit_reply' => 'Odpovědět',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# oblíbil}
        other {# oblíbili}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# sdílení}
        other {# sdílení}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# odpověď}
        other {# odpovědi}
    }',
    'expand' => 'Rozbalit příspěvek',
    'block_actor' => 'Blokovat uživatele @{actorUsername}',
    'block_domain' => 'Blokovat doménu @{actorDomain}',
    'delete' => 'Smazat příspěvek',
];
