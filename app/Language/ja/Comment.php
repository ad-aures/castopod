<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName} の {episodeTitle} へのコメント",
    'back_to_comments' => 'コメントに戻る',
    'form' => [
        'episode_message_placeholder' => 'コメントを書く...',
        'reply_to_placeholder' => '@{actorUsername} に返信',
        'submit' => '送信',
        'submit_reply' => '返信する',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# like}
        other {# likes}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# reply}
        other {# replies}
    }',
    'like' => 'いいね',
    'reply' => '返信する',
    'view_replies' => 'View replies ({numberOfReplies})',
    'block_actor' => 'Block user @{actorUsername}',
    'block_domain' => 'Block domain @{actorDomain}',
    'delete' => 'コメントを削除する',
];
