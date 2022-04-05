<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Seizoen {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Aflevering {episodeNumber}',
    'number_abbr' => 'Af. {episodeNumber}',
    'season_episode' => 'Seizoen {seasonNumber} aflevering {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}E{episodeNumber}',
    'number_of_comments' => '{numberOfComments, plural,
        one {# reactie}
        other {# reacties}
    }',
    'all_podcast_episodes' => 'Alle podcast afleveringen',
    'back_to_podcast' => 'Terug naar podcast',
    'edit' => 'Bewerken',
    'publish' => 'Publiceren',
    'publish_edit' => 'Publicatie bewerken',
    'unpublish' => 'Publicatie ongedaan maken',
    'publish_error' => 'Aflevering is reeds gepubliceerd.',
    'publish_edit_error' => 'Aflevering is reeds gepubliceerd.',
    'publish_cancel_error' => 'Aflevering is reeds gepubliceerd.',
    'unpublish_error' => 'Aflevering is niet gepubliceerd.',
    'delete' => 'Verwijder',
    'go_to_page' => 'Ga naar pagina',
    'create' => 'Aflevering toevoegen',
    'publication_status' => [
        'published' => 'Gepubliceerd',
        'scheduled' => 'Gepland',
        'not_published' => 'Niet gepubliceerd',
    ],
    'list' => [
        'episode' => 'Aflevering',
        'visibility' => 'Zichtbaarheid',
        'comments' => 'Reacties',
        'actions' => 'Acties',
    ],
    'messages' => [
        'createSuccess' => 'Aflevering is succesvol aangemaakt!',
        'editSuccess' => 'Aflevering is succesvol bijgewerkt!',
        'publishCancelSuccess' => 'Aflevering publicatie is geannuleerd!',
    ],
    'form' => [
        'file_size_error' =>
            'Uw bestand is te groot! Maximale grootte is {0}. Verhoog de `memory_limit`, `upload_max_filesize` en `post_max_size` waarden in je php configuratiebestand en herstart vervolgens je webserver om je bestand te uploaden.',
        'audio_file' => 'Geluidsbestand',
        'audio_file_hint' => 'Kies een .mp3 of .m4a audiobestand.',
        'info_section_title' => 'Aflevering informatie',
        'cover' => 'Aflevering omslag',
        'cover_hint' =>
            'Als je geen omslag instelt, zal de podcast omslag worden gebruikt.',
        'cover_size_hint' => 'Omslag moet minstens 1400px breed en hoog zijn.',
        'title' => 'Titel',
        'title_hint' =>
            'Moet een duidelijke en beknopte afleveringsnaam bevatten. Geef hier geen aflevering of seizoen nummers op.',
        'permalink' => 'Permanente koppeling',
        'season_number' => 'Seizoen',
        'episode_number' => 'Aflevering',
        'type' => [
            'label' => 'Soort',
            'full' => 'Vol',
            'full_hint' => 'Volledige inhoud (aflevering)',
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
        'transcript' => 'Transcript (subtitles / closed captions)',
        'transcript_hint' => 'Only .srt are allowed.',
        'transcript_download' => 'Download transcript',
        'transcript_file' => 'Transcript file (.srt)',
        'transcript_remote_url' => 'Remote url for transcript',
        'transcript_file_delete' => 'Delete transcript file',
        'chapters' => 'Chapters',
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
        'submit_create' => 'Create episode',
        'submit_edit' => 'Save episode',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Back to episode dashboard',
        'post' => 'Your announcement post',
        'post_hint' =>
            "Write a message to announce the publication of your episode. The message will be broadcasted to all your followers in the fediverse and be featured in your podcast's homepage.",
        'message_placeholder' => 'Write your message…',
        'publication_date' => 'Publication date',
        'publication_method' => [
            'now' => 'Now',
            'schedule' => 'Schedule',
        ],
        'scheduled_publication_date' => 'Scheduled publication date',
        'scheduled_publication_date_clear' => 'Clear publication date',
        'scheduled_publication_date_hint' =>
            'You can schedule the episode release by setting a future publication date. This field must be formatted as YYYY-MM-DD HH:mm',
        'submit' => 'Publish',
        'submit_edit' => 'Edit publication',
        'cancel_publication' => 'Cancel publication',
        'message_warning' => 'You did not write a message for your announcement post!',
        'message_warning_hint' => 'Having a message increases social engagement, resulting in a better visibility for your episode.',
        'message_warning_submit' => 'Publish anyways',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Unpublishing the episode will delete all the posts associated with it and remove it from the podcast's RSS feed.",
        'understand' => 'I understand, I want to unpublish the episode',
        'submit' => 'Unpublish',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Deleting the episode will delete all the posts associated with it and remove it from the podcast's RSS feed.",
        'understand' => 'I understand, I want to delete the episode',
        'submit' => 'Delete',
    ],
    'embed' => [
        'title' => 'Embeddable player',
        'label' =>
            'Pick a theme color, copy the embeddable player to clipboard, then paste it on your website.',
        'clipboard_iframe' => 'Copy embeddable player to clipboard',
        'clipboard_url' => 'Copy address to clipboard',
        'dark' => 'Dark',
        'dark-transparent' => 'Dark transparent',
        'light' => 'Light',
        'light-transparent' => 'Light transparent',
    ],
];
