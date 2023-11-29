<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Temporada {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Episodi {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Temporada {seasonNumber} episodi {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# persona}
        other {# persones}
    }',
    'persons_list' => 'Persones',
    'back_to_episodes' => 'Tornar als episodis de {podcast}',
    'comments' => 'Comentaris',
    'activity' => 'Activitat',
    'description' => 'Descripció de l\'episodi',
    'number_of_comments' => '{numberOfComments, plural,
        one {# comentari}
        other {# comentaris}
    }',
    'all_podcast_episodes' => 'Tots els episodis del podcast',
    'back_to_podcast' => 'Tornar al podcast',
    'preview' => [
        'title' => 'Preview',
        'not_published' => 'Not published',
        'text' => '{publication_status, select,
            published {This episode is not yet published.}
            scheduled {This episode is scheduled for publication on {publication_date}.}
            with_podcast {This episode will be published at the same time as the podcast.}
            other {This episode is not yet published.}
        }',
        'publish' => 'Publish',
        'publish_edit' => 'Edit publication',
    ],
];
