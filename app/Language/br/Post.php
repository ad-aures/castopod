<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Kemennadennoù {actorDisplayName}",
    'back_to_actor_posts' => 'Distroit da gemennadennoù {actor}',
    'actor_shared' => 'Rannet eo bet gant {actor}',
    'reply_to' => 'Respont da @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Skrivit ho kemennadenn…',
        'episode_message_placeholder' => 'Skrivit ho kemennadenn evit rann…',
        'episode_url_placeholder' => 'URL ar rann',
        'reply_to_placeholder' => 'Respont da @{actorUsername}',
        'submit' => 'Kas',
        'submit_reply' => 'Respont',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# muiañ-karet}
        2 {# vuiañ-karet}
        22 {# vuiañ-karet}
        32 {# vuiañ-karet}
        42 {# vuiañ-karet}
        52 {# vuiañ-karet}
        62 {# vuiañ-karet}
        82 {# vuiañ-karet}
        other {# muiañ-karet}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        0 {rannadur ebet}
        one {# rannadur}
        other {# rannadur}
    }',
    'replies' => '{numberOfReplies, plural,
        0 {respont ebet}
        one {# respont}
        other {# respont}
    }',
    'expand' => 'Astenn ar gemennadenn',
    'block_actor' => 'Stankañ an implijer·ez @{actorUsername}',
    'block_domain' => 'Stankañ @{actorDomain}',
    'delete' => 'Dilemel ar gemennadenn',
];
