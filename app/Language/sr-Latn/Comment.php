<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName} komentar za {episodeTitle}",
    'back_to_comments' => 'Nazad na komentare',
    'form' => [
        'episode_message_placeholder' => 'Napiši komentar…',
        'reply_to_placeholder' => 'Odgovori @{actorUsername}',
        'submit' => 'Pošalji',
        'submit_reply' => 'Odgovori',
    ],
    'likes' => '{numberOfLikes, plural,
        one {# sviđanje}
        other {# sviđanja}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# odgovor}
        other {# odgovora}
    }',
    'like' => 'Preporuči',
    'reply' => 'Odgovori',
    'view_replies' => 'Vidi odgovore ({numberOfReplies})',
    'block_actor' => 'Blokiraj korisnika @{actorUsername}',
    'block_domain' => 'Blokiraj domen @{actorDomain}',
    'delete' => 'Obriši komentar',
];
