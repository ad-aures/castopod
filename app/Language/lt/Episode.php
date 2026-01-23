<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => '{seasonNumber} sezonas',
    'season_abbr' => 'S{seasonNumber}',
    'number' => '{episodeNumber} epizodas',
    'number_abbr' => '{episodeNumber} ep.',
    'season_episode' => '{seasonNumber} sezono {episodeNumber} epizodas',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# asmuo}
        few {# asmenys}
        other {# asmenų}
    }',
    'persons_list' => 'Asmenys',
    'back_to_episodes' => 'Grįžti į „{podcast}“ epizodų sąrašą',
    'comments' => 'Komentarai',
    'activity' => 'Veikla',
    'chapters' => 'Skyreliai',
    'transcript' => 'Nuorašas',
    'description' => 'Epizodo aprašymas',
    'number_of_comments' => '{numberOfComments, plural,
        one {# komentaras}
        few {# komentarai}
        other {# komentarų}
    }',
    'all_podcast_episodes' => 'Visi tinklalaidės epizodai',
    'back_to_podcast' => 'Grįžti į tinklalaidę',
    'preview' => [
        'title' => 'Peržiūrėti',
        'not_published' => 'Nepaskelbtas',
        'text' => '{publication_status, select,
            published {Šis epizodas dar nepaskelbtas.}
            scheduled {Šį epizodą planuojama paskelbti {publication_date}.}
            with_podcast {Šį epizodą planuojama paskelbti kartu su tinklalaide.}
            other {Šis epizodas dar nepaskelbtas.}
        }',
        'publish' => 'Paskelbti',
        'publish_edit' => 'Taisyti paskelbimą',
    ],
    'no_chapters' => 'Šis epizodas neišskaidytas skyreliais.',
    'download_transcript' => 'Parsisiųsti nuorašą ({extension})',
    'no_transcript' => 'Šio epizodo nuorašas nepateiktas.',
];
