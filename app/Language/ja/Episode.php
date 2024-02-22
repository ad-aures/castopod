<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'シーズン {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'エピソード {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'シーズン {seasonNumber} エピソード {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# person}
        other {# persons}
    }',
    'persons_list' => 'Persons',
    'back_to_episodes' => '{podcast} のエピソードに戻る',
    'comments' => 'コメント',
    'activity' => 'アクティビティ',
    'chapters' => 'Chapters',
    'description' => 'Episode description',
    'number_of_comments' => '{numberOfComments, plural,
        one {# comment}
        other {# comments}
    }',
    'all_podcast_episodes' => 'All podcast episodes',
    'back_to_podcast' => 'ポッドキャストへ戻る',
    'preview' => [
        'title' => 'プレビュー',
        'not_published' => 'Not published',
        'text' => '{publication_status, select,
            published {This episode is not yet published.}
            scheduled {This episode is scheduled for publication on {publication_date}.}
            with_podcast {This episode will be published at the same time as the podcast.}
            other {This episode is not yet published.}
        }',
        'publish' => '公開する',
        'publish_edit' => 'Edit publication',
    ],
    'no_chapters' => 'No chapters are available for this episode.',
];
