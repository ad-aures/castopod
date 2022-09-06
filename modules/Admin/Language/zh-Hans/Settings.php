<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => '常用设置',
    'instance' => [
        'title' => '实例',
        'site_icon' => '站点图标',
        'site_icon_delete' => '删除站点图标',
        'site_icon_hint' => '站点图标是您在浏览器标签页、书签栏及将网站添加为移动设备上的快捷方式时看到的内容。',
        'site_icon_helper' => '图标必须是方形，而且至少 512px 宽度和高度。',
        'site_name' => '站点名称',
        'site_description' => '站点描述',
        'submit' => '保存',
        'editSuccess' => '实例已更新！',
        'deleteIconSuccess' => '站点图标已移除！',
    ],
    'images' => [
        'title' => '图像',
        'subtitle' => '在这里，你可以根据上传的原始图像重新生成所有图像。 如果发现某些图像丢失，请使用此项功能。此功能可能需要执行一段时间。',
        'regenerate' => '重新生成图片',
        'regenerationSuccess' => '所有图片已重新生成！',
    ],
    'housekeeping' => [
        'title' => '维护任务',
        'subtitle' => '运行维护任务。如果遇到媒体文件或数据丢失，请使用此功能。这些任务可能需要一段时间。',
        'reset_counts' => '重置计数',
        'reset_counts_helper' => '此选项将重新计算并重置所有数据统计(关注者数目、帖子、评论、 …)。',
        'rewrite_media' => '重写媒体元数据',
        'rewrite_media_helper' => '此选项将删除所有多余的媒体文件并重新创建(图像、音频、字幕、章节、 …)',
        'clear_cache' => '清除所有缓存',
        'clear_cache_helper' => '此选项将从可写/缓存文件夹中删除整个 redis 缓存或缓存文件。',
        'run' => '运行维护任务',
        'runSuccess' => '维护成功！',
    ],
    'theme' => [
        'title' => '主题',
        'accent_section_title' => '主题色',
        'accent_section_subtitle' => '选择一个颜色来确定所有公共页面的外观体验。',
        'pine' => '松色',
        'crimson' => '绯红',
        'amber' => '琥珀',
        'lake' => '湖色',
        'jacaranda' => '蓝花楹',
        'onyx' => '黑玛瑙色',
        'submit' => '保存',
        'setInstanceThemeSuccess' => '主题已更新！',
    ],
];
