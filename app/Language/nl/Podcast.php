<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'feed' => 'RSS Podcast feed',
    'season' => 'Seizoen {seasonNumber}',
    'list_of_episodes_year' => '{year} afleveringen ({episodeCount})',
    'list_of_episodes_season' =>
        'Seizoen {seasonNumber} afleveringen ({episodeCount})',
    'no_episode' => 'Er zijn geen afleveringen gevonden!',
    'follow' => 'Abonneer',
    'followTitle' => 'Abonneer op {actorDisplayName} via de fediverse!',
    'followers' => '{numberOfFollowers, plural,
        one {<span class="font-semibold">#</span> abonnee}
        other {<span class="font-semibold">#</span> abonnees}
    }',
    'posts' => '{numberOfPosts, plural,
        one {<span class="font-semibold">#</span> bericht}
        other {<span class="font-semibold">#</span> berichten}
    }',
    'activity' => 'Activiteit',
    'episodes' => 'Afleveringen',
    'episodes_title' => 'Afleveringen van {podcastTitle}',
    'about' => 'Over Ons',
    'stats' => [
        'title' => 'Statistieken',
        'number_of_seasons' => '{0, plural,
            one {<span class="font-semibold">#</span> seizoen}
            other {<span class="font-semibold">#</span> seizoenen}
        }',
        'number_of_episodes' => '{0, plural,
            one {<span class="font-semibold">#</span> aflevering}
            other {<span class="font-semibold">#</span> afleveringen}
        }',
        'first_published_at' => 'Eerste aflevering gepubliceerd op <span class="font-semibold">{0, date, medium}</span>',
    ],
    'sponsor' => 'Sponsor',
    'funding_links' => 'Financiering links voor {podcastTitle}',
    'find_on' => 'Vind {podcastTitle} op',
    'listen_on' => 'Luister op',
    'persons' => '{personsCount, plural,
        one {# persoon}
        other {# personen}
    }',
    'persons_list' => 'Personen',
];
