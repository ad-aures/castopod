<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Comentarios de {actorDisplayName} para {episodeTitle}",
    'back_to_comments' => 'Volver a los comentarios',
    'form' => [
        'episode_message_placeholder' => 'Escribir un comentario…',
        'reply_to_placeholder' => 'Responder a @{actorUsername}',
        'submit' => 'Enviar',
        'submit_reply' => 'Responder',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# Me gusta}
        other {# Me gusta}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# respuesta}
        other {# respuestas}
    }',
    'like' => 'Me gusta',
    'reply' => 'Responder',
    'view_replies' => 'Ver respuestas ({numberOfReplies})',
    'block_actor' => 'Bloquear usuario @{actorUsername}',
    'block_domain' => 'Bloquear dominio @{actorDomain}',
    'delete' => 'Borrar comentario',
];
