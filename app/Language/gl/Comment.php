<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Comentario de {actorDisplayName} en {episodeTitle}",
    'back_to_comments' => 'Volver a comentarios',
    'form' => [
        'episode_message_placeholder' => 'Escribir un comentario…',
        'reply_to_placeholder' => 'Responder a @{actorUsername}',
        'submit' => 'Enviar',
        'submit_reply' => 'Responder',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# like}
        other {# likes}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# resposta}
        other {# respostas}
    }',
    'like' => 'Agrádame',
    'reply' => 'Responder',
    'view_replies' => 'Ver respostas ({numberOfReplies})',
    'block_actor' => 'Bloquear usuaria @{actorUsername}',
    'block_domain' => 'Bloquear dominio @{actorDomain}',
    'delete' => 'Eliminar comentario',
];
