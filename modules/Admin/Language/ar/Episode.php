<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'الموسم {seasonNumber}',
    'season_abbr' => 'م{seasonNumber}',
    'number' => 'الحلقة {episodeNumber}',
    'number_abbr' => 'الحلقة {episodeNumber}',
    'season_episode' => 'الموسم {seasonNumber} الحلقة {episodeNumber}',
    'season_episode_abbr' => 'م{seasonNumber}ح{episodeNumber}',
    'number_of_comments' => '{numberOfComments, plural,
        one {# comment}
        other {# comments}
    }',
    'all_podcast_episodes' => 'كافة حلقات البودكاست',
    'back_to_podcast' => 'العودة إلى البودكاست',
    'edit' => 'تعديل',
    'publish' => 'نشر',
    'publish_edit' => 'تعديل المنشور',
    'unpublish' => 'إلغاء النشر',
    'publish_error' => 'Episode is already published.',
    'publish_edit_error' => 'Episode is already published.',
    'publish_cancel_error' => 'Episode is already published.',
    'unpublish_error' => 'الحلقة غير منشورة.',
    'delete' => 'احذف',
    'go_to_page' => 'الانتقال إلى الصفحة',
    'create' => 'إضافة حلقة',
    'publication_status' => [
        'published' => 'نُشِرَت',
        'scheduled' => 'مُبَرمَجة',
        'not_published' => 'غير منشورة',
    ],
    'list' => [
        'search' => [
            'placeholder' => 'Search for an episode',
            'clear' => 'Clear search',
            'submit' => 'Search',
        ],
        'number_of_episodes' => '{numberOfEpisodes, plural,
            one {# episode}
            other {# episodes}
        }',
        'episode' => 'الحلقة',
        'visibility' => 'الظهور',
        'comments' => 'التعليقات',
        'actions' => 'الإجراءات',
    ],
    'messages' => [
        'createSuccess' => 'تم إنشاء الحلقة بنجاح!',
        'editSuccess' => 'تم تحديث الحلقة بنجاح!',
        'publishCancelSuccess' => 'تم إلغاء نشر الحلقة بنجاح!',
        'unpublishBeforeDeleteTip' => 'You must unpublish the episode before deleting it.',
        'deletePublishedEpisodeError' => 'Please unpublish the episode before deleting it.',
        'deleteSuccess' => 'Episode successfully deleted!',
        'deleteError' => 'Failed to delete episode {type, select,
            transcript {transcript}
            chapters {chapters}
            image {cover}
            audio {audio}
            other {media}
        }.',
        'deleteFileError' => 'Failed to delete {type, select,
            transcript {transcript}
            chapters {chapters}
            image {cover}
            audio {audio}
            other {media}
        } file {file_path}. You may manually remove it from your disk.',
        'sameSlugError' => 'An episode with the chosen slug already exists.',
    ],
    'form' => [
        'file_size_error' =>
            'Your file size is too big! Max size is {0}. Increase the `memory_limit`, `upload_max_filesize` and `post_max_size` values in your php configuration file then restart your web server to upload your file.',
        'audio_file' => 'ملف صوتي',
        'audio_file_hint' => 'Choose an .mp3 or .m4a audio file.',
        'info_section_title' => 'معلومات الحلقة',
        'cover' => 'غلاف الحلقة',
        'cover_hint' =>
            'If you do not set a cover, the podcast cover will be used instead.',
        'cover_size_hint' => 'Cover must be squared and at least 1400px wide and tall.',
        'title' => 'العنوان',
        'title_hint' =>
            'Should contain a clear and concise episode name. Do not specify the episode or season numbers here.',
        'permalink' => 'الرابط الدائم',
        'season_number' => 'الموسم',
        'episode_number' => 'الحلقة',
        'type' => [
            'label' => 'النوع',
            'full' => 'Full',
            'full_hint' => 'Complete content (the episode)',
            'trailer' => 'Trailer',
            'trailer_hint' => 'Short, promotional piece of content that represents a preview of the current show',
            'bonus' => 'Bonus',
            'bonus_hint' => 'Extra content for the show (for example, behind the scenes info or interviews with the cast) or cross-promotional content for another show',
        ],
        'parental_advisory' => [
            'label' => 'Parental advisory',
            'hint' => 'Does the episode contain explicit content?',
            'undefined' => 'undefined',
            'clean' => 'Clean',
            'explicit' => 'Explicit',
        ],
        'show_notes_section_title' => 'عرض الملاحظات',
        'show_notes_section_subtitle' =>
            'Up to 4000 characters, be clear and concise. Show notes help potential listeners in finding the episode.',
        'description' => 'الوصف',
        'description_footer' => 'Description footer',
        'description_footer_hint' =>
            'This text is added at the end of each episode description, it is a good place to input your social links for example.',
        'additional_files_section_title' => 'ملفات إضافية',
        'additional_files_section_subtitle' =>
            'These files may be used by other platforms to provide better experience to your audience. See the {podcastNamespaceLink} for more information.',
        'location_section_title' => 'Location',
        'location_section_subtitle' => 'What place is this episode about?',
        'location_name' => 'Location name or address',
        'location_name_hint' => 'This can be a real or fictional location',
        'transcript' => 'Transcript (subtitles / closed captions)',
        'transcript_hint' => 'Only .srt are allowed.',
        'transcript_download' => 'Download transcript',
        'transcript_file' => 'Transcript file (.srt)',
        'transcript_remote_url' => 'Remote url for transcript',
        'transcript_file_delete' => 'Delete transcript file',
        'chapters' => 'الفصول',
        'chapters_hint' => 'File must be in JSON Chapters format.',
        'chapters_download' => 'Download chapters',
        'chapters_file' => 'Chapters file',
        'chapters_remote_url' => 'Remote url for chapters file',
        'chapters_file_delete' => 'Delete chapters file',
        'advanced_section_title' => 'Advanced Parameters',
        'advanced_section_subtitle' =>
            'If you need RSS tags that Castopod does not handle, set them here.',
        'custom_rss' => 'Custom RSS tags for the episode',
        'custom_rss_hint' => 'This will be injected within the ❬item❭ tag.',
        'block' => 'Episode should be hidden from all platforms',
        'block_hint' =>
            'The episode show or hide post. If you want this episode removed from the Apple directory, toggle this on.',
        'submit_create' => 'إنشاء حلقة',
        'submit_edit' => 'حفظ الحلقة',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Back to episode dashboard',
        'post' => 'Your announcement post',
        'post_hint' =>
            "Write a message to announce the publication of your episode. The message will be broadcasted to all your followers in the fediverse and be featured in your podcast's homepage.",
        'message_placeholder' => 'اكتب رسالتك…',
        'publication_date' => 'تاريخ النشر',
        'publication_method' => [
            'now' => 'الآن',
            'schedule' => 'برمجة',
        ],
        'scheduled_publication_date' => 'Scheduled publication date',
        'scheduled_publication_date_clear' => 'Clear publication date',
        'scheduled_publication_date_hint' =>
            'You can schedule the episode release by setting a future publication date. This field must be formatted as YYYY-MM-DD HH:mm',
        'submit' => 'Publish',
        'submit_edit' => 'تعديل المنشور',
        'cancel_publication' => 'إلغاء المنشور',
        'message_warning' => 'You did not write a message for your announcement post!',
        'message_warning_hint' => 'Having a message increases social engagement, resulting in a better visibility for your episode.',
        'message_warning_submit' => 'Publish anyways',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Unpublishing the episode will delete all the posts associated with it and remove it from the podcast's RSS feed.",
        'understand' => 'I understand, I want to unpublish the episode',
        'submit' => 'إلغاء النشر',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Deleting the episode will delete all media files, comments, video clips and soundbites associated with it.",
        'understand' => 'I understand, I want to delete the episode',
        'submit' => 'Delete',
    ],
    'embed' => [
        'title' => 'Embeddable player',
        'label' =>
            'Pick a theme color, copy the embeddable player to clipboard, then paste it on your website.',
        'clipboard_iframe' => 'Copy embeddable player to clipboard',
        'clipboard_url' => 'Copy address to clipboard',
        'dark' => 'داكن',
        'dark-transparent' => 'داكن شفاف',
        'light' => 'Light',
        'light-transparent' => 'Light transparent',
    ],
];
