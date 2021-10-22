<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName}'s comment for {episodeTitle}",
    'back_to_comments' => 'Back to comments',
    'form' => [
        'episode_message_placeholder' => 'Write a comment...',
        'reply_to_placeholder' => 'Reply to @{actorUsername}',
        'submit' => 'Send',
        'submit_reply' => 'Reply',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# like}
        other {# likes}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# reply}
        other {# replies}
    }',
    'like' => 'Like',
    'reply' => 'Reply',
    'view_replies' => 'View replies ({numberOfReplies})',
    'block_actor' => 'Block user @{actorUsername}',
    'block_domain' => 'Block domain @{actorDomain}',
    'delete' => 'Delete comment',
];
