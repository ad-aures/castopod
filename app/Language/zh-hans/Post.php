<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName} 的帖子",
    'back_to_actor_posts' => '返回 {actor} 的帖子',
    'actor_shared' => '{actor} 已分享',
    'reply_to' => '回复给 @{actorUsername}',
    'form' => [
        'message_placeholder' => '输入消息...',
        'episode_message_placeholder' => '为剧集写一条消息…',
        'episode_url_placeholder' => '剧集网址',
        'reply_to_placeholder' => '回复给 @{actorUsername}',
        'submit' => '发送',
        'submit_reply' => '回复',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# 喜欢}
        other {# 喜欢}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# 分享}
        other {# 分享}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# 回复}
        other {# 回复}
    }',
    'expand' => '展开帖子',
    'block_actor' => '屏蔽用户 @{actorUsername}',
    'block_domain' => '屏蔽来自 @{actorDomain} 的内容',
    'delete' => '删除帖子',
];
