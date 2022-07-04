<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName}'s comment for {episodeTitle}",
    'back_to_comments' => 'Späť na komentáre',
    'form' => [
        'episode_message_placeholder' => 'Napísať komentár…',
        'reply_to_placeholder' => 'Reply to @{actorUsername}',
        'submit' => 'Poslať',
        'submit_reply' => 'Odpovedať',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# like}
        other {# likes}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# reply}
        other {# replies}
    }',
    'like' => 'Obľúbené',
    'reply' => 'Odpovedať',
    'view_replies' => 'Ukázať odpoved/e ({numberOfReplies})',
    'block_actor' => 'Blokovať užívateľa @{actorUsername}',
    'block_domain' => 'Blokovať doménu @{actorDomain}',
    'delete' => 'Vymazať komentár',
];
