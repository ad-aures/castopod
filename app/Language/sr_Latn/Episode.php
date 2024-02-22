<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Sezona {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Epizoda {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Sezona {seasonNumber} epizoda {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        few {# osobe}
        other {# osoba}
}',
    'persons_list' => 'Ličnosti',
    'back_to_episodes' => 'Nazad na epizode {podcast}',
    'comments' => 'Komentari',
    'activity' => 'Aktivnosti',
    'chapters' => 'Chapters',
    'description' => 'Opis epizode',
    'number_of_comments' => '{numberOfComments, plural,
        one {# komentar}
        other {# komentara}
    }',
    'all_podcast_episodes' => 'Sve epizode podkasta',
    'back_to_podcast' => 'Nazad na podkast',
    'preview' => [
        'title' => 'Pregled',
        'not_published' => 'Neobjavljeno',
        'text' => '{publication_status, select,
            published {Ova epizoda još uvek nije objavljena.}
            scheduled {Ova epizoda je zakazana za {publication_date}.}
            with_podcast {Ova epizoda će biti objavljena kad i podkast.}
            other {Ova epizoda još uvek nije objavljena.}
        }',
        'publish' => 'Objavi',
        'publish_edit' => 'Uredi objavu',
    ],
    'no_chapters' => 'No chapters are available for this episode.',
];
