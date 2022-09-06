<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'list' => [
        'title' => '视频素材',
        'status' => [
            'label' => '状态',
            'queued' => '队列',
            'queued_hint' => '素材正在等待处理。',
            'pending' => '待处理',
            'pending_hint' => '素材将很快完成。',
            'running' => '运行中',
            'running_hint' => '正在生成素材。',
            'failed' => '已失败',
            'failed_hint' => '无法生成素材：脚本运行失败。',
            'passed' => '已通过',
            'passed_hint' => '素材生成成功！',
        ],
        'clip' => '素材',
        'duration' => '工作时间',
    ],
    'title' => '视频素材： {videoClipLabel}',
    'download_clip' => '下载素材',
    'create' => '新建视频素材',
    'go_to_page' => '跳转到素材页面',
    'retry' => '重试素材生成',
    'delete' => '删除素材',
    'logs' => '任务日志',
    'messages' => [
        'alreadyExistingError' => '你尝试创建的视频素材已存在！',
        'addToQueueSuccess' => '视频素材已添加到队列中，等待创建！',
        'deleteSuccess' => '已删除视频素材',
    ],
    'format' => [
        'landscape' => '横向',
        'portrait' => '竖屏',
        'squared' => '方形',
    ],
    'form' => [
        'title' => '新建视频素材',
        'params_section_title' => '视频素材参数',
        'clip_title' => '素材标题',
        'format' => [
            'label' => '选择格式',
            'landscape_hint' => '使用 16:9的比例，非常适合 PeerTube、Youtube 和 Vimeo。',
            'portrait_hint' => '使用 9:16 的比例，非常适合 TikTok，Youtube shorts 和 Instagram。',
            'squared_hint' => '使用 1:1的比例，非常适合 Mastodon、Facebook、Twitter 和 LinkedIn。',
        ],
        'theme' => '选择主题',
        'start_time' => '开始于',
        'duration' => '持续时间',
        'trim_start' => '修剪开始',
        'trim_end' => '修剪结束',
        'submit' => '创建视频素材',
    ],
    'requirements' => [
        'title' => '未达到要求',
        'missing' => '你有未达到的要求。 添加所有必需项才能为此剧集创建视频！',
        'ffmpeg' => 'FFmpeg',
        'gd' => 'Graphics Draw (GD)',
        'freetype' => 'GD 的 Freetype 库',
        'transcript' => '字幕文件(.srt)',
    ],
];
