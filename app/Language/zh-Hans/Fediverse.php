<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'your_handle' => '你的帐号',
    'your_handle_hint' => '输入 @username@domain 执行你想要进行的操作。',
    'follow' => [
        'label' => '关注',
        'title' => '关注 {actorDisplayName}',
        'subtitle' => '你将会关注：',
        'accountNotFound' => '无法找到此帐户。',
        'remoteFollowNotAllowed' => '好像此帐户服务器不允许远程关注…',
        'submit' => '继续关注',
    ],
    'favourite' => [
        'title' => "喜欢 {actorDisplayName} 的帖子",
        'subtitle' => '你将会喜欢：',
        'submit' => '已添加到喜欢',
    ],
    'reblog' => [
        'title' => "分享 {actorDisplayName} 的帖子",
        'subtitle' => '你将要分享：',
        'submit' => '继续分享',
    ],
    'reply' => [
        'title' => "回复 {actorDisplayName} 的帖子",
        'subtitle' => '你将会回复到：',
        'submit' => '继续回复',
    ],
];
