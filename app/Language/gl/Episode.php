<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Tempada {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Episodio {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Tempada {seasonNumber} episodio {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# persoa}
        other {# persoas}
    }',
    'persons_list' => 'Persoas',
    'back_to_episodes' => 'Volver aos episodios de {podcast}',
    'comments' => 'Comentarios',
    'activity' => 'Actividade',
    'chapters' => 'Capítulos',
    'transcript' => 'Transcript',
    'description' => 'Descrición do episodio',
    'number_of_comments' => '{numberOfComments, plural,
        one {# comentario}
        other {# comentarios}
    }',
    'all_podcast_episodes' => 'Tódolos episodios do podcast',
    'back_to_podcast' => 'Volver ao podcast',
    'preview' => [
        'title' => 'Vista previa',
        'not_published' => 'Sen publicar',
        'text' => '{publication_status, select,
            published {Episodio publicado correctamente.}
            scheduled {Episodio programado correctamente para {publication_date}.}
            with_podcast {Este episodio vaise publicar ao mesmo tempo que o podcast.}
            other {Este episodio aínda non se publicou.}
        }',
        'publish' => 'Publicar',
        'publish_edit' => 'Editar publicación',
    ],
    'no_chapters' => 'Non hai capítulos dispoñibles para este episodio.',
    'download_transcript' => 'Download transcript ({extension})',
    'no_transcript' => 'No transcript available for this episode.',
];
