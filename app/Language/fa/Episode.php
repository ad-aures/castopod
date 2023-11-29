<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'فصل {seasonNumber}',
    'season_abbr' => 'ف{seasonNumber}',
    'number' => 'قسمت {episodeNumber}',
    'number_abbr' => 'ق. {episodeNumber}',
    'season_episode' => 'قسمت {episodeNumber} فصل {seasonNumber}',
    'season_episode_abbr' => 'ف{seasonNumber}: ق{episodeNumber}',
    'persons' => '{personsCount, plural,
        other {# نفر}
    }',
    'persons_list' => 'نفر',
    'back_to_episodes' => 'بازگشت به قسمت‌های {podcast}',
    'comments' => 'دیدگاه‌ها',
    'activity' => 'فعّالیت',
    'description' => 'شرح قسمت',
    'number_of_comments' => '{numberOfComments, plural,
        other {# نظر}
    }',
    'all_podcast_episodes' => 'تمامی قسمت‌های پادکست',
    'back_to_podcast' => 'بازگشت به پادکست',
    'preview' => [
        'title' => 'Preview',
        'not_published' => 'Not published',
        'text' => '{publication_status, select,
            published {This episode is not yet published.}
            scheduled {This episode is scheduled for publication on {publication_date}.}
            with_podcast {This episode will be published at the same time as the podcast.}
            other {This episode is not yet published.}
        }',
        'publish' => 'Publish',
        'publish_edit' => 'Edit publication',
    ],
];
