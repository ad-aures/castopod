<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Publicaciones de {actorDisplayName}",
    'back_to_actor_posts' => 'Regresar a las publicaciones de {actor}',
    'actor_shared' => '{actor} compartido',
    'reply_to' => 'Responder a @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Escribe un mensaje…',
        'episode_message_placeholder' => 'Escribe un mensaje para el episodio…',
        'episode_url_placeholder' => 'URL del episodio',
        'reply_to_placeholder' => 'Responder a @{actorUsername}',
        'submit' => 'Enviar',
        'submit_reply' => 'Responder',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# favorito}
        other {# favoritos}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# comparte}
        other {# compartidos}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# respuesta}
        other {# respuestas}
    }',
    'expand' => 'Expandir post',
    'block_actor' => 'Bloquear usuario @{actorUsername}',
    'block_domain' => 'Bloquear dominio @{actorDomain}',
    'delete' => 'Eliminar publicación',
];
