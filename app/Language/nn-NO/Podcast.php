<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'feed' => 'RSS-straum for podkasten',
    'season' => 'Sesong {seasonNumber}',
    'list_of_episodes_year' => '{year}-episodar ({episodeCount})',
    'list_of_episodes_season' =>
        'Sesong {seasonNumber}-episodar ({episodeCount})',
    'no_episode' => 'Fann ingen episode!',
    'follow' => 'Fylg',
    'followTitle' => 'Fylg {actorDisplayName} på fødiverset!',
    'followers' => '{numberOfFollowers, plural,
        one {<span class="font-semibold">#</span> fylgjar}
        other {<span class="font-semibold">#</span> fylgjarar}
    }',
    'posts' => '{numberOfPosts, plural,
        one {<span class="font-semibold">#</span> innlegg}
        other {<span class="font-semibold">#</span> innlegg}
    }',
    'activity' => 'Aktivitet',
    'episodes' => 'Episodar',
    'episodes_title' => 'Episodar av {podcastTitle}',
    'about' => 'Om',
    'stats' => [
        'title' => 'Statistikk',
        'number_of_seasons' => '{0, plural,
            one {<span class="font-semibold">#</span> sesong}
            other {<span class="font-semibold">#</span> sesongar}
        }',
        'number_of_episodes' => '{0, plural,
            one {<span class="font-semibold">#</span> episode}
            other {<span class="font-semibold">#</span> episodar}
        }',
        'first_published_at' => 'Den fyrste episoden vart lagt ut <span class="font-semibold">{0, date, medium}</span>',
    ],
    'sponsor' => 'Sponsor',
    'funding_links' => 'Finansieringslenker for {podcastTitle}',
    'find_on' => 'Finn {podcastTitle} på',
    'listen_on' => 'Høyr på',
    'persons' => '{personsCount, plural,
        one {# person}
        other {# personar}
    }',
    'persons_list' => 'Personar',
];
