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
    'publish_date_edit_error' => 'Aflevering is nog niet gepubliceerd, u kunt de publicatiedatum niet bewerken.',
    'publish_date_edit_future_error' => 'Aflevering publicatiedatum kan alleen worden ingesteld op een datum in het verleden! Als u het opnieuw wilt inplannen, verwijder dan de publicatie eerst.',
    'publish_date_edit_success' => 'De publicatiedatum van aflevering is met succes bijgewerkt!',
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
            published {Deze aflevering is nog niet gepubliceerd!}
            scheduled {Deze aflevering is successvol gepland!}
            with_podcast {Deze aflevering zal op hetzelfde moment als de podcast worden gepubliceerd.}
            other {Deze aflevering is nog niet gepubliceerd.}
        }',
        'publishCancelSuccess' => 'Aflevering publicatie is geannuleerd!',
        'unpublishBeforeDeleteTip' => 'Je moet de publicatie van de aflevering ongedaan maken voordat je deze verwijdert.',
        'scheduleDateError' => 'Geplande datum moet worden ingesteld!',
        'deletePublishedEpisodeError' => 'Je moet de publicatie van de aflevering ongedaan maken voordat je deze verwijdert.',
        'deleteSuccess' => 'Aflevering succesvol verwijderd!',
        'deleteError' => 'Kan de aflevering niet verwijderen {type, select,
            transcript {transcript}
            chapters {hoofdstukken}
            image {cover}
            audio {audio}
            other {media}
        }.',
        'deleteFileError' => 'Mislukt om te verwijderen {type, select,
            transcript {transcript}
            chapters {hoofdstukken}
            image {cover}
            audio {audio}
            other {media}
        } bestand {file_key}. Je kunt het handmatig verwijderen van je schijf.',
        'sameSlugError' => 'Er bestaat al een aflevering met de gekozen slug.',
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
            'trailer_hint' => 'Korte, promotionele inhoud die een voorbeeld van de huidige show vertegenwoordigt',
            'bonus' => 'Bonus',
            'bonus_hint' => 'Extra inhoud voor de show (bijvoorbeeld achter de scène-info of interviews met de deelnemers) of cross-promotionele inhoud voor een andere show',
        ],
        'premium_title' => 'Premium',
        'premium' => 'Aflevering mag alleen toegankelijk zijn voor premium abonnees',
        'parental_advisory' => [
            'label' => 'Ouderlijk advies',
            'hint' => 'Bevat de aflevering de expliciete inhoud?',
            'undefined' => 'niet gedefineerd',
            'clean' => 'Fatsoenlijk',
            'explicit' => 'Expliciet',
        ],
        'show_notes_section_title' => 'Toon notities',
        'show_notes_section_subtitle' =>
            'Maximaal 4000 tekens, wees duidelijk en beknopt. Notities helpen potentiële luisteraars om de aflevering te vinden.',
        'description' => 'Omschrijving',
        'description_footer' => 'Omschrijving voettekst',
        'description_footer_hint' =>
            'Deze tekst wordt aan het einde van elke aflevering beschrijving toegevoegd, het is een goede plek om bijvoorbeeld je sociale links te plaatsen.',
        'additional_files_section_title' => 'Extra bestanden',
        'additional_files_section_subtitle' =>
            'Deze bestanden kunnen door andere platforms worden gebruikt om uw publiek een betere ervaring te bieden. Zie de {podcastNamespaceLink} voor meer informatie.',
        'location_section_title' => 'Locatie',
        'location_section_subtitle' => 'Over welke plaats gaat deze aflevering?',
        'location_name' => 'Locatienaam of adres',
        'location_name_hint' => 'Dit kan een echte of fictieve locatie zijn',
        'transcript' => 'Transcript (ondertiteling / gesloten ondertitels)',
        'transcript_hint' => 'Alleen .srt of .vtt zijn toegestaan.',
        'transcript_download' => 'Transcriptie downloaden',
        'transcript_file' => 'Transcript-bestand (.srt of .vtt)',
        'transcript_remote_url' => 'Externe URL voor transcript',
        'transcript_file_delete' => 'Verwijder transcript-bestand',
        'chapters' => 'Hoofdstukken',
        'chapters_hint' => 'Bestand moet in JSON Hoofdstuk indeling zijn.',
        'chapters_download' => 'Hoofdstukken downloaden',
        'chapters_file' => 'Hoofdstukken bestand',
        'chapters_remote_url' => 'Externe URL voor hoofdstukken bestand',
        'chapters_file_delete' => 'Verwijder hoofdstukken bestand',
        'advanced_section_title' => 'Geavanceerde parameters',
        'advanced_section_subtitle' =>
            'Als je RSS tags nodig hebt die Castopod niet afhandelt, stel ze hier in.',
        'custom_rss' => 'Aangepaste RSS labels voor de aflevering',
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
