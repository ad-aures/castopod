<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "تعليق {actorDisplayName} على {episodeTitle}",
    'back_to_comments' => 'العودة إلى التعليقات',
    'form' => [
        'episode_message_placeholder' => 'أكتب تعليقاً…',
        'reply_to_placeholder' => 'رد على @{actorUsername}',
        'submit' => 'ارسل',
        'submit_reply' => 'رد',
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
    'reply' => 'رد',
    'view_replies' => 'View replies ({numberOfReplies})',
    'block_actor' => 'Block user @{actorUsername}',
    'block_domain' => 'Block domain @{actorDomain}',
    'delete' => 'احذف التعليق',
];
