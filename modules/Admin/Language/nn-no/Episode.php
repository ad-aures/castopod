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
    'preview' => 'Førehandsvising',
    'publish' => 'Legg ut',
    'publish_edit' => 'Rediger publiseringa',
    'publish_date_edit' => 'Rediger publiseringsdatoen',
    'unpublish' => 'Avpubliser',
    'publish_error' => 'Episoden er allereie publisert.',
    'publish_edit_error' => 'Episoden er allereie publisert.',
    'publish_cancel_error' => 'Episoden er allereie publisert.',
    'publish_date_edit_error' => 'Episoden er ikkje lagt ut enno, så du kan ikkje endra publiseringsdatoen.',
    'publish_date_edit_future_error' => 'Du kan berre setja publiseringsdatoen til ein tidlegare dato. Viss du vil endra planlagd publisering, kan du avpublisera episoden fyrst.',
    'publish_date_edit_success' => 'Publiseringsdatoen er endra.',
    'unpublish_error' => 'Episoden er ikkje publisert.',
    'delete' => 'Slett',
    'go_to_page' => 'Gå til side',
    'create' => 'Legg til ein episode',
    'publication_status' => [
        'published' => 'Lagt ut',
        'with_podcast' => 'Lagt ut',
        'scheduled' => 'Planlagt',
        'not_published' => 'Ikkje lagt ut',
    ],
    'with_podcast_hint' => 'Skal gjevast ut samstundes som podkasten',
    'list' => [
        'search' => [
            'placeholder' => 'Søk etter ein episode',
            'clear' => 'Tøm søket',
            'submit' => 'Søk',
        ],
        'number_of_episodes' => '{numberOfEpisodes, plural,
            one {# episode}
            other {# episodar}
        }',
        'episode' => 'Episode',
        'visibility' => 'Synlegheit',
        'downloads' => 'Nedlastingar',
        'comments' => 'Kommentarar',
        'actions' => 'Handlingar',
    ],
    'messages' => [
        'createSuccess' => 'Episoden er oppretta!',
        'editSuccess' => 'Episoden er oppdatert!',
        'publishSuccess' => '{publication_status, select,
            published {Episoden er lagt ut.}
            scheduled {Episoden er planlagt lagt ut.}
            with_podcast {Denne episoden blir lagt ut samstundes som podkasten.}
            other {Denne episoden er ikkje lagt ut.}
        }',
        'publishCancelSuccess' => 'Du har avbrote å leggja ut episoden.',
        'unpublishBeforeDeleteTip' => 'Du må avpublisera episoden før du slettar han.',
        'scheduleDateError' => 'Du må velja publiseringsdato.',
        'deletePublishedEpisodeError' => 'Du må avpublisera episoden før du slettar han.',
        'deleteSuccess' => 'Episoden er sletta.',
        'deleteError' => 'Greidde ikkje sletta {type, select,
            transcript {transkripsjon}
            chapters {kapittel}
            image {omslag}
            audio {lyd}
            other {media}
        } for episoden.',
        'deleteFileError' => 'Greidde ikkje sletta {type, select,
            transcript {transkripsjons}
            chapters {kapittel}
            image {omslags}
            audio {lyd}
            other {media}
        }fila {file_key}. Du kan fjerna ho manuelt.',
        'sameSlugError' => 'Ei episode med denne kortadressa finst allereie.',
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
        'cover_size_hint' => 'Omslaget må vera kvadratisk, og minst 1400pkt breitt og høgt.',
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
        'premium' => 'Episoden må vera tilgjengeleg berre for premium-abonnentar',
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
            'Desse filene kan brukast av andre plattformer for å gje publikum ei betre oppleving. Sjå {podcastNamespaceLink} for meir informasjon.',
        'location_section_title' => 'Stad',
        'location_section_subtitle' => 'Kva stad handlar denne episoden om?',
        'location_name' => 'Stadnamn eller adresse',
        'location_name_hint' => 'Dette kan vera ein verkeleg eller oppdikta stad',
        'transcript' => 'Transkribering (undertitlar eller teksting)',
        'transcript_hint' => 'Berre .srt eller .vtt er lov.',
        'transcript_download' => 'Last ned transkriberinga',
        'transcript_file' => 'Transkriberingsfil (.srt eller .vtt)',
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
        'block' => 'Episoden skal gøymast frå offentlege katalogar',
        'block_hint' =>
            'Vis- eller gøym- status for episoden: Dersom du skrur på dette, hindrar det at episoden kjem opp i Apple podcasts, Google podcasts og andre tredjeparts-appar som hentar podkastar frå desse (men ingen garanti)',
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
            'with_podcast' => 'Legg ut saman med podkast',
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
        'new_publication_date' => 'Ny publiseringsdato',
        'new_publication_date_hint' => 'Må vera ein dato i fortida.',
        'submit' => 'Rediger publiseringsdatoen',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Viss du avpubliserer episoden, slettar du alle kommentarar og innlegg til han, og fjernar han frå RSS-straumen til podkasten.",
        'understand' => 'Eg forstår, eg vil avpublisera episoden',
        'submit' => 'Avpubliser',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Viss du slettar episoden, slettar du òg alle tilknytte mediafiler, kommentarar, filmklypp og lydbetar.",
        'understand' => 'Eg forstår, eg vil sletta episoden',
        'submit' => 'Slett',
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
    'publication_status_banner' => [
        'draft_mode' => 'kladdemodus',
        'text' => '{publication_status, select,
            published {Episoden er ikkje lagt ut enno.}
            scheduled {Episoden er planlagt lagt ut på {publication_date}.}
            with_podcast {Denne episoden blir lagt ut samstundes som podkasten.}
            other {Denne episoden er ikkje lagt ut enno.}
        }',
        'preview' => 'Førehandsvising',
    ],
];
