<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "دیدگاه {actorDisplayName} روی {episodeTitle}",
    'back_to_comments' => 'بازکشت به نظرها',
    'form' => [
        'episode_message_placeholder' => 'نوشتن دیدگاه…',
        'reply_to_placeholder' => 'پاسخ به ‪@{actorUsername}‬',
        'submit' => 'فرستادن',
        'submit_reply' => 'پاسخ',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# like}
        other {# likes}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# reply}
        other {# replies}
    }',
    'like' => 'پسند',
    'reply' => 'پاسخ',
    'view_replies' => 'دیدن پاسخ‌ها ({numberOfReplies})',
    'block_actor' => 'انسداد کاربر ‪@{actorUsername}‬',
    'block_domain' => 'انسداد دامنهٔ ‪@{actorDomain}‬',
    'delete' => 'حذف دیدگاه',
];
