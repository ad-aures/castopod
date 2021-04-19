<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Sezon {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Odcinek {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Sezon {seasonNumber}, odcinek {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}E{episodeNumber}',
    'back_to_episodes' => 'Wróć do odcinków {podcast}',
    'activity' => 'Activity',
    'description' => 'Opis',
    'total_favourites' => '{numberOfTotalFavourites, plural,
        one {# łącznie polubienie}
        few {# łącznie polubienia}
        many {# lacznie polubień}
        other {# łącznie polubienia}
    }',
    'total_reblogs' => '{numberOfTotalReblogs, plural,
        one {# total share}
        other {# total shares}
    }',
    'total_notes' => '{numberOfTotalNotes, plural,
        one {# note}
        other {# total notes}
    }',
    'all_podcast_episodes' => 'Wszystkie odcinki podcastu',
    'back_to_podcast' => 'Wróć do podcastu',
    'edit' => 'Edytuj',
    'publish' => 'Puvlikuj',
    'publish_edit' => 'Edytuj publikację',
    'unpublish' => 'Cofnij publikację',
    'delete' => 'Usuń',
    'go_to_page' => 'Przejdź na stronę',
    'create' => 'Dodaj odcinek',
    'publication_status' => [
        'published' => 'Opublikowano {0}',
        'scheduled' => 'Zaplanowano na {0}',
        'not_published' => 'Nie opublikowano',
    ],
    'form' => [
        'warning' =>
            'In case of fatal error, try increasing the `memory_limit`, `upload_max_filesize` and `post_max_size` values in your php configuration file then restart your web server.<br />These values must be higher than the audio file you wish to upload.',
        'enclosure' => 'Plik dźwiękowy',
        'enclosure_hint' => 'Wybierz plik dźwiękowy .mp3 lub .m4a.',
        'info_section_title' => 'Informacje o odcinku',
        'info_section_subtitle' => '',
        'image' => 'Cover image',
        'image_hint' =>
            'If you do not set an image, the podcast cover will be used instead.',
        'title' => 'Tytuł',
        'title_hint' =>
            'Should contain a clear and concise episode name. Do not specify the episode or season numbers here.',
        'slug' => 'Slug',
        'slug_hint' => 'Wykorzystywany do generowania adresu URL odcinka.',
        'season_number' => 'Sezon',
        'episode_number' => 'Odcinek',
        'type' => [
            'label' => 'Rodzaj',
            'hint' =>
                '- <strong>full</strong>: complete content the episode.<br/>- <strong>trailer</strong>: short, promotional piece of content that represents a preview of the current show.<br/>- <strong>bonus</strong>: extra content for the show (for example, behind the scenes info or interviews with the cast) or cross-promotional content for another show.',
            'full' => 'Pełny',
            'trailer' => 'Zapowiedź',
            'bonus' => 'Bonus',
        ],
        'parental_advisory' => [
            'label' => 'Parental advisory',
            'hint' => 'Does the episode contain explicit content?',
            'undefined' => 'undefined',
            'clean' => 'Clean',
            'explicit' => 'Explicit',
        ],
        'show_notes_section_title' => 'Show notes',
        'show_notes_section_subtitle' =>
            'Up to 4000 characters, be clear and concise. Show notes help potential listeners in finding the episode.',
        'description' => 'Description',
        'description_footer' => 'Description footer',
        'description_footer_hint' =>
            'This text is added at the end of each episode description, it is a good place to input your social links for example.',
        'additional_files_section_title' => 'Additional files',
        'additional_files_section_subtitle' =>
            'These files may be used by other platforms to provide better experience to your audience.<br />See the {podcastNamespaceLink} for more information.',
        'location_section_title' => 'Location',
        'location_section_subtitle' => 'What place is this episode about?',
        'location_name' => 'Location name or address',
        'location_name_hint' => 'This can be a real or fictional location',
        'transcript' => 'Transcript or closed captions',
        'transcript_hint' => 'Allowed formats are txt, html, srt or json.',
        'transcript_delete' => 'Delete transcript',
        'chapters' => 'Chapters',
        'chapters_hint' => 'File should be in JSON Chapters Format.',
        'chapters_delete' => 'Delete chapters',
        'advanced_section_title' => 'Advanced Parameters',
        'advanced_section_subtitle' =>
            'If you need RSS tags that Castopod does not handle, set them here.',
        'custom_rss' => 'Custom RSS tags for the episode',
        'custom_rss_hint' => 'This will be injected within the ❬item❭ tag.',
        'block' => 'Episode should be hidden from all platforms',
        'block_hint' =>
            'The episode show or hide status. If you want this episode removed from the Apple directory, toggle this on.',
        'submit_create' => 'Utwórz odcinek',
        'submit_edit' => 'Zapisz odcinek',
    ],
    'publish_form' => [
        'note' => 'Twój wpis',
        'note_hint' =>
            'The message you write will be broadcasted to all your followers in the fediverse.',
        'publication_date' => 'Data publikacji',
        'publication_method' => [
            'now' => 'Teraz',
            'schedule' => 'Zaplanuj',
        ],
        'scheduled_publication_date' => 'Data zaplanowanej publikacji',
        'scheduled_publication_date_clear' => 'Wyczyść datę publikacji',
        'scheduled_publication_date_hint' =>
            'You can schedule the episode release by setting a future publication date. This field must be formatted as YYYY-MM-DD HH:mm',
        'submit' => 'Publikuj',
        'submit_edit' => 'Edytuj publikację',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            'Unpublishing the episode will delete all the notes associated with the episode and remove it from the podcast\'s RSS feed.',
        'understand' => 'I understand, I want to unpublish the episode',
        'submit' => 'Cofnij publikację',
    ],
    'soundbites' => 'Soundbites',
    'soundbites_form' => [
        'title' => 'Edit soundbites',
        'info_section_title' => 'Episode soundbites',
        'info_section_subtitle' => 'Add, edit or delete soundbites',
        'start_time' => 'Start',
        'start_time_hint' =>
            'The first second of the soundbite, it can be a decimal number.',
        'duration' => 'Duration',
        'duration_hint' =>
            'The duration of the soundbite (in seconds), it can be a decimal number.',
        'label' => 'Label',
        'label_hint' => 'Text that will be displayed.',
        'play' => 'Play soundbite',
        'delete' => 'Delete soundbite',
        'bookmark' =>
            'Click while playing to get current position, click again to get duration.',
        'submit_edit' => 'Save all soundbites',
    ],
    'embeddable_player' => [
        'add' => 'Dodaj zagnieżdżany odtwarzacz',
        'title' => 'Zagnieżdżany odtwarzacz',
        'label' =>
            'Pick a theme color, copy the embeddable player to clipboard, then paste it on your website.',
        'clipboard_iframe' => 'Copy embeddable player to clipboard',
        'clipboard_url' => 'Skopiuj adres do schowka',
        'dark' => 'Ciemny',
        'dark-transparent' => 'Ciemny przezroczysty',
        'light' => 'Jasny',
        'light-transparent' => 'Jasny przezroczysty',
    ],
];
