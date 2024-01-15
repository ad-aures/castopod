<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Séria {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Epizóda {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Sezóna {seasonNumber} epizóda {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'persons' => '{personsCount, plural,
        one {# osobnosť}
        few {# osobnosti}
        many {# osobností}
        other {# osobností}
    }',
    'persons_list' => 'Osobnosti',
    'back_to_episodes' => 'Späť k epizódam {podcast}',
    'comments' => 'Komentáre',
    'activity' => 'Aktivita',
    'description' => 'Popis epizódy',
    'number_of_comments' => '{numberOfComments, plural,
        one {# komentár}
        few {# komentáre}
        many {# komentárov}
        other {# komentárov}
    }',
    'all_podcast_episodes' => 'Všetky epizódy podcastu',
    'back_to_podcast' => 'Späť na podcast',
    'preview' => [
        'title' => 'Náhľad',
        'not_published' => 'Nezverejnená',
        'text' => '{publication_status, select,
            published {Táto epizóda ešte nieje zverejnená.}
            scheduled {Táto epizóda je naplánovaná na zverejnenie {publication_date}.}
            with_podcast {Táto epizóda bude zverejnená zarovno s podcastom.}
            other {Táto epizóda ešte nieje zverejnená.}
        }',
        'publish' => 'Zverejniť',
        'publish_edit' => 'Upraviť zverejnené',
    ],
];
