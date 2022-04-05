<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Reactie van {actorDisplayName} op {episodeTitle}",
    'back_to_comments' => 'Terug naar reacties',
    'form' => [
        'episode_message_placeholder' => 'Schrijf een reactie…',
        'reply_to_placeholder' => 'Reageren op @{actorUsername}',
        'submit' => 'Verzenden',
        'submit_reply' => 'Reageer',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# like}
        other {# likes}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# reactie}
        other {# reacties}
    }',
    'like' => 'Like',
    'reply' => 'Reageer',
    'view_replies' => 'Reacties bekijken ({numberOfReplies})',
    'block_actor' => 'Blokkeer gebruiker @{actorUsername}',
    'block_domain' => 'Blokkeer domein @{actorDomain}',
    'delete' => 'Verwijder reactie',
];
