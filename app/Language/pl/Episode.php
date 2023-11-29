<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Sezon {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Odcinek {episodeNumber}',
    'number_abbr' => 'Odc. {episodeNumber}',
    'season_episode' => 'Sezon {seasonNumber} odcinek {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:O{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# osoba}
        few {# osoby}
        other {# osób}
    }',
    'persons_list' => 'Osoby',
    'back_to_episodes' => 'Wróć do odcinków {podcast}',
    'comments' => 'Komentarze',
    'activity' => 'Aktywność',
    'description' => 'Opis odcinka',
    'number_of_comments' => '{numberOfComments, plural,
        one {# komentarz}
        few {# komentarze}
        other {# komentarzy}
    }',
    'all_podcast_episodes' => 'Wszystkie odcinki podcastu',
    'back_to_podcast' => 'Wróć do podkastu',
    'preview' => [
        'title' => 'Podgląd',
        'not_published' => 'Nieopublikowany',
        'text' => '{publication_status, select,
            published {Ten odcinek nie jest jeszcze opublikowany.}
            scheduled {Ten odcinek jest zaplanowany do publikacji {publication_date}.}
            with_podcast {Ten odcinek zostanie opublikowany w tym samym czasie co podcast.}
            other {Ten odcinek nie jest jeszcze opublikowany.}
        }',
        'publish' => 'Opublikuj',
        'publish_edit' => 'Edytuj publikację',
    ],
];
