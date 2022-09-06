<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Comentari de {actorDisplayName} per {episodeTitle}",
    'back_to_comments' => 'Retornar als comentaris',
    'form' => [
        'episode_message_placeholder' => 'Escriviu un comentari...',
        'reply_to_placeholder' => 'Respondre a @{actorUsername}',
        'submit' => 'Enviar',
        'submit_reply' => 'Respondre',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# m\'agrada}
        other {# m\'agrada}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# resposta}
        other {# respostes}
    }',
    'like' => 'M\'agrada',
    'reply' => 'Respondre',
    'view_replies' => 'Veure respostes ({numberOfReplies})',
    'block_actor' => 'Bloquejar l\'usuari @{actorUsername}',
    'block_domain' => 'Bloquejar el domini @{actorDomain}',
    'delete' => 'Esborrar el comentari',
];
