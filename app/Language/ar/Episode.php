<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'الموسم {seasonNumber}',
    'season_abbr' => 'م{seasonNumber}',
    'number' => 'الحلقة {episodeNumber}',
    'number_abbr' => 'الحلقة {episodeNumber}',
    'season_episode' => 'الموسم {seasonNumber} الحلقة {episodeNumber}',
    'season_episode_abbr' => 'م{seasonNumber}:ح{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# person}
        other {# persons}
    }',
    'persons_list' => 'أشخاص',
    'back_to_episodes' => 'العودة إلى حلقات {podcast}',
    'comments' => 'التعليقات',
    'activity' => 'النشاط',
    'chapters' => 'Chapters',
    'description' => 'وصف الحلقة',
    'number_of_comments' => '{numberOfComments, plural,
        one {# comment}
        other {# comments}
    }',
    'all_podcast_episodes' => 'كافة حلقات البودكاست',
    'back_to_podcast' => 'العودة إلى البودكاست',
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
    'no_chapters' => 'No chapters are available for this episode.',
];
