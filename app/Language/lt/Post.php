<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName} įrašas",
    'back_to_actor_posts' => 'Grįžti į {actor} įrašus',
    'actor_shared' => '{actor} pasidalijo',
    'reply_to' => 'Atsakyti @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Parašykite žinutę…',
        'episode_message_placeholder' => 'Parašykite žinutę šiam epizodui…',
        'episode_url_placeholder' => 'Epizodo URL adresas',
        'reply_to_placeholder' => 'Atsakyti @{actorUsername}',
        'submit' => 'Siųsti',
        'submit_reply' => 'Atsakyti',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# pamėgimas}
        few {# pamėgimai}
        other {# pamėgimų}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# pasidalijimas}
        few {# pasidalijimai}
        other {# pasidalijimų}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# atsakymas}
        few {# atsakymai}
        other {# atsakymų}
    }',
    'expand' => 'Išskleisti įrašą',
    'block_actor' => 'Blokuoti naudotoją @{actorUsername}',
    'block_domain' => 'Blokuoti domeną @{actorDomain}',
    'delete' => 'Šalinti įrašą',
];
