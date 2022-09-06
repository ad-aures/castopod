<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'warning' =>
        '此过程可能需要很长时间。 由于当前版本在运行时未显示任何进度，因此在完成之前您不会看到任何提示。 在超时错误的情况下，增加 `max_execution_time` 值。',
    'old_podcast_section_title' => '要导入的播客',
    'old_podcast_section_subtitle' =>
        '请确保您在导入之前拥有此播客的权限。 在没有权限的情况下复制和广播播客是盗版行为，可能受到起诉。',
    'imported_feed_url' => '订阅源的 URL',
    'imported_feed_url_hint' => '订阅源必须是 xml 或 rss 格式。',
    'new_podcast_section_title' => '新播客',
    'advanced_params_section_title' => '高级参数',
    'advanced_params_section_subtitle' =>
        '如果您不知道这些字段的用途，请保留默认值。',
    'slug_field' => '用于计算剧集 Slug 的字段',
    'description_field' =>
        '用于剧集描述/节目说明的源字段',
    'force_renumber' => '强制剧集重新编号',
    'force_renumber_hint' =>
        '如果你的播客没有剧集编号但希望在导入时设置，请使用此选项。',
    'season_number' => '季号',
    'season_number_hint' =>
        '如果您的播客没有季号，但希望在导入时设置，请使用此选项，否则留空。',
    'max_episodes' => '要导入的最大剧集数',
    'max_episodes_hint' => '留空导入所有剧集',
    'lock_import' =>
        '此订阅源受到保护。你不能导入它。如果你是所有者，请在原平台取消保护。',
    'submit' => '导入播客',
];
