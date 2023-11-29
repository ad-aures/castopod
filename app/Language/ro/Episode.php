<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Sezonul {seasonNumber}',
    'season_abbr' => 'Sezonul {seasonNumber}',
    'number' => 'Episod {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Sezonul {seasonNumber} episod {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# răspuns}
        few {# răspunsuri}
        other {# răspunsuri}
    }',
    'persons_list' => 'Persoane',
    'back_to_episodes' => 'Înapoi la episoadele {podcast}',
    'comments' => 'Comentarii',
    'activity' => 'Activitate',
    'description' => 'Descrierea episodului',
    'number_of_comments' => '{numberOfComments, plural,
        one {# răspuns}
        few {# răspunsuri}
        other {# răspunsuri}
    }',
    'all_podcast_episodes' => 'Toate episoadele podcastului',
    'back_to_podcast' => 'Înapoi la podcast',
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
