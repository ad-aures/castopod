<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Komentář {actorDisplayName} k {episodeTitle}",
    'back_to_comments' => 'Zpět na komentáře',
    'form' => [
        'episode_message_placeholder' => 'Napište komentář…',
        'reply_to_placeholder' => 'Odpovědět @{actorUsername}',
        'submit' => 'Odeslat',
        'submit_reply' => 'Odpovědět',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# se líbí}
        other {# se líbí}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# odpověď}
        other {# odpovědi}
    }',
    'like' => 'Líbí se mi',
    'reply' => 'Odpovědět',
    'view_replies' => 'Zobrazit odpovědi ({numberOfReplies})',
    'block_actor' => 'Blokovat uživatele @{actorUsername}',
    'block_domain' => 'Blokovat doménu @{actorDomain}',
    'delete' => 'Odstranit komentář',
];
