<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName}'s comment for {episodeTitle}",
    'back_to_comments' => 'Повернутися до коментарів',
    'form' => [
        'episode_message_placeholder' => 'Написати коментар…',
        'reply_to_placeholder' => 'Відповісти @{actorUsername}',
        'submit' => 'Відправити',
        'submit_reply' => 'Відповісти',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# like}
        other {# likes}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# reply}
        other {# replies}
    }',
    'like' => 'Вподобайка',
    'reply' => 'Відповідь',
    'view_replies' => 'Переглянути відповіді ({numberOfReplies})',
    'block_actor' => 'Заблокувати користувача @{actorUsername}',
    'block_domain' => 'Заблокувати домен @{actorDomain}',
    'delete' => 'Видалити коментар',
];
