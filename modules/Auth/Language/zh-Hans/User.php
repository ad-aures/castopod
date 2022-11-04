<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_role' => "编辑 {username} 的角色",
    'ban' => '封禁',
    'unban' => '取消封禁',
    'delete' => '删除',
    'create' => '新用户',
    'view' => "{username} 的信息",
    'all_users' => '所有用户',
    'list' => [
        'user' => '用户',
        'role' => '角色',
        'banned' => '已封禁？',
    ],
    'form' => [
        'email' => '邮箱',
        'username' => '用户名',
        'password' => '密码',
        'new_password' => '新密码',
        'role' => '角色',
        'roles' => '角色',
        'permissions' => '权限',
        'submit_create' => '创建用户',
        'submit_edit' => '保存',
        'submit_password_change' => '修改！',
    ],
    'delete_form' => [
        'title' => '删除 {user} ？',
        'disclaimer' =>
            "你将永久删除 {user}，他们将无法再访问管理区域。",
        'understand' => '我明白，我想永久删除 {user}',
        'submit' => '删除',
    ],
    'messages' => [
        'createSuccess' =>
            '用户创建成功！{username} 将在首次验证时提醒重置密码。',
        'roleEditSuccess' =>
            "{username} 的角色已更新。",
        'banSuccess' => '{username} 已被封禁。',
        'unbanSuccess' => '{username} 已解除封禁。',
        'editOwnerError' =>
            '{username} 是实例的所有者，你不能编辑他的角色。',
        'banSuperAdminError' =>
            '{username} 是超级管理员，不能禁止超级管理员…',
        'deleteOwnerError' =>
            '{username} 是实例的所有者，不能简单地删除所有者…',
        'deleteSuperAdminError' =>
            '{username} 是超级管理员，不能封禁超级管理员…',
        'deleteSuccess' => '{username} 已被删除。',
    ],
];
