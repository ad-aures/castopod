<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Comentário de {actorDisplayName} para {episodeTitle}",
    'back_to_comments' => 'Voltar aos comentários',
    'form' => [
        'episode_message_placeholder' => 'Escrever um comentário…',
        'reply_to_placeholder' => 'Responder a @{actorUsername}',
        'submit' => 'Enviar',
        'submit_reply' => 'Responder',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# like}
        other {# likes}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# reply}
        other {# replies}
    }',
    'like' => 'Gostar
Gosto',
    'reply' => 'Responder',
    'view_replies' => 'Ver respostas ({numberOfReplies})',
    'block_actor' => 'Bloquear utilizador @{actorUsername}',
    'block_domain' => 'Blloquear domínio @{actorDomain}',
    'delete' => 'Eliminar comentário',
];
