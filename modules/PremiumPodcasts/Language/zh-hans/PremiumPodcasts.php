<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_is_premium' => '播客包含优质剧集',
    'episode_is_premium' => '剧集是高级内容，仅适用于高级订阅者',
    'unlock_episode' => '本集仅适用于高级订阅者。 点击解锁！',
    'banner_unlock' => '此播客包含高级剧集，仅供高级订阅者使用。',
    'banner_lock' => '播客已解锁，享受优质剧集！',
    'subscribe' => '订阅',
    'lock' => '锁定',
    'unlock' => '解锁',
    'unlock_form' => [
        'title' => '高级内容',
        'subtitle' => '此播客包含锁定的高级剧集！ 你有解锁它们的秘钥吗？',
        'token' => '输入你的密钥',
        'token_hint' => '如果你订阅了 {podcastTitle}，可以复制通过电子邮件发送给你的密钥并将其粘贴到此处。',
        'submit' => '解锁所有剧集！',
        'call_to_action' => '解锁 {podcastTitle} 的所有剧集：',
        'subscribe_cta' => '现在订阅 ！',
    ],
    'messages' => [
        'unlockSuccess' => '播客已成功解锁！ 享受优质剧集！',
        'unlockBadAttempt' => '你的密钥似乎不起作用...',
        'lockSuccess' => '播客已成功锁定！',
    ],
];
