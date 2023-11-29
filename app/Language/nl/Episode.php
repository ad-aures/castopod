<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Seizoen {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Aflevering {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Seizoen {seasonNumber} aflevering {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# persoon}
        other {# personen}
    }',
    'persons_list' => 'Personen',
    'back_to_episodes' => 'Terug naar de afleveringen van {podcast}',
    'comments' => 'Reacties',
    'activity' => 'Activiteiten',
    'description' => 'Omschrijving aflevering',
    'number_of_comments' => '{numberOfComments, plural,
        one {# reactie}
        other {# reacties}
    }',
    'all_podcast_episodes' => 'Alle podcast afleveringen',
    'back_to_podcast' => 'Terug naar podcast',
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
