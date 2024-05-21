<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName}' 對於 {episodeTitle} 之評論",
    'back_to_comments' => '返回到評論',
    'form' => [
        'episode_message_placeholder' => '發表留言...',
        'reply_to_placeholder' => '回覆 @{actorUsername}',
        'submit' => '送出',
        'submit_reply' => '回覆',
    ],
    'likes' => '{numberOfLikes, plural,
        other {# 讚}
    }',
    'replies' => '{numberOfReplies, plural,
        other {# 回覆}
    }',
    'like' => '讚',
    'reply' => '回覆',
    'view_replies' => '檢視回覆 ({numberOfReplies})',
    'block_actor' => '封鎖使用者 @{actorUsername}',
    'block_domain' => '封鎖網域 @{actorDomain}',
    'delete' => '刪除評論',
];
