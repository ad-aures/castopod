<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'feed' => 'RSS Podcast feed',
    'season' => 'Season {seasonNumber}',
    'list_of_episodes_year' => 'حلَقات {year} ({episodeCount})',
    'list_of_episodes_season' =>
        'Season {seasonNumber} episodes ({episodeCount})',
    'no_episode' => 'No episode found!',
    'follow' => 'متابعة',
    'followTitle' => 'Follow {actorDisplayName} on the fediverse!',
    'followers' => '{numberOfFollowers, plural,
        one {<span class="font-semibold">#</span> follower}
        other {<span class="font-semibold">#</span> followers}
    }',
    'posts' => '{numberOfPosts, plural,
        one {<span class="font-semibold">#</span> post}
        other {<span class="font-semibold">#</span> posts}
    }',
    'activity' => 'النشاط',
    'episodes' => 'الحلقات',
    'episodes_title' => 'حلقات {podcastTitle}',
    'about' => 'عن',
    'stats' => [
        'title' => 'الإحصائيات',
        'number_of_seasons' => '{0, plural,
            one {<span class="font-semibold">#</span> season}
            other {<span class="font-semibold">#</span> seasons}
        }',
        'number_of_episodes' => '{0, plural,
            one {<span class="font-semibold">#</span> episode}
            other {<span class="font-semibold">#</span> episodes}
        }',
        'first_published_at' => 'First episode published on <span class="font-semibold">{0, date, medium}</span>',
    ],
    'sponsor' => 'Sponsor',
    'funding_links' => 'Funding links for {podcastTitle}',
    'find_on' => 'Find {podcastTitle} on',
    'listen_on' => 'Listen on',
    'persons' => '{personsCount, plural,
        one {# person}
        other {# persons}
    }',
    'persons_list' => 'أشخاص',
];
