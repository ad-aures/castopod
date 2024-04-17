<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Säsong {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Avsnitt {episodeNumber}',
    'number_abbr' => 'Av. {episodeNumber}',
    'season_episode' => 'Säsong {seasonNumber} avsnitt {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:A{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# person}
        other {# personer}
    }',
    'persons_list' => 'Personer',
    'back_to_episodes' => 'Tillbaka till avsnitten av {podcast}',
    'comments' => 'Kommentarer',
    'activity' => 'Aktivitet',
    'chapters' => 'Chapters',
    'transcript' => 'Transcript',
    'description' => 'Beskrivning av avsnitt',
    'number_of_comments' => '{numberOfComments, plural,
        one {# kommentar}
        other {# kommentarer}
    }',
    'all_podcast_episodes' => 'Alla podcast avsnitt',
    'back_to_podcast' => 'Gå tillbaka till podcasten',
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
    'download_transcript' => 'Download transcript ({extension})',
    'no_transcript' => 'No transcript available for this episode.',
];
