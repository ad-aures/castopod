<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Komentarz użytkownika {actorDisplayName} do {episodeTitle}',
    'back_to_comments' => 'Wróć do komentarzy',
    'form' => [
        'episode_message_placeholder' => 'Napisz komentarz…',
        'reply_to_placeholder' => 'Odpowiedź do @{actorUsername}',
        'submit' => 'Wyślij',
        'submit_reply' => 'Odpowiedz',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# polubienie}
        few {# polubienia}
        other {# polubień}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# odpowiedź}
        other {# odpowiedzi}
    }',
    'like' => 'Polub',
    'reply' => 'Odpowiedz',
    'view_replies' => 'Zobacz odpowiedzi ({numberOfReplies})',
    'block_actor' => 'Zablokuj użytkownika @{actorUsername}',
    'block_domain' => 'Zablokuj domenę @{actorDomain}',
    'delete' => 'usuń komentarz',
];
