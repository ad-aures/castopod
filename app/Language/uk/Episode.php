<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Сезон {seasonNumber}',
    'season_abbr' => 'С{seasonNumber}',
    'number' => 'Серія {episodeNumber}',
    'number_abbr' => 'Серія {episodeNumber}',
    'season_episode' => 'Сезон {seasonNumber} серія {episodeNumber}',
    'season_episode_abbr' => 'С{seasonNumber}:Е{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# особа}
        few {# осіб}
        many {# осіб}
        other {# осіб}
    }',
    'persons_list' => 'Кіл-сть осіб',
    'back_to_episodes' => 'Повернутись до серій {podcast}',
    'comments' => 'Коментарі',
    'activity' => 'Активність',
    'description' => 'Опис Серії',
    'number_of_comments' => '{numberOfComments, plural,
        one {# коментар}
        few {# коментарів}
        many {# коментарів}
        other {# коментарів}
    }',
    'all_podcast_episodes' => 'Всі серії подкастів',
    'back_to_podcast' => 'Повернутися до подкасту',
    'preview' => [
        'title' => 'Переглянути',
        'not_published' => 'Не опубліковано',
        'text' => '{publication_status, select,
            published {Цей епізод ще не опублікований.}
            scheduled {Цей епізод запланований на публікацію {publication_date}.}
            with_podcast {Цей епізод буде опублікований одночасно з подкастом.}
            other {Цей епізод ще не опублікований.}
        }',
        'publish' => 'Опублікувати',
        'publish_edit' => 'Редагувати публікацію',
    ],
];
