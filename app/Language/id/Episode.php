<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Musim {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Episode {episodeNumber}',
    'number_abbr' => 'Eps. {episodeNumber}',
    'season_episode' => 'Musim {seasonNumber} episode {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        other {# orang}
    }',
    'persons_list' => 'Orang',
    'back_to_episodes' => 'Kembali ke episode-episode pada {podcast}',
    'comments' => 'Komentar',
    'activity' => 'Aktivitas',
    'chapters' => 'Chapters',
    'description' => 'Keterangan episode',
    'number_of_comments' => '{numberOfComments, plural,
        other {# komentar}
    }',
    'all_podcast_episodes' => 'Semua episode siniar',
    'back_to_podcast' => 'Kembali ke siniar',
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
