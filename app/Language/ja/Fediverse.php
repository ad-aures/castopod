<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'your_handle' => 'あなたのユーザー ID',
    'your_handle_hint' => 'フォームに「@username@domain」の形式で入力してください',
    'follow' => [
        'label' => 'フォロー',
        'title' => '{actorDisplayName} をフォロー',
        'subtitle' => 'フォロー中:',
        'accountNotFound' => 'アカウントが見つかりませんでした',
        'remoteFollowNotAllowed' => 'このアカウントサーバーはリモートフォローを許可しておりません',
        'submit' => 'フォローする',
    ],
    'favourite' => [
        'title' => "お気に入りの {actorDisplayName}の投稿",
        'subtitle' => 'お気に入りに登録中:',
        'submit' => 'お気に入り登録する',
    ],
    'reblog' => [
        'title' => "{actorDisplayName} の投稿を共有する",
        'subtitle' => '共有中:',
        'submit' => '共有する',
    ],
    'reply' => [
        'title' => "{actorDisplayName} の投稿に返信する",
        'subtitle' => '返信中:',
        'submit' => '返信する',
    ],
];
