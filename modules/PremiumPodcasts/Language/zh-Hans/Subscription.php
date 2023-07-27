<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'podcast_subscriptions' => 'Podcast subscriptions',
    'add' => '新订阅',
    'view' => '查看订阅',
    'edit' => '编辑订阅',
    'regenerate_token' => '重新生成令牌',
    'suspend' => '停止订阅',
    'resume' => '恢复订阅',
    'delete' => '删除订阅',
    'status' => [
        'active' => '活动',
        'suspended' => '已暂停',
        'expired' => '已过期',
    ],
    'list' => [
        'number' => '编号',
        'email' => '邮箱',
        'expiration_date' => '到期日',
        'unlimited' => '无限制',
        'downloads' => '下载',
        'status' => '状态',
    ],
    'form' => [
        'email' => '邮箱',
        'expiration_date' => '到期日',
        'expiration_date_hint' => '订阅到期的日期和时间。 留空时没有订阅限制。',
        'submit_add' => '添加订阅',
        'submit_edit' => '编辑订阅',
    ],
    'form_link_add' => [
        'link' => '订阅页面链接',
        'link_hint' => '在网站中添加号召性用语，邀请听众订阅播客。',
        'submit' => '保存链接',
    ],
    'suspend_form' => [
        'disclaimer' => '暂停订阅将限制订阅者访问高级内容。你仍然可以在之后取消暂停。',
        'reason' => '原因',
        'reason_placeholder' => '您为什么要暂停订阅？',
        "submit" => '暂停订阅',
    ],
    'delete_form' => [
        'disclaimer' => '删除 {subscriber} 的订阅将删除所有相关的分析数据。',
        'understand' => '我明白，永久删除订阅',
        'submit' => '移除订阅',
    ],
    'messages' => [
        'addSuccess' => '添加了新订阅！ 欢迎电子邮件已发送给 {subscriber}。',
        'addError' => '无法添加订阅。',
        'editSuccess' => '订阅到期日期已更新！ 一封电子邮件已发送给 {subscriber}。',
        'editError' => '无法添加订阅。',
        'regenerateTokenSuccess' => '重新生成令牌！ 一封带有新令牌的电子邮件已发送给 {subscriber}。',
        'regenerateTokenError' => '无法重新生成令牌。',
        'deleteSuccess' => '订阅已删除！ 一封电子邮件已发送给 {subscriber}。',
        'deleteError' => '无法删除订阅。',
        'suspendSuccess' => '订阅已暂停！ 一封电子邮件已发送给 {subscriber}。',
        'suspendError' => '无法暂停订阅。',
        'resumeSuccess' => '订阅已恢复！ 一封电子邮件已发送给 {subscriber}。',
        'resumeError' => '无法恢复订阅。',
        'linkSaveSuccess' => '订阅链接保存成功！ 它将作为号召性用语出现在网站上！',
        'linkRemoveSuccess' => '订阅链接已成功删除！',
    ],
    'emails' => [
        'greeting' => '嘿，',
        'token' => '你的令牌: {0}',
        'unique_feed_link' => '你唯一的摘要链接：{0}',
        'how_to_use' => '如何使用?',
        'two_ways' => '你有两种解锁高级剧集的方法：',
        'import_into_app' => '在你最喜欢的播客应用程序中复制你唯一的摘要 URL（将其作为私人源导入以防止暴露你的凭据）。',
        'go_to_website' => '访问 {podcastWebsite} 的网站并使用你的令牌解锁播客。',
        'welcome_subject' => '欢迎来到 {podcastTitle}',
        'welcome' => '你已订阅 {podcastTitle}，谢谢，欢迎加入！',
        'welcome_token_title' => '这是你解锁播客高级剧集的凭据：',
        'welcome_expires' => '你的订阅已设置为在 {0} 到期。',
        'welcome_never_expires' => '你的订阅设置为永不过期。',
        'reset_subject' => '你的令牌已重置！',
        'reset_token' => '你对 {podcastTitle} 的访问权限已重置！',
        'reset_token_title' => '已为你生成解锁播客高级剧集的新凭据：',
        'edited_subject' => '你的订阅已更新！',
        'edited_expires' => '你对 {podcastTitle} 的订阅已设置为在 {expiresAt} 到期。',
        'edited_never_expires' => '你对 {podcastTitle} 的订阅设置为永不过期！',
        'suspended_subject' => '你的订阅已被暂停！',
        'suspended' => '你的 {podcastTitle} 订阅已暂停！ 你已无法再访问播客的高级剧集。',
        'suspended_reason' => '原因如下：{0}',
        'resumed_subject' => '你的订阅已恢复！',
        'resumed' => '你对 {podcastTitle} 的订阅已恢复！ 你可以再次访问播客的高级剧集。',
        'deleted_subject' => '你的订阅已被删除！',
        'deleted' => '你对 {podcastTitle} 的订阅已被删除！ 你无法再访问播客的高级剧集。',
        'footer' => '{castopod} 托管在 {host}',
    ],
];
