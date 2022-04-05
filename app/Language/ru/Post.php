<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "сообщение от {actorDisplayName}",
    'back_to_actor_posts' => 'Вернуться к сообщениям от {actor}',
    'actor_shared' => 'поделилиться записями {actor}',
    'reply_to' => 'Ответить @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Написать сообщение…',
        'episode_message_placeholder' => 'Написать сообщение о серии…',
        'episode_url_placeholder' => 'URL эпизода',
        'reply_to_placeholder' => 'Ответить @{actorUsername}',
        'submit' => 'Отправить',
        'submit_reply' => 'Ответ',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# один}
        few {# немного}
        many {# много}
        other {# другие}
    }',
    'reblogs' => '{numberOfReblogs, plural,
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
    'expand' => 'Развернуть пост',
    'block_actor' => 'Заблокировать пользователя @{actorUsername}',
    'block_domain' => 'Заблокировать домен @{actorDomain}',
    'delete' => 'Удалить пост',
];
