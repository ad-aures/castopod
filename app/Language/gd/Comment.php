<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Am beachd aig {actorDisplayName} air {episodeTitle}",
    'back_to_comments' => 'Air ais dha na beachdan',
    'form' => [
        'episode_message_placeholder' => 'Sgrìobh beachd…',
        'reply_to_placeholder' => 'Freagair gu @{actorUsername}',
        'submit' => 'Cuir',
        'submit_reply' => 'Freagair',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# annsachd}
        two {# annsachd}
        few {# annsachdan}
        other {# annsachd}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# fhreagairt}
        two {# fhreagairt}
        few {# freagairtean}
        other {# freagairt}
    }',
    'like' => 'Cuir ris na h-annsachdan',
    'reply' => 'Freagair',
    'view_replies' => 'Seall na freagairtean ({numberOfReplies})',
    'block_actor' => 'Bac an cleachdaiche @{actorUsername}',
    'block_domain' => 'Bac an àrainn @{actorDomain}',
    'delete' => 'Sguab às am beachd',
];
