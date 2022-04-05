<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'feed' => 'RSS-feed',
    'season' => 'Staffel {seasonNumber}',
    'list_of_episodes_year' => '{year} Folgen ({episodeCount})',
    'list_of_episodes_season' =>
        'Staffel {seasonNumber} Folgen ({episodeCount})',
    'no_episode' => 'Keine Folge gefunden',
    'follow' => 'Folgen',
    'followTitle' => 'Folge {actorDisplayName} im Fediversum',
    'followers' => '{numberOfFollowers, plural,
        one {<span class="font-semibold">#</span> Follower}
        other {<span class="font-semibold">#</span> Follower}
    }',
    'posts' => '{numberOfPosts, plural,
        one {<span class="font-semibold">#</span> Beitrag}
        other {<span class="font-semibold">#</span> Beiträge}
    }',
    'activity' => 'Aktivitäten',
    'episodes' => 'Folgen',
    'episodes_title' => 'Folgen von {podcastTitle}',
    'about' => 'Über',
    'stats' => [
        'title' => 'Statistiken',
        'number_of_seasons' => '{0, plural,
            one {<span class="font-semibold">#</span> Staffel}
            other {<span class="font-semibold">#</span> Staffeln}
        }',
        'number_of_episodes' => '{0, plural,
            one {<span class="font-semibold">#</span> Folge}
            other {<span class="font-semibold">#</span> Folgen}
        }',
        'first_published_at' => 'Erste Folge veröffentlicht am <span class="font-semibold">{0, date, medium}</span>',
    ],
    'sponsor' => 'Unterstützer',
    'funding_links' => 'Links zur Finanzierung von {podcastTitle}',
    'find_on' => 'Finde {podcastTitle} auf',
    'listen_on' => 'Hören auf',
    'persons' => '{personsCount, plural,
        one {# Person}
        other {# Personen}
    }',
    'persons_list' => 'Personen',
];
