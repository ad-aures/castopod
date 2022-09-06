<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName}'s post",
    'back_to_actor_posts' => 'Back to {actor} posts',
    'actor_shared' => '{actor} membagikan',
    'reply_to' => 'Balas @{actorUsername}',
    'form' => [
        'message_placeholder' => 'Tulis pesan…',
        'episode_message_placeholder' => 'Tulis pesan untuk episode ini…',
        'episode_url_placeholder' => 'URL episode',
        'reply_to_placeholder' => 'Balas @{actorUsername}',
        'submit' => 'Kirim',
        'submit_reply' => 'Balas',
    ],
    'favourites' => '{numberOfFavourites, plural,
        other {# favorit}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# share}
        other {# shares}
    }',
    'replies' => '{numberOfReplies, plural,
        other {# balasan}
    }',
    'expand' => 'Perluas postingan',
    'block_actor' => 'Blokir pengguna @{actorUsername}',
    'block_domain' => 'Blokir domain @{actorDomain}',
    'delete' => 'Hapus postingan',
];
