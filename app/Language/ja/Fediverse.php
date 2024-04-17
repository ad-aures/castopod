<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'your_handle' => 'あなたのユーザー ID',
    'your_handle_hint' => 'Enter the @username@domain you want to act from.',
    'follow' => [
        'label' => 'フォロー',
        'title' => '{actorDisplayName} をフォロー',
        'subtitle' => 'You are going to follow:',
        'accountNotFound' => 'アカウントが見つかりませんでした',
        'remoteFollowNotAllowed' => 'このアカウントサーバーはリモートフォローを許可しておりません',
        'submit' => 'フォローする',
    ],
    'favourite' => [
        'title' => "お気に入りの {actorDisplayName}の投稿",
        'subtitle' => 'You are going to favourite:',
        'submit' => 'お気に入り登録する',
    ],
    'reblog' => [
        'title' => "Share {actorDisplayName}'s post",
        'subtitle' => 'You are going to share:',
        'submit' => '共有する',
    ],
    'reply' => [
        'title' => "Reply to {actorDisplayName}'s post",
        'subtitle' => 'You are going to reply to:',
        'submit' => '返信する',
    ],
];
