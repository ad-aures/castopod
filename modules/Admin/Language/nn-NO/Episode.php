<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Sesong {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Episode {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Sesong {seasonNumber} episode {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}E{episodeNumber}',
    'number_of_comments' => '{numberOfComments, plural,
        one {# kommentar}
        other {# kommentarar}
    }',
    'all_podcast_episodes' => 'Alle podkast-episodane',
    'back_to_podcast' => 'Gå tilbake til podkasten',
    'edit' => 'Rediger',
    'publish' => 'Legg ut',
    'publish_edit' => 'Rediger publiseringa',
    'publish_date_edit' => 'Edit publication date',
    'unpublish' => 'Avpubliser',
    'publish_error' => 'Episoden er allereie publisert.',
    'publish_edit_error' => 'Episoden er allereie publisert.',
    'publish_cancel_error' => 'Episoden er allereie publisert.',
    'publish_date_edit_error' => 'Episode has not been published yet, you cannot edit its publication date.',
    'publish_date_edit_future_error' => 'Episode\'s publication date can only be set to a past date! If you would like to reschedule it, unpublish it first.',
    'publish_date_edit_success' => 'Episode\'s publication date has been updated successfully!',
    'unpublish_error' => 'Episoden er ikkje publisert.',
    'delete' => 'Slett',
    'go_to_page' => 'Gå til side',
    'create' => 'Legg til ein episode',
    'publication_status' => [
        'published' => 'Lagt ut',
        'with_podcast' => 'Published',
        'scheduled' => 'Planlagt',
        'not_published' => 'Ikkje lagt ut',
    ],
    'with_podcast_hint' => 'To be published at the same time as the podcast',
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
        'episode' => 'Episode',
        'visibility' => 'Synlegheit',
        'downloads' => 'Downloads',
        'comments' => 'Kommentarar',
        'actions' => 'Handlingar',
    ],
    'messages' => [
        'createSuccess' => 'Episoden er oppretta!',
        'editSuccess' => 'Episoden er oppdatert!',
        'publishSuccess' => '{publication_status, select,
            published {Episode successfully published!}
            scheduled {Episode publication successfully scheduled!}
            with_podcast {This episode will be published at the same time as the podcast.}
            other {This episode is not published.}
        }',
        'publishCancelSuccess' => 'Du har avbrote å leggja ut episoden.',
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
            'Fila di er for stor! Maks filstorleik er {0}. Auk `memory_limit`, `upload_max_filesize` og `post_max_size`-verdiane i php-oppsettsfila di og start omatt vevtenaren din for å lasta opp fila di.',
        'audio_file' => 'Lydfil',
        'audio_file_hint' => 'Vel ei .mp3- eller .m4a-lydfil.',
        'info_section_title' => 'Episodeinfo',
        'cover' => 'Episodeomslag',
        'cover_hint' =>
            'Viss du ikkje bruker eige omslag, blir omslaget til podkasten brukt i staden.',
        'cover_size_hint' => 'Cover must be squared and at least 1400px wide and tall.',
        'title' => 'Tittel',
        'title_hint' =>
            'Bør innehalda eit klårt og konsist episodenamn. Ikkje skriv inn nummer på episode eller sesong her.',
        'permalink' => 'Fastlenke',
        'season_number' => 'Sesong',
        'episode_number' => 'Episode',
        'type' => [
            'label' => 'Type',
            'full' => 'Full',
            'full_hint' => 'Fullstendig innhald (episoden)',
            'trailer' => 'Trailer',
            'trailer_hint' => 'Kort stykke med blestingsinnhald som representerer denne episoden',
            'bonus' => 'Bonus',
            'bonus_hint' => 'Ekstra innhald (til dømes bakominfo eller intervju med skodespelarane) eller innhald for å framheva ein annan serie',
        ],
        'premium_title' => 'Premium',
        'premium' => 'Episode must be accessible to premium subscribers only',
        'parental_advisory' => [
            'label' => 'Råd til foreldre',
            'hint' => 'Inneheld episoden grov prat?',
            'undefined' => 'udefinert',
            'clean' => 'Familievenleg',
            'explicit' => 'Grovt',
        ],
        'show_notes_section_title' => 'Vis notat',
        'show_notes_section_subtitle' =>
            'Opp til 4000 teikn. Ver tydeleg og konsis. Skriv notat som hjelper lyttarane å finna episoden.',
        'description' => 'Skildring',
        'description_footer' => 'Botntekst for skildringa',
        'description_footer_hint' =>
            'Denne teksten ligg på slutten av kvar episodeskildring, og er ein god stad å ha lenker til td. sosiale nettverk.',
        'additional_files_section_title' => 'Fleire filer',
        'additional_files_section_subtitle' =>
            'These files may be used by other platforms to provide better experience to your audience. See the {podcastNamespaceLink} for more information.',
        'location_section_title' => 'Stad',
        'location_section_subtitle' => 'Kva stad handlar denne episoden om?',
        'location_name' => 'Stadnamn eller adresse',
        'location_name_hint' => 'Dette kan vera ein verkeleg eller oppdikta stad',
        'transcript' => 'Transkribering (undertitlar eller teksting)',
        'transcript_hint' => 'Berre .srt.',
        'transcript_download' => 'Last ned transkriberinga',
        'transcript_file' => 'Transkriberingsfil (.srt)',
        'transcript_remote_url' => 'Ekstern URL for teksting',
        'transcript_file_delete' => 'Slett transkriberingsfila',
        'chapters' => 'Kapittel',
        'chapters_hint' => 'Fila må vera i JSON-kapittelformat.',
        'chapters_download' => 'Last ned kapittel',
        'chapters_file' => 'Kapittelfil',
        'chapters_remote_url' => 'Ekstern URL til kapittelfil',
        'chapters_file_delete' => 'Slett kapittelfila',
        'advanced_section_title' => 'Avanserte innstillingar',
        'advanced_section_subtitle' =>
            'Viss du treng RSS-merkelappar som Castopod ikkje handterer, kan du skriva dei inn her.',
        'custom_rss' => 'Eigne RSS-merkelappar for episoden',
        'custom_rss_hint' => 'Dette blir sett inn i ❬item❭-elementet.',
        'block' => 'Episode should be hidden from public catalogues',
        'block_hint' =>
            'The episode show or hide status: toggling this on prevents the episode from appearing in Apple Podcasts, Google Podcasts, and any third party apps that pull shows from these directories. (Not guaranteed)',
        'submit_create' => 'Lag episode',
        'submit_edit' => 'Lagre episode',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Tilbake til episodeoversikta',
        'post' => 'Kunngjeringsinnlegget ditt',
        'post_hint' =>
            "Skriv ei melding for å kunngjera at du har lagt ut episoden din. Meldinga blir kringkasta til alle fylgjarane dine på fødiverset, og vil stå på heimesida til podkasten din.",
        'message_placeholder' => 'Skriv meldinga…',
        'publication_date' => 'Publiseringsdato',
        'publication_method' => [
            'now' => 'No',
            'schedule' => 'Planlegg',
            'with_podcast' => 'Publish alongside podcast',
        ],
        'scheduled_publication_date' => 'Planlagt publiseringsdato',
        'scheduled_publication_date_clear' => 'Tøm publiseringsdatoen',
        'scheduled_publication_date_hint' =>
            'Du kan planleggja å offengleggjera episoden seinare ved å skriva inn eit publiseringstidspunkt. Feltet må vera i formatet ÅÅÅÅ-MM-DD HH:mm',
        'submit' => 'Legg ut',
        'submit_edit' => 'Rediger publiseringa',
        'cancel_publication' => 'Avbryt publisering',
        'message_warning' => 'Du skreiv inga melding til kunngjeringsinnlegget ditt!',
        'message_warning_hint' => 'Viss du skriv ei melding, kan det gje meir sosialt engasjement og syta for at episoden din blir meir synleg.',
        'message_warning_submit' => 'Legg ut likevel',
    ],
    'publish_date_edit_form' => [
        'new_publication_date' => 'New publication date',
        'new_publication_date_hint' => 'Must be set to a past date.',
        'submit' => 'Edit publication date',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Unpublishing the episode will delete all the comments and posts associated with it and remove it from the podcast's RSS feed.",
        'understand' => 'Eg forstår, eg vil avpublisera episoden',
        'submit' => 'Avpubliser',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Deleting the episode will delete all media files, comments, video clips and soundbites associated with it.",
        'understand' => 'Eg forstår, eg vil sletta episoden',
        'submit' => 'Delete',
    ],
    'embed' => [
        'title' => 'Innbyggbar spelar',
        'label' =>
            'Vel eit fargetema, kopier den innbyggbare spelaren til utklyppstavla og lim han inn på nettstaden din.',
        'clipboard_iframe' => 'Kopier den innbyggbare spelaren til utklyppstavla',
        'clipboard_url' => 'Kopier adressa til utklyppstavla',
        'dark' => 'Mørk',
        'dark-transparent' => 'Mørk gjennomsiktig',
        'light' => 'Lys',
        'light-transparent' => 'Lys gjennomsiktig',
    ],
];
