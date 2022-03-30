<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Comentário de {actorDisplayName} para {episodeTitle}",
    'back_to_comments' => 'Voltar para comentários',
    'form' => [
        'episode_message_placeholder' => 'Escreva um comentário…',
        'reply_to_placeholder' => 'Responder a @{actorUsername}',
        'submit' => 'Enviar',
        'submit_reply' => 'Responder',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# curtida}
        other {# curtidas}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# resposta}
        other {# respostas}
    }',
    'like' => 'Curtida',
    'reply' => 'Resposta',
    'view_replies' => 'Visualizar respostas ({numberOfReplies})',
    'block_actor' => 'Bloquear usuário @{actorUsername}',
    'block_domain' => 'Bloquear domínio @{actorDomain}',
    'delete' => 'Apagar comentário',
];
