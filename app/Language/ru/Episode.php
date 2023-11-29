<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Сезон: {seasonNumber}',
    'season_abbr' => 'С{seasonNumber}',
    'number' => 'Эпизод {episodeNumber}',
    'number_abbr' => 'Еп. {episodeNumber}',
    'season_episode' => 'Сезон {seasonNumber} серия {episodeNumber}',
    'season_episode_abbr' => 'С{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# человек}
        few {# человек}
        many {# людей}
        other {# люди}
    }',
    'persons_list' => 'Персоны',
    'back_to_episodes' => 'Вернуться к эпизодам {podcast}',
    'comments' => 'Комментарии',
    'activity' => 'Активность',
    'description' => 'Описание серии',
    'number_of_comments' => '{numberOfComments, plural,
        one {# комментарий}
        few {# комментариев}
        many {# комментариев}
        other {# комментариев}
    }',
    'all_podcast_episodes' => 'Все выпуски подкаста',
    'back_to_podcast' => 'Вернуться к подкасту',
    'preview' => [
        'title' => 'Предпросмотр',
        'not_published' => 'Не опубликовано',
        'text' => '{publication_status, select,
            published {Этот эпизод еще не опубликован.}
            scheduled {Этот эпизод запланирован на {publication_date}.}
            with_podcast {Этот эпизод будет опубликован одновременно с подкастом.}
            other {Этот эпизод еще не опубликован.}
        }',
        'publish' => 'Опубликовать',
        'publish_edit' => 'Редактировать публикацию',
    ],
];
