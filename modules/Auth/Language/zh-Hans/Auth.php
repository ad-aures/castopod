<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'instance_groups' => [
        'owner' => [
            'title' => '实例所有者',
            'description' => 'Castopod 所有者',
        ],
        'superadmin' => [
            'title' => '超级管理员',
            'description' => '拥有对 Castopod 的完全控制。',
        ],
        'manager' => [
            'title' => '管理',
            'description' => '管理 Castopod 的内容。',
        ],
        'podcaster' => [
            'title' => '播客',
            'description' => 'Castopod 的普通用户。',
        ],
    ],
    'instance_permissions' => [
        'admin.access' => '可以访问 Castopod 管理区域。',
        'admin.settings' => '可以访问 Castopod 设置。',
        'users.manage' => '可以管理 Castopod 用户。',
        'persons.manage' => '可以管理人员。',
        'pages.manage' => '可以管理页面。',
        'podcasts.view' => '可以查看所有播客。',
        'podcasts.create' => '可以创建新播客。',
        'podcasts.import' => '可以导入播客。',
        'fediverse.manage-blocks' => '可以阻止联邦宇宙参与者/域与 Castopod 交互。',
    ],
    'podcast_groups' => [
        'owner' => [
            'title' => '播客封面',
            'description' => '播客所有者。',
        ],
        'admin' => [
            'title' => '管理员',
            'description' => '完全控制播客 #{id}。',
        ],
        'editor' => [
            'title' => '编辑',
            'description' => '管理播客 #{id} 的内容和出版物。',
        ],
        'author' => [
            'title' => '作者',
            'description' => '管理播客 #{id} 的内容，但不能发布。',
        ],
        'guest' => [
            'title' => '访客',
            'description' => '播客 #{id} 的普通贡献者。',
        ],
    ],
    'podcast_permissions' => [
        'view' => '可以查看播客 #{id} 的仪表板和分析。',
        'edit' => '可以编辑播客 #{id}。',
        'delete' => '可以删除播客 #{id}。',
        'manage-import' => '可以同步导入的播客 #{id}。',
        'manage-persons' => '可以管理播客 #{id} 的订阅。',
        'manage-subscriptions' => '可以管理播客 #{id} 的订阅。',
        'manage-contributors' => '可以管理播客 #{id} 的贡献者。',
        'manage-platforms' => '可以设置/删除播客 #{id} 的平台链接。',
        'manage-publications' => '可以发布播客 #{id}。',
        'manage-notifications' => '可以查看播客 #{id} 的通知并将其标记为已读。',
        'interact-as' => '可以在播客 #{id} 进行互动，以收藏、分享或回复帖子。',
        'episodes.view' => '可以查看播客 #{id} 的仪表板和分析。',
        'episodes.create' => '可以为播客 #{id} 创建剧集。',
        'episodes.edit' => '可以编辑播客 #{id} 的剧集。',
        'episodes.delete' => '可以删除播客 #{id} 的剧集。',
        'episodes.manage-persons' => '可以管理播客 #{id} 的剧集人。',
        'episodes.manage-clips' => '可以管理播客 #{id} 的视频剪辑或声音片段。',
        'episodes.manage-publications' => '可以发布/取消发布播客 #{id} 的剧集和帖子。',
        'episodes.manage-comments' => '可以创建/删除播客 #{id} 的剧集评论。',
    ],

    // missing keys
    'code' => '你的6位验证码',

    'set_password' => '设置你的密码',

    // Welcome email
    'welcomeSubject' => '你已受邀加入 {siteName}',
    'emailWelcomeMailBody' => '在 {domain} 上为你创建了一个帐户，单击下面的登录链接设置您的密码。 该链接在发送此电子邮件后的 {numberOfHours} 小时内有效。',
];
