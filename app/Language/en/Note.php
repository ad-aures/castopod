<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName}'s Note",
    'back_to_actor_notes' => 'Back to {actor} notes',
    'actor_shared' => '{actor} shared',
    'reply_to' => 'Reply to @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Write a message...',
        'episode_message_placeholder' => 'Write a message for the episode...',
        'episode_url_placeholder' => 'Episode URL',
        'reply_to_placeholder' => 'Reply to @{actorUsername}',
        'submit' => 'Send!',
        'submit_reply' => 'Reply',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# favourite}
        other {# favourites}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# share}
        other {# shares}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# reply}
        other {# replies}
    }',
    'expand' => 'Expand note',
    'block_actor' => 'Block user @{actorUsername}',
    'block_domain' => 'Block domain @{actorDomain}',
    'delete' => 'Delete note',
];
