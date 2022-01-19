<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'feed' => 'RSS du Podcast',
    'season' => 'Saison {seasonNumber}',
    'list_of_episodes_year' => 'Épisodes de {year} ({episodeCount})',
    'list_of_episodes_season' =>
        'Épisodes de la saison {seasonNumber} ({episodeCount})',
    'no_episode' => 'Aucun épisode trouvé !',
    'follow' => 'Suivre',
    'followTitle' => 'Suivez {actorDisplayName} sur le fédiverse !',
    'followers' => '{numberOfFollowers, plural,
        one {<span class="font-semibold">#</span> abonné·e}
        other {<span class="font-semibold">#</span> abonné·e·s}
    }',
    'posts' => '{numberOfPosts, plural,
        one {<span class="font-semibold">#</span> publication}
        other {<span class="font-semibold">#</span> publications}
    }',
    'activity' => 'Activité',
    'episodes' => 'Épisodes',
    'about' => 'À propos',
    'stats' => [
        'title' => 'Statistiques',
        'number_of_seasons' => '{0, plural,
            one {<span class="font-semibold">#</span> saison}
            other {<span class="font-semibold">#</span> saisons}
        }',
        'number_of_episodes' => '{0, plural,
            one {<span class="font-semibold">#</span> épisode}
            other {<span class="font-semibold">#</span> épisodes}
        }',
        'first_published_at' => 'Premier épisode publié le <span class="font-semibold">{0, date, medium}</span>',
    ],
    'sponsor' => 'Soutenez-nous',
    'funding_links' => 'Liens de financement pour {podcastTitle}',
    'find_on' => 'Trouvez {podcastTitle} sur',
    'listen_on' => 'Écoutez sur',
    'persons' => '{personsCount, plural,
        one {# intervenant·e}
        other {# intervenant·e·s}
    }',
    'persons_list' => 'Intervenant·e·s',
];
