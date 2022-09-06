<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_contributors' => '播客贡献者',
    'view' => "{username} 对 {podcastTitle} 的贡献",
    'add' => '添加贡献者',
    'add_contributor' => '为 {0} 添加贡献者',
    'edit_role' => '更新 {0} 的角色',
    'edit' => '编辑',
    'remove' => '移除',
    'list' => [
        'username' => '用户名',
        'role' => '角色',
    ],
    'form' => [
        'user' => '用户',
        'user_placeholder' => '选择一个用户...',
        'role' => '角色',
        'role_placeholder' => '选择角色…',
        'submit_add' => '添加贡献者',
        'submit_edit' => '更新角色',
    ],
    'roles' => [
        'podcast_admin' => '播客管理员',
    ],
    'messages' => [
        'removeOwnerError' => "你无法删除播客所有者！",
        'removeSuccess' =>
            '你从 {username} 移除 {podcastTitle}',
        'alreadyAddedError' =>
            "你尝试添加的贡献者已添加！",
    ],
];
