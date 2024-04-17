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
    'chapters' => 'Hoofdstukken',
    'transcript' => 'Transcript',
    'description' => 'Omschrijving aflevering',
    'number_of_comments' => '{numberOfComments, plural,
        one {# reactie}
        other {# reacties}
    }',
    'all_podcast_episodes' => 'Alle podcast afleveringen',
    'back_to_podcast' => 'Terug naar podcast',
    'preview' => [
        'title' => 'Voorbeeld',
        'not_published' => 'Niet gepubliceerd',
        'text' => '{publication_status, select,
            published {Deze aflevering is nog niet gepubliceerd.}
            scheduled {Deze aflevering is gepland voor publicatie op {publication_date}}
            with_podcast {Deze aflevering zal op hetzelfde moment als de podcast worden gepubliceerd}
            other {Deze aflevering is nog niet gepubliceerd.}
        }',
        'publish' => 'Publiceer',
        'publish_edit' => 'Publicatie bewerken',
    ],
    'no_chapters' => 'Voor deze aflevering zijn geen hoofdstukken beschikbaar.',
    'download_transcript' => 'Download transcript ({extension})',
    'no_transcript' => 'No transcript available for this episode.',
];
