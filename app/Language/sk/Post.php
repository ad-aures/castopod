<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Príspevok používateľa {actorDisplayName}",
    'back_to_actor_posts' => 'Späť na príspevky používateľa {actor}',
    'actor_shared' => '{actor} zdieľal',
    'reply_to' => 'Odpoveď používateľovi @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Napíšte správu…',
        'episode_message_placeholder' => 'Napíšte správu pre túto epizódu…',
        'episode_url_placeholder' => 'Adresa URL epizódy',
        'reply_to_placeholder' => 'Odpoveď používateľovi @{actorUsername}',
        'submit' => 'Odoslať',
        'submit_reply' => 'Odpovedať',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# si obľúbil}
        few {# si obľúbili}
        many {# si obľúbilo}
        other {# si obľúbilo}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# zdieľanie}
        few {# zdieľania}
        many {# zdieľaní}
        other {# zdieľaní}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# odpoveď}
        few {# odpovede}
        many {# odpovedí}
        other {# odpovedí}
    }',
    'expand' => 'Rozbaliť príspevok',
    'block_actor' => 'Zablokovať používateľa @{actorUsername}',
    'block_domain' => 'Zablokovať doménu @{actorDomain}',
    'delete' => 'Vymazať príspevok',
];
