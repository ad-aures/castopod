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
    'preview' => 'Voorbeeld',
    'publish' => 'Publiceren',
    'publish_edit' => 'Publicatie bewerken',
    'publish_date_edit' => 'Publicatiedatum bewerken',
    'unpublish' => 'Publicatie ongedaan maken',
    'publish_error' => 'Aflevering is reeds gepubliceerd.',
    'publish_edit_error' => 'Aflevering is reeds gepubliceerd.',
    'publish_cancel_error' => 'Aflevering is reeds gepubliceerd.',
    'publish_date_edit_error' => 'Episode has not been published yet, you cannot edit its publication date.',
    'publish_date_edit_future_error' => 'Episode\'s publication date can only be set to a past date! If you would like to reschedule it, unpublish it first.',
    'publish_date_edit_success' => 'Episode\'s publication date has been updated successfully!',
    'unpublish_error' => 'Aflevering is niet gepubliceerd.',
    'delete' => 'Verwijder',
    'go_to_page' => 'Ga naar pagina',
    'create' => 'Aflevering toevoegen',
    'publication_status' => [
        'published' => 'Gepubliceerd',
        'with_podcast' => 'Gepubliceerd',
        'scheduled' => 'Gepland',
        'not_published' => 'Niet gepubliceerd',
    ],
    'with_podcast_hint' => 'Nog te publiceren op hetzelfde moment als de podcast',
    'list' => [
        'search' => [
            'placeholder' => 'Zoek naar een aflevering',
            'clear' => 'Wis zoekopdracht',
            'submit' => 'Zoeken',
        ],
        'number_of_episodes' => '{numberOfEpisodes, plural,
            one {# aflevering}
            other {# afleveringen}
        }',
        'episode' => 'Aflevering',
        'visibility' => 'Zichtbaarheid',
        'downloads' => 'Downloads',
        'comments' => 'Reacties',
        'actions' => 'Acties',
    ],
    'messages' => [
        'createSuccess' => 'Aflevering is succesvol aangemaakt!',
        'editSuccess' => 'Aflevering is succesvol bijgewerkt!',
        'publishSuccess' => '{publication_status, select,
            published {Episode successfully published!}
            scheduled {Episode publication successfully scheduled!}
            with_podcast {This episode will be published at the same time as the podcast.}
            other {This episode is not published.}
        }',
        'publishCancelSuccess' => 'Aflevering publicatie is geannuleerd!',
        'unpublishBeforeDeleteTip' => 'You must unpublish the episode before deleting it.',
        'scheduleDateError' => 'Schedule date must be set!',
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
        } file {file_key}. You may manually remove it from your disk.',
        'sameSlugError' => 'An episode with the chosen slug already exists.',
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
        'cover_size_hint' => 'Cover must be squared and at least 1400px wide and tall.',
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
        'premium_title' => 'Premium',
        'premium' => 'Aflevering mag alleen toegankelijk zijn voor premium abonnees',
        'parental_advisory' => [
            'label' => 'Ouderlijk advies',
            'hint' => 'Bevat de aflevering de expliciete inhoud?',
            'undefined' => 'niet gedefineerd',
            'clean' => 'Clean',
            'explicit' => 'Expliciet',
        ],
        'show_notes_section_title' => 'Toon notities',
        'show_notes_section_subtitle' =>
            'Up to 4000 characters, be clear and concise. Show notes help potential listeners in finding the episode.',
        'description' => 'Omschrijving',
        'description_footer' => 'Description footer',
        'description_footer_hint' =>
            'This text is added at the end of each episode description, it is a good place to input your social links for example.',
        'additional_files_section_title' => 'Extra bestanden',
        'additional_files_section_subtitle' =>
            'These files may be used by other platforms to provide better experience to your audience. See the {podcastNamespaceLink} for more information.',
        'location_section_title' => 'Locatie',
        'location_section_subtitle' => 'What place is this episode about?',
        'location_name' => 'Location name or address',
        'location_name_hint' => 'Dit kan een echte of fictieve locatie zijn',
        'transcript' => 'Transcript (ondertiteling / gesloten ondertitels)',
        'transcript_hint' => 'Only .srt are allowed.',
        'transcript_download' => 'Transcriptie downloaden',
        'transcript_file' => 'Transcript file (.srt)',
        'transcript_remote_url' => 'Remote url for transcript',
        'transcript_file_delete' => 'Delete transcript file',
        'chapters' => 'Hoofdstukken',
        'chapters_hint' => 'File must be in JSON Chapters format.',
        'chapters_download' => 'Hoofdstukken downloaden',
        'chapters_file' => 'Chapters file',
        'chapters_remote_url' => 'Remote url for chapters file',
        'chapters_file_delete' => 'Delete chapters file',
        'advanced_section_title' => 'Geavanceerde parameters',
        'advanced_section_subtitle' =>
            'If you need RSS tags that Castopod does not handle, set them here.',
        'custom_rss' => 'Custom RSS tags for the episode',
        'custom_rss_hint' => 'This will be injected within the ❬item❭ tag.',
        'block' => 'Episode should be hidden from public catalogues',
        'block_hint' =>
            'The episode show or hide status: toggling this on prevents the episode from appearing in Apple Podcasts, Google Podcasts, and any third party apps that pull shows from these directories. (Not guaranteed)',
        'submit_create' => 'Aflevering aanmaken',
        'submit_edit' => 'Aflevering opslaan',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Back to episode dashboard',
        'post' => 'Your announcement post',
        'post_hint' =>
            "Write a message to announce the publication of your episode. The message will be broadcasted to all your followers in the fediverse and be featured in your podcast's homepage.",
        'message_placeholder' => 'Schrijf uw bericht…',
        'publication_date' => 'Publicatiedatum',
        'publication_method' => [
            'now' => 'Nu',
            'schedule' => 'Plannen',
            'with_podcast' => 'Publiceer samen met podcast',
        ],
        'scheduled_publication_date' => 'Gepland publicatiedatum',
        'scheduled_publication_date_clear' => 'Publicatiedatum wissen',
        'scheduled_publication_date_hint' =>
            'You can schedule the episode release by setting a future publication date. This field must be formatted as YYYY-MM-DD HH:mm',
        'submit' => 'Publiceren',
        'submit_edit' => 'Publicatie bewerken',
        'cancel_publication' => 'Publicatie annuleren',
        'message_warning' => 'You did not write a message for your announcement post!',
        'message_warning_hint' => 'Having a message increases social engagement, resulting in a better visibility for your episode.',
        'message_warning_submit' => 'Toch publiceren',
    ],
    'publish_date_edit_form' => [
        'new_publication_date' => 'Nieuwe publicatiedatum',
        'new_publication_date_hint' => 'Must be set to a past date.',
        'submit' => 'Publicatiedatum bewerken',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Unpublishing the episode will delete all the comments and posts associated with it and remove it from the podcast's RSS feed.",
        'understand' => 'I understand, I want to unpublish the episode',
        'submit' => 'Publicatie ongedaan maken',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Deleting the episode will delete all media files, comments, video clips and soundbites associated with it.",
        'understand' => 'I understand, I want to delete the episode',
        'submit' => 'Verwijderen',
    ],
    'embed' => [
        'title' => 'Embeddable player',
        'label' =>
            'Pick a theme color, copy the embeddable player to clipboard, then paste it on your website.',
        'clipboard_iframe' => 'Copy embeddable player to clipboard',
        'clipboard_url' => 'Kopieer adres naar klembord',
        'dark' => 'Donker',
        'dark-transparent' => 'Dark transparent',
        'light' => 'Licht',
        'light-transparent' => 'Light transparent',
    ],
    'publication_status_banner' => [
        'draft_mode' => 'draft mode',
        'text' => '{publication_status, select,
            published {This episode is not yet published.}
            scheduled {This episode is scheduled for publication on {publication_date}.}
            with_podcast {This episode will be published at the same time as the podcast.}
            other {This episode is not yet published.}
        }',
        'preview' => 'Voorbeeld',
    ],
];
