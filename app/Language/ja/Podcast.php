<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'feed' => 'RSS PodCastフィード',
    'season' => 'シーズン {seasonNumber}',
    'list_of_episodes_year' => '{year} エピソード ({episodeCount})',
    'list_of_episodes_season' =>
        'シーズン {seasonNumber} エピソード（{episodeCount}）',
    'no_episode' => 'エピソードが見つかりませんでした',
    'follow' => 'フォロー',
    'followTitle' => 'Fediverseで {actorDisplayName} をフォロー！',
    'followers' => '{numberOfFollowers, plural,
        other {# 人のフォロワー}
    }',
    'posts' => '{numberOfPosts, plural,
        other {#件の投稿}
    }',
    'links' => 'リンク',
    'activity' => 'アクティビティー',
    'episodes' => 'エピソード',
    'episodes_title' => '{podcastTitle} のエピソード',
    'about' => '概要',
    'stats' => [
        'title' => '統計',
        'number_of_seasons' => '{0, plural,
            one {# season}
            other {# seasons}
        }',
        'number_of_episodes' => '{0, plural,
            one {# episode}
            other {# episodes}
        }',
        'first_published_at' => '初回は{0, date, medium} に投稿されました。',
    ],
    'sponsor' => 'スポンサー',
    'funding_links' => '{podcastTitle} のリンクを探す',
    'find_on' => '{podcastTitle} を検索',
    'listen_on' => '視聴中',
    'persons' => '{personsCount, plural,
        one {# person}
        other {# persons}
    }',
    'persons_list' => '人数',
    'castopod_website' => 'Castopod (公式ページ)',
];
