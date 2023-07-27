<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "فرستهٔ {actorDisplayName}",
    'back_to_actor_posts' => 'بازگشت به فرسته‌های {actor}',
    'actor_shared' => '{actor} هم‌رساند',
    'reply_to' => 'پاسخ به ‪@{actorUsername}‬',
    'form' => [
        'message_placeholder' => 'نوشتن پیام…',
        'episode_message_placeholder' => 'نوشتن پیامی برای قسمت…',
        'episode_url_placeholder' => 'نشانی قسمت',
        'reply_to_placeholder' => 'پاسخ به ‪@{actorUsername}‬',
        'submit' => 'فرستادن',
        'submit_reply' => 'پاسخ',
    ],
    'favourites' => '{numberOfFavourites, plural,
        other {# برگزیده}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        other {# هم‌رسانی}
    }',
    'replies' => '{numberOfReplies, plural,
        other {# پاسخ}
    }',
    'expand' => 'گسترش فرسته',
    'block_actor' => 'انسداد کاربر ‪@{actorUsername}‬',
    'block_domain' => 'انسداد دامنهٔ ‪@{actorDomain}‬',
    'delete' => 'حذف فرسته',
];
