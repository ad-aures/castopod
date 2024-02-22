<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Temporada: {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Episodio {episodeNumber}',
    'number_abbr' => 'Episodio {episodeNumber}',
    'season_episode' => 'Temporada {seasonNumber} episodio {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# persona}
        other {# personas}
    }',
    'persons_list' => 'Personas',
    'back_to_episodes' => 'Volver a los episodios de {podcast}',
    'comments' => 'Comentarios',
    'activity' => 'Actividad',
    'chapters' => 'Chapters',
    'description' => 'Descripción del episodio',
    'number_of_comments' => '{numberOfComments, plural,
        one {# comentario}
        other {# comentarios}
    }',
    'all_podcast_episodes' => 'Todos los episodios del podcast',
    'back_to_podcast' => 'Regresar al podcast',
    'preview' => [
        'title' => 'Preview',
        'not_published' => 'Sin publicar',
        'text' => '{publication_status, select,
            published {This episode is not yet published.}
            scheduled {This episode is scheduled for publication on {publication_date}.}
            with_podcast {This episode will be published at the same time as the podcast.}
            other {This episode is not yet published.}
        }',
        'publish' => 'Publish',
        'publish_edit' => 'Edit publication',
    ],
    'no_chapters' => 'No chapters are available for this episode.',
];
