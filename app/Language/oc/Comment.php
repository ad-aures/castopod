<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Lo comentari de {actorDisplayName} per {episodeTitle}",
    'back_to_comments' => 'Tornar als comentaris',
    'form' => [
        'episode_message_placeholder' => 'Escriure un comentari…',
        'reply_to_placeholder' => 'Respondre @{actorUsername}',
        'submit' => 'Enviar',
        'submit_reply' => 'Respondre',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# m\'agrada}
        other {# m\'agrada}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# responsa}
        other {# responsas}
    }',
    'like' => 'M\'agrada',
    'reply' => 'Respondre',
    'view_replies' => 'Veire las responsas ({numberOfReplies})',
    'block_actor' => 'Blocar l’utilizaire @{actorUsername}',
    'block_domain' => 'Blocar lo domeni @{actorDomain}',
    'delete' => 'Suprimir lo comentari',
];
