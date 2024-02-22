<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Σεζόν {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Επεισόδιο {episodeNumber}',
    'number_abbr' => 'Επ. {episodeNumber}',
    'season_episode' => 'Σεζόν {seasonNumber} επεισόδιο {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# άτομο}
        other {# άτομα}
    }',
    'persons_list' => 'Πρόσωπα',
    'back_to_episodes' => 'Επιστροφή στα επεισόδια του {podcast}',
    'comments' => 'Σχόλια',
    'activity' => 'Δραστηριότητα',
    'chapters' => 'Chapters',
    'description' => 'Περιγραφή επεισοδίου',
    'number_of_comments' => '{numberOfComments, plural,
        one {# σχόλιο}
        other {# σχόλια}
    }',
    'all_podcast_episodes' => 'Όλα τα επεισόδια του podcast',
    'back_to_podcast' => 'Μετάβαση πίσω στο podcast',
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
