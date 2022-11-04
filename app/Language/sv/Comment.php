<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName}s kommentar till {episodeTitle}",
    'back_to_comments' => 'Tillbaka till kommentarer',
    'form' => [
        'episode_message_placeholder' => 'Skriv en kommentar…',
        'reply_to_placeholder' => 'Svara på @{actorUsername}',
        'submit' => 'Skicka',
        'submit_reply' => 'Svara',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# gillar}
        other {# gillar}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# svar}
        other {# svar}
    }',
    'like' => 'Gilla',
    'reply' => 'Svara',
    'view_replies' => 'Visa svar ({numberOfReplies})',
    'block_actor' => 'Blockera användare @{actorUsername}',
    'block_domain' => 'Blockera domän @{actorDomain}',
    'delete' => 'Radera kommentar',
];
