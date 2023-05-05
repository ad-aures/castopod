<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => '第 {seasonNumber} 节',
    'season_abbr' => '第 {seasonNumber} 节',
    'number' => '第 {episodeNumber} 集',
    'number_abbr' => '第 {episodeNumber} 集',
    'season_episode' => '第 {seasonNumber} 季第 {episodeNumber} 集',
    'season_episode_abbr' => '第 {seasonNumber} 季第 {episodeNumber} 集',
    'number_of_comments' => '{numberOfComments, plural,
        other {# 评论}
        other {# 评论}
    }',
    'all_podcast_episodes' => '所有播客剧集',
    'back_to_podcast' => '返回播客',
    'edit' => '编辑',
    'publish' => '发布',
    'publish_edit' => '编辑发布',
    'publish_date_edit' => '编辑发布日期',
    'unpublish' => '取消发布',
    'publish_error' => '剧集已被发布。',
    'publish_edit_error' => '剧集已被发布。',
    'publish_cancel_error' => '剧集已被发布。',
    'publish_date_edit_error' => '剧集尚未发布，你不能编辑其发布日期。',
    'publish_date_edit_future_error' => '剧集的发布日期只能设置为过去的日期！ 如果你想重新安排日期，请先取消发布。',
    'publish_date_edit_success' => '剧集的发布日期已成功更新！',
    'unpublish_error' => '剧集尚未发布。',
    'delete' => '删除',
    'go_to_page' => '转到页面',
    'create' => '添加剧集',
    'publication_status' => [
        'published' => '已发布',
        'with_podcast' => '已发布',
        'scheduled' => '已预约',
        'not_published' => '未发布',
    ],
    'with_podcast_hint' => '与播客同时发布',
    'list' => [
        'search' => [
            'placeholder' => '搜索剧集',
            'clear' => '清除搜索内容',
            'submit' => '搜索',
        ],
        'number_of_episodes' => '{numberOfEpisodes, plural,
            other {# 剧集}
            other {# 剧集}
        }',
        'episode' => '剧集',
        'visibility' => '可见性',
        'downloads' => '下载',
        'comments' => '评论',
        'actions' => '操作',
    ],
    'messages' => [
        'createSuccess' => '剧集已创建！',
        'editSuccess' => '剧集已更新！',
        'publishSuccess' => '{publication_status, select,
            published {剧集已成功发布！}
            scheduled {剧集已成功预约！}
            with_podcast {剧集将与播客同时发布。}
            other {此剧集未发布。}
        }',
        'publishCancelSuccess' => '成功取消剧集发布！',
        'unpublishBeforeDeleteTip' => '你必须在删除之前取消发布剧集。',
        'scheduleDateError' => '计划日期必须设置！',
        'deletePublishedEpisodeError' => '请在删除之前取消发布该剧集。',
        'deleteSuccess' => '已删除剧集！',
        'deleteError' => '未能删除剧集 {type, select,
            transcript {字幕}
            chapters {章节}
            image {封面}
            audio {音频}
            other {媒体}
        }',
        'deleteFileError' => '无法删除 {type, select,
            transcript {字幕}
            chapters {章节}
            image {封面}
            audio {音频}
            other {媒体}
        } 文件 {file_path}。您可以手动将其从磁盘删除。',
        'sameSlugError' => '选中的剧集已存在。',
    ],
    'form' => [
        'file_size_error' =>
            '你的文件太大了！最大尺寸是 {0}。 在你的 php 配置文件中增加`memory_limit`, `upload_max_filesize` 和 `post_max_size` 值，然后重启你的 web 服务器上传文件。',
        'audio_file' => '音频文件',
        'audio_file_hint' => '选择一个 .mp3 或 .m4a 音频文件。',
        'info_section_title' => '剧集信息',
        'cover' => '剧集封面',
        'cover_hint' =>
            '如果你没有设置封面，将使用播客封面。',
        'cover_size_hint' => '封面必须是方形，而且至少 1400 px 宽度和高度。',
        'title' => '标题',
        'title_hint' =>
            '应包含清晰简洁的剧集名称。 不要在此处指定剧集或季编号。',
        'permalink' => '永久链接',
        'season_number' => '季',
        'episode_number' => '剧集',
        'type' => [
            'label' => '类型',
            'full' => '全屏',
            'full_hint' => '完整内容 (剧集)',
            'trailer' => '预告片',
            'trailer_hint' => '代表当前剧集的的摘要',
            'bonus' => '奖金',
            'bonus_hint' => '剧集趣闻（例如，幕后信息与对演员的采访）或另一个剧集的推荐',
        ],
        'premium_title' => '高级版',
        'premium' => '剧集仅允许高级订阅者访问',
        'parental_advisory' => [
            'label' => '警告标记',
            'hint' => '剧集是否包含限制级内容？',
            'undefined' => '未定义',
            'clean' => '重置为默认',
            'explicit' => '限制级',
        ],
        'show_notes_section_title' => '显示备注',
        'show_notes_section_subtitle' =>
            '清晰简洁，最多 4000 个字。显示笔记能帮助潜在的听众找到剧集。',
        'description' => '描述',
        'description_footer' => '说明页脚',
        'description_footer_hint' =>
            '此文本添加在每集描述的末尾，例如，是输入你链接的好位置。',
        'additional_files_section_title' => '附件',
        'additional_files_section_subtitle' =>
            '这些文件可能被其他播客平台用来生成提供更好的体验。 想要了解，请参阅 {podcastNamespaceLink}。',
        'location_section_title' => '位置',
        'location_section_subtitle' => '这个剧集在哪里？',
        'location_name' => '位置名称或地址',
        'location_name_hint' => '真或假位置都可以',
        'transcript' => '字幕(字幕/隐藏字幕)',
        'transcript_hint' => '仅允许使用 .srt。',
        'transcript_download' => '下载字幕',
        'transcript_file' => '字幕文件(.srt)',
        'transcript_remote_url' => '用于字幕的网址',
        'transcript_file_delete' => '删除字幕文件',
        'chapters' => '章节',
        'chapters_hint' => '文件必须为 JSON 格式。',
        'chapters_download' => '下载章节',
        'chapters_file' => '章节文件',
        'chapters_remote_url' => '章节文件网址',
        'chapters_file_delete' => '删除章节文件',
        'advanced_section_title' => '高级参数',
        'advanced_section_subtitle' =>
            '如果你不需要 Castopod 处理某些订阅源标签，请在此处设置。',
        'custom_rss' => '剧集的自定义订阅标签',
        'custom_rss_hint' => '这将被注入到 ❬item❭ 标签中。',
        'block' => '剧集应该在公共目录中隐藏',
        'block_hint' =>
            '剧集显示或隐藏状态：打开此选项可防止整个剧集出现在 Apple 播客、Google 播客以及从此目录中提取剧集的任何第三方应用程序中。（不保证）',
        'submit_create' => '创建剧集',
        'submit_edit' => '保存剧集',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => '返回剧集控制面板',
        'post' => '你的公告播文',
        'post_hint' =>
            "写一条消息来宣布你有剧集发布。 此消息将向联邦宇宙中所有你的关注者推送，并在你的播客主页中出现。",
        'message_placeholder' => '写下你的消息…',
        'publication_date' => '发布日期',
        'publication_method' => [
            'now' => '现在',
            'schedule' => '计划',
            'with_podcast' => '与播客一起发布',
        ],
        'scheduled_publication_date' => '计划发布日期',
        'scheduled_publication_date_clear' => '清除发布日期',
        'scheduled_publication_date_hint' =>
            '你可以通过设置未来发布日期来安排剧集发布。此字段必须格式为 YYYY-MM-DD HH:mm',
        'submit' => '发布',
        'submit_edit' => '编辑发布',
        'cancel_publication' => '取消发布',
        'message_warning' => '你没有为你的公告播文写一条消息！',
        'message_warning_hint' => '有消息发送可以增加社交参与度，从而提高你的剧集曝光度。',
        'message_warning_submit' => '仍然发布',
    ],
    'publish_date_edit_form' => [
        'new_publication_date' => '新发布日期',
        'new_publication_date_hint' => '必须设置为过去的日期。',
        'submit' => '编辑发布日期',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "取消发布该剧集将删除相关的所有评论和播文，并将其从播客的订阅源中删除。",
        'understand' => '我明白，我想取消发布此剧集',
        'submit' => '取消发布',
    ],
    'delete_form' => [
        'disclaimer' =>
            "删除剧集将删除相关的所有媒体文件、评论、视频素材和原声摘要。",
        'understand' => '我明白，我想删除剧集',
        'submit' => '删除',
    ],
    'embed' => [
        'title' => '嵌入式播放器',
        'label' =>
            '选择主题色，将嵌入式播放器复制到剪贴板，然后粘贴到你的网站。',
        'clipboard_iframe' => '复制嵌入播放器到剪贴板',
        'clipboard_url' => '复制地址到剪贴板',
        'dark' => '暗色',
        'dark-transparent' => '暗色透明',
        'light' => '亮色',
        'light-transparent' => '亮色透明',
    ],
];
