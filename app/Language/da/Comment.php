<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName}s kommentar til {episodeTitle}",
    'back_to_comments' => 'Tilbage til kommentarer',
    'form' => [
        'episode_message_placeholder' => 'Skriv en kommentar…',
        'reply_to_placeholder' => 'Svar til @{actorUsername}',
        'submit' => 'Send',
        'submit_reply' => 'Svar',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# kan lide}
        other {# kan lide}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# svar}
        other {# svar}
    }',
    'like' => 'Synes godt om',
    'reply' => 'Svar',
    'view_replies' => 'Se svar ({numberOfReplies})',
    'block_actor' => 'Blokér bruger @{actorUsername}',
    'block_domain' => 'Blokér domænet @{actorDomain}',
    'delete' => 'Slet kommentar',
];
