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
    'delete_form' => [
        'title' => '移除 {contributor}',
        'disclaimer' =>
            '你将要从贡献者中删除 {contributor}，他们将无法再访问“{podcastTitle}”。',
        'understand' => '我明白，我想从“{podcastTitle}”中删除 {contributor}',
        'submit' => '移除',
    ],
    'messages' => [
        'editSuccess' => '已成功更改角色！',
        'editOwnerError' => "你无法编辑播客所有者！",
        'removeOwnerError' => "你无法删除播客所有者！",
        'removeSuccess' =>
            '你从 {username} 移除 {podcastTitle}',
        'alreadyAddedError' =>
            "你尝试添加的贡献者已添加！",
    ],
];
