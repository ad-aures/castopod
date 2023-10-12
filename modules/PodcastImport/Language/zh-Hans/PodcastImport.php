<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'banner' => [
        'disclaimer' => '输入',
        'text' => '{podcastTitle} 正在导入中。',
        'cta' => '查看导入状态',
    ],
    'old_podcast_section_title' => '要导入的播客',
    'old_podcast_legal_disclaimer_title' => '法律免责声明',
    'old_podcast_legal_disclaimer' =>
        '请确保您在导入之前拥有此播客的权限。 在没有权限的情况下复制和广播播客是盗版行为，可能受到起诉。',
    'imported_feed_url' => '摘要 URL',
    'imported_feed_url_hint' => '摘要必须是 xml 或 rss 格式。',
    'new_podcast_section_title' => '新播客',
    'lock_import' =>
        '该摘要受到保护。 您无法导入它。 如果您是所有者，请在源平台解锁。',
    'submit' => '添加导入到队列',
    'queue' => [
        'status' => [
            'label' => '状态',
            'queued' => '队列',
            'queued_hint' => '导入任务正在等待处理。',
            'canceled' => '已取消',
            'canceled_hint' => '导入任务已取消。',
            'running' => '运行中',
            'running_hint' => '导入任务正在处理中。',
            'failed' => '已失败',
            'failed_hint' => '导入任务无法完成：脚本失败。',
            'passed' => '已通过',
            'passed_hint' => '导入任务顺利完成！',
        ],
        'feed' => '摘要',
        'duration' => '导入时长',
        'imported_episodes' => '导入剧集',
        'imported_episodes_hint' => '{newlyImportedCount} 新导入， {alreadyImportedCount} 已经导入。',
        'actions' => [
            'cancel' => '取消',
            'retry' => '重试',
            'delete' => '删除',
        ],
    ],
    'messages' => [
        'canceled' => '导入任务已成功取消！',
        'notRunning' => '无法取消导入任务，因为它未运行。',
        'alreadyRunning' => '导入任务已在运行。 您可以在重试之前取消它。',
        'retried' => '导入任务已排队，稍后将重试！',
        'deleted' => '导入任务已成功删除！',
        'importTaskQueued' => '新任务已排队，导入即将开始！',
        'syncTaskQueued' => '新的导入任务已排队，即将开始同步！',
    ],
];
