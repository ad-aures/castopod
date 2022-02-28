<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'feed' => 'Kanał RSS Podkastu',
    'season' => 'Sezon {seasonNumber}',
    'list_of_episodes_year' => '{year} odcinków ({episodeCount})',
    'list_of_episodes_season' =>
        'Sezon {seasonNumber} odcinki ({episodeCount})',
    'no_episode' => 'Nie znaleziono odcinków!',
    'follow' => 'Obserwuj',
    'followTitle' => 'Obserwuj {actorDisplayName} na fediverse!',
    'followers' => '{numberOfFollowers, plural,
        one {<span class="font-semibold">#</span> obserwujący}
        other {<span class="font-semibold">#</span> obserwujących}
    }',
    'posts' => '{numberOfPosts, plural,
        one {<span class="font-semibold">#</span> wpis}
        other {Wpisów: <span class="font-semibold">#</span>}
    }',
    'activity' => 'Aktywność',
    'episodes' => 'Odcinki',
    'episodes_title' => 'Odcinki {podcastTitle}',
    'about' => 'Informacje',
    'stats' => [
        'title' => 'Statystyki',
        'number_of_seasons' => '{0, plural,
            one {<span class="font-semibold">#</span> sezon}
            other {Sezonów: <span class="font-semibold">#</span>}
        }',
        'number_of_episodes' => '{0, plural,
            one {<span class="font-semibold">#</span> odcinek}
            other {Odcinków: <span class="font-semibold">#</span>}
        }',
        'first_published_at' => 'Pierwszy odcinek opublikowany <span class="font-semibold">{0, date, medium}</span>',
    ],
    'sponsor' => 'Sponsoruj',
    'funding_links' => 'Linki finansowania dla {podcastTitle}',
    'find_on' => 'Znajdź {podcastTitle} na',
    'listen_on' => 'Słuchaj na',
    'persons' => '{personsCount, plural,
        one {# osoba}
        other {osób: #}
    }',
    'persons_list' => 'Osoby',
];
