<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Season {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Episode {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Sezona {seasonNumber} epizoda {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}:E{episodeNumber}',
    'number_of_comments' => '{numberOfComments, plural,
        one {# komentar}
        other {# komentara}
    }',
    'all_podcast_episodes' => 'Sve epizode podkasta',
    'back_to_podcast' => 'Nazad na podkast',
    'edit' => 'Izmeni',
    'publish' => 'Objavi',
    'publish_edit' => 'Uredi objavu',
    'publish_date_edit' => 'Uredi datum objave',
    'unpublish' => 'Opozovi objavu',
    'publish_error' => 'Epizoda je već objavljena.',
    'publish_edit_error' => 'Epizoda je već objavljena.',
    'publish_cancel_error' => 'Epizoda je već objavljena.',
    'publish_date_edit_error' => 'Epizoda još uvek nije objavljena, ne možete urediti datum objave.',
    'publish_date_edit_future_error' => 'Datum objavljivanja epizode može se podesiti samo na pređašnji datum. Ukoliko želite da ponovo zakažete objavu epizode u budućnosti, morate prvo opozvati njenu objavu.',
    'publish_date_edit_success' => 'Datum objave epizode je uspešno uređen!',
    'unpublish_error' => 'Epizoda nije objavljena.',
    'delete' => 'Obriši',
    'go_to_page' => 'Idi na stranu',
    'create' => 'Dodaj epizodu',
    'publication_status' => [
        'published' => 'Objavljeno',
        'with_podcast' => 'Objavljeno',
        'scheduled' => 'Zakazano',
        'not_published' => 'Neobjavljeno',
    ],
    'with_podcast_hint' => 'Objaviti u isto vreme kad i podkast',
    'list' => [
        'search' => [
            'placeholder' => 'Traži epizodu',
            'clear' => 'Očisti pretragu',
            'submit' => 'Pretraga',
        ],
        'number_of_episodes' => '{numberOfEpisodes, plural,
            one {# epizoda}
            other {# epizode}
        }',
        'episode' => 'Epizoda',
        'visibility' => 'Vidljivost',
        'downloads' => 'Downloads',
        'comments' => 'Komentari',
        'actions' => 'Akcije',
    ],
    'messages' => [
        'createSuccess' => 'Epizoda je uspešno kreirana!',
        'editSuccess' => 'Epizoda je uspešno ažurirana!',
        'publishSuccess' => '{publication_status, select,
            published {Epizoda je uspešno objavljena!}
            scheduled {Epizoda je uspešno zakazana!}
            with_podcast {Ova epizoda će biti objavljena u isto vreme kad i podkast.}
            other {Ova epizoda nije objavljena.}
        }',
        'publishCancelSuccess' => 'Objavljivanje epizode je uspešno otkazano!',
        'unpublishBeforeDeleteTip' => 'Morate opozvati objavljivanje epizode pre nego što je izbrišete.',
        'scheduleDateError' => 'Morate zakazati datum objave!',
        'deletePublishedEpisodeError' => 'Molimo vas opozovite objavu epizode pre nego što je izbrišete.',
        'deleteSuccess' => 'Epizoda uspešno izbrisana!',
        'deleteError' => 'Neuspešno brisanje {type, select,
            transcript {transkripta}
            chapters {poglavlja}
            image {omota}
            audio {zvuka}
            other {medija}
        }.',
        'deleteFileError' => 'Neuspešno brisanje {type, select,
            transcript {transkripta}
            chapters {poglavlja}
            image {omota}
            audio {zvuka}
            other {medija}
        } datoteke {file_key}. Možete je ukloniti ručno sa diska.',
        'sameSlugError' => 'Odabrano URL ime (slug) epizode već postoji.',
    ],
    'form' => [
        'file_size_error' =>
            'Veličina vaše datoteke je prevelika! Maksimalna veličina je {0}. Povećajte `memory_limit`, `upload_max_filesize` i `post_max_size` vrednosti u vašoj datoteci php konfiguracije, potom ponovo pokrenite veb server da bi ste otpremili datoteku.',
        'audio_file' => 'Zvučna datoteka',
        'audio_file_hint' => 'Odaberite .mp3 ili .m4a zvučnu datoteku.',
        'info_section_title' => 'Informacije o epizodi',
        'cover' => 'Omot epizode',
        'cover_hint' =>
            'Ukoliko ne postavite omot epizode, koristiće se omot podkasta.',
        'cover_size_hint' => 'Omot mora biti kvadratnog oblika i minimum 1400px širok i visok.',
        'title' => 'Naslov',
        'title_hint' =>
            'Treba sadržati jasan i koncizan naziv epizode. Nemojte upisivati broj sezone ili epizode ovde.',
        'permalink' => 'Trajni link',
        'season_number' => 'Sezona',
        'episode_number' => 'Epizoda',
        'type' => [
            'label' => 'Vrsta',
            'full' => 'Cela',
            'full_hint' => 'Kompletan sadržaj (epizoda)',
            'trailer' => 'Najava',
            'trailer_hint' => 'Kratak, promotivni deo sadržaja koji predstavlja pregled aktuelne emisije',
            'bonus' => 'Bonus',
            'bonus_hint' => 'Dodatni sadržaj za emisiju (na primer, informacije iza scene ili intervjui sa glumcima) ili unakrsni promotivni sadržaj za drugu emisiju',
        ],
        'premium_title' => 'Premium',
        'premium' => 'Epizoda mora biti dostupna samo premium pretplatnicima',
        'parental_advisory' => [
            'label' => 'Roditeljsko savetovanje',
            'hint' => 'Da li epizoda sadrži eksplicitan sadržaj?',
            'undefined' => 'nedefinisano',
            'clean' => 'Čisto',
            'explicit' => 'Eksplicitno',
        ],
        'show_notes_section_title' => 'Prikaži beleške',
        'show_notes_section_subtitle' =>
            'Do 4000 znakova, budite jasni i sažeti. Beleške pomažu potencijalnim slušaocima da pronađu epizodu.',
        'description' => 'Opis',
        'description_footer' => 'Podnožje opisa',
        'description_footer_hint' =>
            'Ovaj tekst se dodaje na kraj opisa svake epizode, ovo je pravo mesto za vaše linkove ka društvenim mrežama naprimer.',
        'additional_files_section_title' => 'Dodatne datoteke',
        'additional_files_section_subtitle' =>
            'Ove datoteke mogu biti korišćene od strane drugih platformi radi boljeg iskustva vaše publike. Pogledajte {podcastNamespaceLink} za više informacija.',
        'location_section_title' => 'Lokacija',
        'location_section_subtitle' => 'O kom mestu je ova epizoda?',
        'location_name' => 'Ime ili adresa lokacije',
        'location_name_hint' => 'Ovo može biti prava ili fiktivna lokacija',
        'transcript' => 'Transkript (titlovi)',
        'transcript_hint' => 'Samo .srt datoteke su dozvoljene.',
        'transcript_download' => 'Preuzmi transkript',
        'transcript_file' => 'Datoteka transkripta (.srt)',
        'transcript_remote_url' => 'Udaljeni Url za transkript',
        'transcript_file_delete' => 'Obriši datoteku transkripta',
        'chapters' => 'Poglavlja',
        'chapters_hint' => 'Datoteka mora biti u JSON Poglavlja formatu.',
        'chapters_download' => 'Preuzmi poglavlja',
        'chapters_file' => 'Datoteka poglavlja',
        'chapters_remote_url' => 'Udaljeni Url za datoteku poglavlja',
        'chapters_file_delete' => 'Obriši datoteku poglavlja',
        'advanced_section_title' => 'Napredni parametri',
        'advanced_section_subtitle' =>
            'Ukoliko su vam potrebni RSS tagovi koje Castopod ne obrađuje, postavite ih ovde.',
        'custom_rss' => 'Posebni RSS tagovi epizode',
        'custom_rss_hint' => 'Ovo će biti ubačeno u ❬item❭ tag.',
        'block' => 'Epizoda treba biti sakriivena u javnim katalozima',
        'block_hint' =>
            'The episode show or hide status: toggling this on prevents the episode from appearing in Apple Podcasts, Google Podcasts, and any third party apps that pull shows from these directories. (Not guaranteed)',
        'submit_create' => 'Kreiraj epizodu',
        'submit_edit' => 'Sačuvaj epizodu',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Nazad na komandnu tablu epizode',
        'post' => 'Najava vaše objave',
        'post_hint' =>
            "Napišite poruku da najavite objavu vaše epizode. Poruka će biti poslata svim vašim pratiocima u fediversu i istaknuta na stranici vašeg podkasta.",
        'message_placeholder' => 'Napišite poruku…',
        'publication_date' => 'Datum objavljivanja',
        'publication_method' => [
            'now' => 'Sada',
            'schedule' => 'Raspored',
            'with_podcast' => 'Objavi uz podkast',
        ],
        'scheduled_publication_date' => 'Planiran datum objave',
        'scheduled_publication_date_clear' => 'Ukloni datum objave',
        'scheduled_publication_date_hint' =>
            'Možete zakazati objavu epizode u budućnosti. Ovo polje mora biti popunjeno u YYYY-MM-DD HH:mm formatu',
        'submit' => 'Objavi',
        'submit_edit' => 'Uredi objavu',
        'cancel_publication' => 'Poništi objavu',
        'message_warning' => 'Niste napisali poruku za najavu objave!',
        'message_warning_hint' => 'Poruka povećava šanse za angažovanjem na društvenim mrežama, rezultirajući u većoj vidljivosti vaše epizode.',
        'message_warning_submit' => 'Objavi svakako',
    ],
    'publish_date_edit_form' => [
        'new_publication_date' => 'Novi datum objavljivanja',
        'new_publication_date_hint' => 'Mora biti podešeno na prošli datum.',
        'submit' => 'Uredi datum objavljivanja',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Opozivanje objavljivanja epizode će obrisati sve komentare i obajve povezane sa eppizodom i ukloniti je i RSS feed-a podkasta.",
        'understand' => 'Razumem, želim da opozovem objavu epizode',
        'submit' => 'Opozovi objavu',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Brisanje epizode će obrisati sve medijske datoteke, komentare, video i zvučne isečke povezane sa njom.",
        'understand' => 'Razumem, želim da obrišem epizodu',
        'submit' => 'Obriši',
    ],
    'embed' => [
        'title' => 'Embedovan plejer',
        'label' =>
            'Odaberite boju teme, kopirajte embedovan plejer i nalepite ga na vaš sajt.',
        'clipboard_iframe' => 'Kopirajte kod embedovanog plejera',
        'clipboard_url' => 'Kopirajte adresu',
        'dark' => 'Tamna',
        'dark-transparent' => 'Tamna providna',
        'light' => 'Svetla',
        'light-transparent' => 'Svetla providna',
    ],
];
