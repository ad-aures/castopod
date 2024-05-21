<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName} 在 {episodeTitle} 的评论",
    'back_to_comments' => '返回评论页面',
    'form' => [
        'episode_message_placeholder' => '写点儿评论吧...',
        'reply_to_placeholder' => '回复给 @{actorUsername}',
        'submit' => '发送',
        'submit_reply' => '回复',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# 喜欢}
        other {# 喜欢}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# 回复}
        other {# 回复}
    }',
    'like' => '喜欢',
    'reply' => '回复',
    'view_replies' => '查看回复 ({numberOfReplies})',
    'block_actor' => '屏蔽用户 @{actorUsername}',
    'block_domain' => '屏蔽来自 @{actorDomain} 的内容',
    'delete' => '删除评论',
];
