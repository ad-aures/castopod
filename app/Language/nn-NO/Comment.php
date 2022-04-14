<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName} sin kommentar til {episodeTitle}",
    'back_to_comments' => 'Tilbake til kommentarane',
    'form' => [
        'episode_message_placeholder' => 'Skriv ein kommentar…',
        'reply_to_placeholder' => 'Svar til @{actorUsername}',
        'submit' => 'Send',
        'submit_reply' => 'Svar',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# likar}
        other {# likar}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# svar}
        other {# svar}
    }',
    'like' => 'Lik',
    'reply' => 'Svar',
    'view_replies' => 'Vis svar ({numberOfReplies})',
    'block_actor' => 'Blokker brukaren @{actorUsername}',
    'block_domain' => 'Blokker domenet @{actorDomain}',
    'delete' => 'Slett kommentaren',
];
