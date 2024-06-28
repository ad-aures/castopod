<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => "{actorDisplayName} の投稿",
    'back_to_actor_posts' => '{actor} の投稿一覧に戻る',
    'actor_shared' => '{actor} が共有しました',
    'reply_to' => '@{actorUsername} に返信する',
    'form' => [
        'message_placeholder' => 'ここにコメントを入力..',
        'episode_message_placeholder' => 'エピソードへのコメントを入力...',
        'episode_url_placeholder' => 'エピソードのURL',
        'reply_to_placeholder' => '@{actorUsername} に返信する',
        'submit' => '送信',
        'submit_reply' => '返信する',
    ],
    'favourites' => '{numberOfFavourites, plural,
        one {# favourite}
        other {# favourites}
    }',
    'reblogs' => '{numberOfReblogs, plural,
        one {# share}
        other {# shares}
    }',
    'replies' => '{numberOfReplies, plural,
        one {# reply}
        other {# replies}
    }',
    'expand' => '投稿を開く',
    'block_actor' => '@{actorUsername} をブロック',
    'block_domain' => '@{actorDomain} の投稿をブロックする',
    'delete' => '投稿を削除',
];
