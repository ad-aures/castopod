<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Staffel {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Folge {episodeNumber}',
    'number_abbr' => 'E {episodeNumber}',
    'season_episode' => 'Staffel {seasonNumber} Episode {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# Mitwirkender}
        other {# Mitwirkende}
    }',
    'persons_list' => 'Mitwirkende',
    'back_to_episodes' => 'Zurück zu Episoden von {podcast}',
    'comments' => 'Kommentare',
    'activity' => 'Aktivitäten',
    'chapters' => 'Kapitel',
    'transcript' => 'Transcript',
    'description' => 'Beschreibung der Episode',
    'number_of_comments' => '{numberOfComments, plural,
        one {# Kommentar}
        other {# Kommentare}
    }',
    'all_podcast_episodes' => 'Alle Podcast-Episoden',
    'back_to_podcast' => 'Zurück zum Podcast',
    'preview' => [
        'title' => 'Vorschau',
        'not_published' => 'Nicht veröffentlicht',
        'text' => '{publication_status, select,
            published {Diese Episode ist noch nicht veröffentlicht.}
            scheduled {Diese Episode ist für die Veröffentlichung geplant am {publication_date}.}
            with_podcast {Diese Episode wird zur gleichen Zeit wie der Podcast veröffentlicht.}
            other {Diese Episode ist noch nicht veröffentlicht.}
        }',
        'publish' => 'Veröffentlichen',
        'publish_edit' => 'Veröffentlichung bearbeiten',
    ],
    'no_chapters' => 'Für diese Episode sind keine Kapitel verfügbar.',
    'download_transcript' => 'Download transcript ({extension})',
    'no_transcript' => 'No transcript available for this episode.',
];
