<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Комментарий {actorDisplayName} к {episodeTitle}",
    'back_to_comments' => 'Вернуться к комментариям',
    'form' => [
        'episode_message_placeholder' => 'Оставить комментарий…',
        'reply_to_placeholder' => 'Ответить @{actorUsername}',
        'submit' => 'Отправить',
        'submit_reply' => 'Ответ',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# один}
        few {# немного}
        many {# много}
        other {# другие}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# отвечает}
        few {# отвечают}
        many {# отвечают}
        other {# отвечает}
    }',
    'like' => 'Нравится',
    'reply' => 'Ответ',
    'view_replies' => 'Просмотреть ответы ({numberOfReplies})',
    'block_actor' => 'Заблокировать пользователя @{actorUsername}',
    'block_domain' => 'Заблокировать домен @{actorDomain}',
    'delete' => 'Удалить комментарий',
];
