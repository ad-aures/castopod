<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Publicación de {actorDisplayName}",
    'back_to_actor_posts' => 'Volver ás publicacións de {actor}',
    'actor_shared' => '{actor} compartiu',
    'reply_to' => 'Responder a @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Escribir unha mensaxe…',
        'episode_message_placeholder' => 'Escribe unha mensaxe para o episodio…',
        'episode_url_placeholder' => 'URL do episodio',
        'reply_to_placeholder' => 'Responder a @{actorUsername}',
        'submit' => 'Enviar',
        'submit_reply' => 'Responder',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# favorito}
        other {# favoritos}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# compartición}
        other {# comparticións}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# resposta}
        other {# respostas}
    }',
    'expand' => 'Despregar publicación',
    'block_actor' => 'Bloquear usuaria @{actorUsername}',
    'block_domain' => 'Bloquear dominio @{actorDomain}',
    'delete' => 'Eliminar publicación',
];
