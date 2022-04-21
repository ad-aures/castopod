<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'feed' => 'RSS-лента подкастов',
    'season' => 'Сезон: {seasonNumber}',
    'list_of_episodes_year' => '{year} эпизодов ({episodeCount})',
    'list_of_episodes_season' =>
        'Сезон {seasonNumber} серий ({episodeCount})',
    'no_episode' => 'Серии не найдены!',
    'follow' => 'Подписаться',
    'followTitle' => 'Подпишитесь на {actorDisplayName} в федивёрсе!',
    'followers' => '{numberOfFollowers, plural,
        one {# подписчик}
        few {# подписчики}
        many {# подписчики}
        other {# подписчики}
    }',
    'posts' => '{numberOfPosts, plural,
        one {# пост}
        few {# постов}
        many {# постов}
        other {# постов}
    }',
    'activity' => 'Активность',
    'episodes' => 'Выпуски',
    'episodes_title' => 'Выпуски {podcastTitle}',
    'about' => 'О нас',
    'stats' => [
        'title' => 'Статистика',
        'number_of_seasons' => '{0, plural,
            one {# сезон}
            few {# сезоны}
            many {# сезоны}
            other {# сезоны}
        }',
        'number_of_episodes' => '{0, plural,
            one {# эпизод}
            few {# эпизодов}
            many {# эпизодов}
            other {# эпизодов}
        }',
        'first_published_at' => 'Первый эпизод опубликован {0, date, medium}',
    ],
    'sponsor' => 'Спонсор',
    'funding_links' => 'Ссылки на финансирование для {podcastTitle}',
    'find_on' => 'Найти {podcastTitle} на',
    'listen_on' => 'Слушать в',
    'persons' => '{personsCount, plural,
        one {# человек}
        few {# человек}
        many {# человек}
        other {# человек}
    }',
    'persons_list' => 'Лица',
];
