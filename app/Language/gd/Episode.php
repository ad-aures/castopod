<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Seusan {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Eapasod {episodeNumber}',
    'number_abbr' => 'Eap. {episodeNumber}',
    'season_episode' => 'Seusan {seasonNumber} eapasod {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# neach}
        two {# dhuine}
        few {# daoine}
        other {# duine}
    }',
    'persons_list' => 'Daoine',
    'back_to_episodes' => 'Air ais dha na h-eapasodan aig {podcast}',
    'comments' => 'Beachdan',
    'activity' => 'Gnìomhachd',
    'description' => 'Tuairisgeul an eapasoid',
    'number_of_comments' => '{numberOfComments, plural,
        one {# bheachd}
        two {# bheachd}
        few {# beachdan}
        other {# beachd}
    }',
    'all_podcast_episodes' => 'A h-uile eapasod a’ phod-chraolaidh',
    'back_to_podcast' => 'Air ais dhan phod-chraoladh',
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
