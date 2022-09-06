<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'messages' => [
        'actorNotFound' => '无法找到此帐户！',
        'blockActorSuccess' => '{actor} 已被封禁！',
        'unblockActorSuccess' => '该用户已被解除封禁',
        'blockDomainSuccess' => '{domain} 已被封禁！',
        'unblockDomainSuccess' => '{domain} 已解除封禁。',
    ],
    'blocked_actors' => '已屏蔽帐户',
    'blocked_domains' => '已屏蔽域名',
    'block_lists_form' => [
        'handle' => '帐户名称',
        'handle_hint' => '输入 @username@domain 帐户。',
        'domain' => '域名',
        'submit' => '封禁！',
    ],
    'list' => [
        'actor' => '帐户',
        'domain' => '域名',
        'unblock' => '解除封禁',
    ],
];
