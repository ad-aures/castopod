<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Koulzad {seasonNumber}',
    'season_abbr' => 'K{seasonNumber}',
    'number' => 'Rann {episodeNumber}',
    'number_abbr' => 'R. {episodeNumber}',
    'season_episode' => 'Koulzad {seasonNumber} rann {episodeNumber}',
    'season_episode_abbr' => 'K{seasonNumber}:R{episodeNumber}',
    'persons' => '{personsCount, plural,
        0 {den ebet}
        one {# den}
        two {# zen}
        other {# den}
        22 {# zen}
        32 {# zen}
        42 {# zen}
        52 {# zen}
        62 {# zen}
        82 {# zen}
    }',
    'persons_list' => 'Emellerien·ezed',
    'back_to_episodes' => 'Mont da rannoù {podcast}',
    'comments' => 'Evezhiadennoù',
    'activity' => 'Oberiantiz',
    'chapters' => 'Chabistroù',
    'description' => 'Deskrivadur ar rann',
    'number_of_comments' => '{numberOfComments, plural,
        0 {evezhiadenn ebet}
        one {# evezhiadenn}
        other {# evezhiadenn}
    }',
    'all_podcast_episodes' => 'Holl rannoù ar podkast',
    'back_to_podcast' => 'Mont d\'ar podkast en-dro',
    'preview' => [
        'title' => 'Rakwel',
        'not_published' => 'Diembann',
        'text' => '{publication_status, select,
            published {N\'eo ket bet embannet ar rann-mañ c\'hoazh.}
            scheduled {Raktreset eo an embann a-benn an/ar {publication_date}.}
            with_podcast {Ar rann-mañ a vo embannet war un dro gant ar podkast.}
            other {N\'eo ket bet embannet ar rann-mañ c\'hoazh.}
        }',
        'publish' => 'Embann',
        'publish_edit' => 'Kemmañ an embannadur',
    ],
    'no_chapters' => 'N\'eus chabistr ebet evit ar rann.',
];
