<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Publicat per {actorDisplayName}",
    'back_to_actor_posts' => 'Tornar a les publicacions de {actor}',
    'actor_shared' => '{actor} ha compartit',
    'reply_to' => 'Respondre a @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Escriviu un missatge...',
        'episode_message_placeholder' => 'Escriviu un missatge per l\'episodi…',
        'episode_url_placeholder' => 'URL de l\'episodi',
        'reply_to_placeholder' => 'Respondre a @{actorUsername}',
        'submit' => 'Enviar',
        'submit_reply' => 'Respondre',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# favorit}
        other {# favorits}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# compartició}
        other {# comparticions}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# resposta}
        other {# respostes}
    }',
    'expand' => 'Expandir publicació',
    'block_actor' => 'Bloquejar a l\'usuari @{actorUsername}',
    'block_domain' => 'Bloquejar al domini @{actorDomain}',
    'delete' => 'Esborrar publicació',
];
