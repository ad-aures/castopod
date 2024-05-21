<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => '第{seasonNumber} 季',
    'season_abbr' => 'S{seasonNumber}',
    'number' => '第 {episodeNumber} 集',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => '第{seasonNumber} 季第{episodeNumber} 集',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# person}
        other {# persons}
    }',
    'persons_list' => '人物',
    'back_to_episodes' => '回到劇集 {podcast} 中',
    'comments' => '註釋',
    'activity' => '活動',
    'chapters' => '章',
    'transcript' => 'Transcript',
    'description' => '節目介紹',
    'number_of_comments' => '{numberOfComments, plural,
        one {# 評論}
        other {# 評論}
    }',
    'all_podcast_episodes' => '所有播客劇集',
    'back_to_podcast' => '返回至播客',
    'preview' => [
        'title' => '預覽',
        'not_published' => '未發佈',
        'text' => '{publication_status, select,
            published {本集尚未發佈。}
            scheduled {本集排程於 {publication_date} 發佈}
            with_podcast {本集將會與此播客同時發佈。}
            other {本集尚未發佈。}
        }',
        'publish' => '發佈',
        'publish_edit' => '編輯公開程度',
    ],
    'no_chapters' => '本劇集未有章節',
    'download_transcript' => 'Download transcript ({extension})',
    'no_transcript' => 'No transcript available for this episode.',
];
