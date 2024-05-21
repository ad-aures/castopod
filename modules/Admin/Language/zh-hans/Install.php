<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'manual_config' => '手动配置',
    'manual_config_subtitle' =>
        '创建一个带有你设置的“.env”文件，并刷新页面以继续安装。',
    'form' => [
        'instance_config' => '实例配置',
        'hostname' => '主机名',
        'media_base_url' => '媒体基础 URL',
        'media_base_url_hint' =>
            '如果你使用 CDN 和/或外部分析服务，可以在此处设置它们。',
        'admin_gateway' => '管理网关',
        'admin_gateway_hint' =>
            '访问管理区域的路由(例如，https://example.com/cp-admin)。默认设置为 cp-admin，处于安全原因，我们建议你修改它。',
        'auth_gateway' => '认证网关',
        'auth_gateway_hint' =>
            '访问认证页面的路由(例如，https://example.com/cp-auth)。默认设置为 cp-auth，处于安全原因，我们建议你修改它。',
        'database_config' => '数据库配置',
        'database_config_hint' =>
            'Castopod 需要连接到你的 MySQL (or MariaDB) 数据库。如果你没有这些所需信息，请联系你的服务器管理员。',
        'db_hostname' => '数据库主机',
        'db_name' => '数据库名',
        'db_username' => '数据库用户名',
        'db_password' => '数据库密码',
        'db_prefix' => '数据库前缀',
        'db_prefix_hint' =>
            "Castopod 表名的前缀，如果您不知道它的含义，请保持默认。",
        'cache_config' => '缓存配置',
        'cache_config_hint' =>
            '选择你喜欢的缓存处理程序。如果你不知道它的含义，请保留默认值。',
        'cache_handler' => '缓存处理方法',
        'cacheHandlerOptions' => [
            'file' => '文件',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => '下一步',
        'submit' => '完成安装',
        'create_superadmin' => '创建你的超级管理员帐户',
        'email' => '邮箱',
        'username' => '用户名',
        'password' => '密码',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            '你的超级管理员帐户已创建。登录开始播客！',
        'databaseConnectError' =>
            'Castopod 无法连接到你的数据库。编辑你的数据库配置，然后重试。',
        'writeError' =>
            "无法创建或写入 `.env` 文件。你必须手动按照 Castopod 中的 `.env.example` 文件模板创建它。",
    ],
];
