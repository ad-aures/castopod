<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'feed' => 'Fuente del RSS del Podcast',
    'season' => 'Temporada: {seasonNumber}',
    'list_of_episodes_year' => '{year} episodios ({episodeCount})',
    'list_of_episodes_season' =>
        'Temporada {seasonNumber} episodio {episodeCount})',
    'no_episode' => '¡No se encontró el episodio!',
    'follow' => 'Seguir',
    'followTitle' => '¡Sigue a {actorDisplayName} en el fediverso!',
    'followers' => '{numberOfFollowers, plural,
        one {<span class="font-semibold">#</span> seguidor}
        other {<span class="font-semibold">#</span> seguidores}
    }',
    'posts' => '{numberOfPosts, plural,
        one {<span class="font-semibold">#</span> publicación}
        other {<span class="font-semibold">#</span> publicaciones}
    }',
    'activity' => 'Actividad',
    'episodes' => 'Episodios',
    'episodes_title' => 'Episodios de {podcastTitle}',
    'about' => 'Acerca de',
    'stats' => [
        'title' => 'Estadísticas',
        'number_of_seasons' => '{0, plural,
            one {<span class="font-semibold">#</span> temporada}
            other {<span class="font-semibold">#</span> temporadas}
        }',
        'number_of_episodes' => '{0, plural,
            one {<span class="font-semibold">#</span> episodio}
            other {<span class="font-semibold">#</span> episodios}
        }',
        'first_published_at' => 'Primer episodio publicado en <span class="font-semibold">{0, date, medium}</span>',
    ],
    'sponsor' => 'Patrocinador',
    'funding_links' => 'Enlaces de financiación para {podcastTitle}',
    'find_on' => 'Buscar {podcastTitle} en',
    'listen_on' => 'Escuchar en',
    'persons' => '{personsCount, plural,
        one {# persona}
        other {# personas}
    }',
    'persons_list' => 'Personas',
];
