<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName} 的貼文",
    'back_to_actor_posts' => '回到 {actor} 的貼文',
    'actor_shared' => '{actor} 已分享',
    'reply_to' => '回覆 @{actorUsername}',
    'form' => [
        'message_placeholder' => '輸入訊息…',
        'episode_message_placeholder' => '替劇集寫一則訊息…',
        'episode_url_placeholder' => '劇集網址',
        'reply_to_placeholder' => '回覆給 @{actorUsername}',
        'submit' => '送出',
        'submit_reply' => '回覆',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# 喜歡}
        other {# 喜歡}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# 分享}
        other {# 分享}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# 回覆}
        other {# 回覆}
    }',
    'expand' => '展開貼文',
    'block_actor' => '封鎖使用者 @{actorUsername}',
    'block_domain' => '封鎖網域 @{actorDomain}',
    'delete' => '刪除貼文',
];
