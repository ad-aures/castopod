<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Temporada {seasonNumber}',
    'season_abbr' => 'T{seasonNumber}',
    'number' => 'Episódio {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Temporada {seasonNumber} episódio {episodeNumber}',
    'season_episode_abbr' => 'T{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# pessoa}
        other {# pessoas}
    }',
    'persons_list' => 'Pessoas',
    'back_to_episodes' => 'Voltar para episódios de {podcast}',
    'comments' => 'Comentários',
    'activity' => 'Atividade',
    'chapters' => 'Chapters',
    'transcript' => 'Transcript',
    'description' => 'Descrição do episódio',
    'number_of_comments' => '{numberOfComments, plural,
        one {# comentário}
        other {# comentários}
    }',
    'all_podcast_episodes' => 'Todos os episódios de podcast',
    'back_to_podcast' => 'Voltar para o podcast',
    'preview' => [
        'title' => 'Pré-visualizar',
        'not_published' => 'Não publicado',
        'text' => '{publication_status, select,
            published {Esse episódio ainda não foi publicado.}
            scheduled {Esse episódio está agendado para publicação em {publication_date}.}
            with_podcast {Esse episódio será publicado ao mesmo tempo que o podcast. .}
            other {Esse episódio ainda não foi publicado.}
        }',
        'publish' => 'Publicar',
        'publish_edit' => 'Editar Publicação',
    ],
    'no_chapters' => 'No chapters are available for this episode.',
    'download_transcript' => 'Download transcript ({extension})',
    'no_transcript' => 'No transcript available for this episode.',
];
