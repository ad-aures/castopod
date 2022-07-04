<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Post aig {actorDisplayName}",
    'back_to_actor_posts' => 'Air ais gu postaichean {actor}',
    'actor_shared' => 'Cho-roinn {actor}',
    'reply_to' => 'Freagair gu @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Sgrìobh teachdaireachd…',
        'episode_message_placeholder' => 'Sgrìobh teachdaireachd dhan eapasod',
        'episode_url_placeholder' => 'URL an eapasoid',
        'reply_to_placeholder' => 'Freagair gu @{actorUsername}',
        'submit' => 'Cuir',
        'submit_reply' => 'Freagair',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# annsachd}
        two {# annsachd}
        few {# annsachdan}
        other {# annsachd}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# cho-roinneadh}
        two {# cho-roinneadh}
        few {# co-roinnidhean}
        other {# co-roinneadh}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# fhreagairt}
        two {# fhreagairt}
        few {# freagairtean}
        other {# freagairt}
    }',
    'expand' => 'Leudaich am post',
    'block_actor' => 'Bac an cleachdaiche @{actorUsername}',
    'block_domain' => 'Bac an àrainn @{actorDomain}',
    'delete' => 'Sguab às am post',
];
