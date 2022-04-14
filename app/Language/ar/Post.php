<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName}'s post",
    'back_to_actor_posts' => 'العودة إلى منشورات {actor}',
    'actor_shared' => 'شاركه {actor}',
    'reply_to' => 'رد على @{actorUsername}',
    'form' => [
        'message_placeholder' => 'اكتب رسالة…',
        'episode_message_placeholder' => 'Write a message for the episode…',
        'episode_url_placeholder' => 'الوصلة الشبكية للبودكاست',
        'reply_to_placeholder' => 'رد على @{actorUsername}',
        'submit' => 'ارسل',
        'submit_reply' => 'رد',
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
    'expand' => 'Expand post',
    'block_actor' => 'احجب المستخدم @{actorUsername}',
    'block_domain' => 'احجب النطاق @{actorDomain}',
    'delete' => 'احذف المنشور',
];
