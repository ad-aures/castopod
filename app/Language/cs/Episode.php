<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Série: {{seasonNumber}}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Epizoda {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Série {seasonNumber} epizoda {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# osoba}
        other {# osoby}
    }',
    'persons_list' => 'Osoby',
    'back_to_episodes' => 'Zpět na epizody {podcast}',
    'comments' => 'Komentáře',
    'activity' => 'Aktivita',
    'chapters' => 'Kapitoly',
    'transcript' => 'Přepis',
    'description' => 'Popis epizody',
    'number_of_comments' => '{numberOfComments, plural,
        one {# komentář}
        other {# komentáře}
    }',
    'all_podcast_episodes' => 'Všechny epizody podcastu',
    'back_to_podcast' => 'Přejít zpět na podcast',
    'preview' => [
        'title' => 'Náhled',
        'not_published' => 'Nezveřejněno',
        'text' => '{publication_status, select,
            published {Tato epizoda ještě není publikována.}
            scheduled {Tato epizoda je naplánována na {publication_date}}
            with_podcast {Tato epizoda bude zveřejněna současně s podcastem.}
            other {Tato epizoda ještě není publikována.}
        }',
        'publish' => 'Publikovat',
        'publish_edit' => 'Editovat publikaci',
    ],
    'no_chapters' => 'Pro tuto epizodu nejsou k dispozici žádné kapitoly.',
    'download_transcript' => 'Stáhnout přepis ({extension})',
    'no_transcript' => 'Pro tuto epizodu není k dispozici žádný přepis.',
];
