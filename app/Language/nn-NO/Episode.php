<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Sesong {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Episode {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Sesong {seasonNumber} episode {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# person}
        other {# personar}
    }',
    'persons_list' => 'Personar',
    'back_to_episodes' => 'Tilbake til episodane av {podcast}',
    'comments' => 'Kommentarar',
    'activity' => 'Aktivitet',
    'description' => 'Skildring av episoden',
    'number_of_comments' => '{numberOfComments, plural,
        one {# kommentar}
        other {# kommentarar}
    }',
    'all_podcast_episodes' => 'Alle podkast-episodane',
    'back_to_podcast' => 'Gå tilbake til podkasten',
    'preview' => [
        'title' => 'Førehandsvising',
        'not_published' => 'Ikkje lagt ut',
        'text' => '{publication_status, select,
            published {Episoden er ikkje lagt ut enno.}
            scheduled {Episoden er planlagt lagt ut på {publication_date}.}
            with_podcast {Denne episoden blir lagt ut samstundes som podkasten.}
            other {Denne episoden er ikkje lagt ut enno.}
        }',
        'publish' => 'Legg ut',
        'publish_edit' => 'Rediger publiseringa',
    ],
];
