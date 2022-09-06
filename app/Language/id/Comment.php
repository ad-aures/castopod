<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "Komentar {actorDisplayName} pada {episodeTitle}",
    'back_to_comments' => 'Kembali ke komentar',
    'form' => [
        'episode_message_placeholder' => 'Tulis komentar…',
        'reply_to_placeholder' => 'Membalas @{actorUsername}',
        'submit' => 'Kirim',
        'submit_reply' => 'Balas',
    ],
    'likes' => '{numberOfLikes, plural,
        other {# suka}
    }',
    'replies' => '{numberOfReplies, plural,
        other {# balasan}
    }',
    'like' => 'Sukai',
    'reply' => 'Balas',
    'view_replies' => 'Lihat balasan ({numberOfReplies})',
    'block_actor' => 'Blokir pengguna @{actorUsername}',
    'block_domain' => 'Blokir domain @{actorDomain}',
    'delete' => 'Hapus komentar',
];
