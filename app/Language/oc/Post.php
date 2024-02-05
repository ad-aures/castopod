<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Publicacion de {actorDisplayName}",
    'back_to_actor_posts' => 'Tornar a las publicacions de {actor}',
    'actor_shared' => '{actor} a partejat',
    'reply_to' => 'Respondre @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Escriure un messatge…',
        'episode_message_placeholder' => 'Escriure un messatge per l’espisòdi…',
        'episode_url_placeholder' => 'URL de l’episòdi',
        'reply_to_placeholder' => 'Respondre @{actorUsername}',
        'submit' => 'Enviar',
        'submit_reply' => 'Respondre',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# favorit}
        other {# favorits}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# partatge}
        other {# partatges}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# responsa}
        other {# responsas}
    }',
    'expand' => 'Espandir la publicacion',
    'block_actor' => 'Blocar l’utilizaire @{actorUsername}',
    'block_domain' => 'Blocar lo domeni @{actorDomain}',
    'delete' => 'Suprimir la publicacion',
];
