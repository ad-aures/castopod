<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Sason {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Episòdi {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Sason {seasonNumber} episòdi {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# persona}
        other {# personas}
    }',
    'persons_list' => 'Personas',
    'back_to_episodes' => 'Tornar als episòdis de {podcast}',
    'comments' => 'Comentaris',
    'activity' => 'Activitat',
    'chapters' => 'Chapters',
    'transcript' => 'Transcript',
    'description' => 'Descripcion de l’episòdi',
    'number_of_comments' => '{numberOfComments, plural,
        one {# comentari}
        other {# comentaris}
    }',
    'all_podcast_episodes' => 'Totes los episòdis del podcast',
    'back_to_podcast' => 'Tornar al podcast',
    'preview' => [
        'title' => 'Apercebut',
        'not_published' => 'Non publicat',
        'text' => '{publication_status, select,
            published {Aqueste episòdi es pas encara publicat.}
            scheduled {Aqueste episòdi es planificat per publicacion lo {publication_date}.}
            with_podcast {Aqueste episòdi serà publicat al moment de la publicacion del podcast.}
            other {Aqueste episòdi es pas encara publicat.}
        }',
        'publish' => 'Publicar',
        'publish_edit' => 'Modificar la publicacion',
    ],
    'no_chapters' => 'No chapters are available for this episode.',
    'download_transcript' => 'Download transcript ({extension})',
    'no_transcript' => 'No transcript available for this episode.',
];
