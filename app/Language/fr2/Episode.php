<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Saison {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Épisode {episodeNumber}',
    'number_abbr' => 'Ép. {episodeNumber}',
    'season_episode' => 'Saison {seasonNumber} épisode {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# intervenant}
        other {# intervenants}
    }',
    'persons_list' => 'Intervenants',
    'back_to_episodes' => 'Retour aux épisodes de {podcast}',
    'comments' => 'Commentaires',
    'activity' => 'Activité',
    'chapters' => 'Chapters',
    'description' => 'Description de l’épisode',
    'number_of_comments' => '{numberOfComments, plural,
        one {# commentaire}
        other {# commentaires}
    }',
    'all_podcast_episodes' => 'Tous les épisodes du podcast',
    'back_to_podcast' => 'Revenir au podcast',
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
    'no_chapters' => 'No chapters are available for this episode.',
];
