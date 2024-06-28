<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'シーズン {seasonNumber}',
    'season_abbr' => 'シーズン {seasonNumber}',
    'number' => 'エピソード {episodeNumber}',
    'number_abbr' => 'エピソード {episodeNumber}',
    'season_episode' => 'シーズン {seasonNumber} エピソード {episodeNumber}',
    'season_episode_abbr' => 'シーズン{seasonNumber}エピソード{episodeNumber}',
    'persons' => '{personsCount, plural,
        other {# 人}
    }',
    'persons_list' => '人物',
    'back_to_episodes' => '{podcast} のエピソードに戻る',
    'comments' => 'コメント',
    'activity' => 'アクティビティ',
    'chapters' => '章',
    'transcript' => '文字起こし',
    'description' => 'エピソードの詳細',
    'number_of_comments' => '{numberOfComments, plural,
        one {# comment}
        other {# comments}
    }',
    'all_podcast_episodes' => 'すべての Podcast エピソード',
    'back_to_podcast' => 'ポッドキャストへ戻る',
    'preview' => [
        'title' => 'プレビュー',
        'not_published' => '未公開',
        'text' => '{publication_status, select,
            published {このエピソードはまだ公開されていません}
            scheduled {このエピソードは {publication_date} に公開される予定です}
            with_podcast {このエピソードはPodCastと同時に公開されます}
            other {このエピソードはまだ公開されていません。}
        }',
        'publish' => '公開する',
        'publish_edit' => '出版物を編集',
    ],
    'no_chapters' => 'このエピソードにはチャプターがありません。',
    'download_transcript' => '文字起こしをダウンロード ({extension})',
    'no_transcript' => 'このエピソードには文字起こしがありません。',
];
