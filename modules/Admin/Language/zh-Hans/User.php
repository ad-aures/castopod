<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'edit_roles' => "编辑 {username} 的角色",
    'forcePassReset' => '强制重置',
    'ban' => '封禁',
    'unban' => '取消封禁',
    'delete' => '删除',
    'create' => '新用户',
    'view' => "{username} 的信息",
    'all_users' => '所有用户',
    'list' => [
        'user' => '用户',
        'roles' => '角色',
        'banned' => '已封禁？',
    ],
    'form' => [
        'email' => '邮箱',
        'username' => '用户名',
        'password' => '密码',
        'new_password' => '新密码',
        'roles' => '角色',
        'permissions' => '权限',
        'submit_create' => '创建用户',
        'submit_edit' => '保存',
        'submit_password_change' => '修改！',
    ],
    'roles' => [
        'superadmin' => '超级管理员',
    ],
    'messages' => [
        'createSuccess' =>
            '用户创建成功！{username} 将在首次验证时提醒重置密码。',
        'rolesEditSuccess' =>
            "{username} 的角色已更新。",
        'forcePassResetSuccess' =>
            '下次访问时 {username} 将被提醒重置密码。',
        'banSuccess' => '{username} 已被封禁。',
        'unbanSuccess' => '{username} 已解除封禁。',
        'banSuperAdminError' =>
            '{username} 是超级管理员，不能禁止超级管理员…',
        'deleteSuperAdminError' =>
            '{username} 是超级管理员，不能封禁超级管理员…',
        'deleteSuccess' => '{username} 已被删除。',
    ],
];
