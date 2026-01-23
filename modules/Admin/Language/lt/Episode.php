<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => '{seasonNumber} sezonas',
    'season_abbr' => 'S{seasonNumber}',
    'number' => '{episodeNumber} epizodas',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => '{seasonNumber} sezono {episodeNumber} epizodas',
    'season_episode_abbr' => 'S{seasonNumber}E{episodeNumber}',
    'number_of_comments' => '{numberOfComments, plural,
        one {# komentaras}
        few {# komentarai}
        other {# komentarų}
    }',
    'all_podcast_episodes' => 'Visi tinklalaidės epizodai',
    'back_to_podcast' => 'Grįžti į tinklalaidę',
    'edit' => 'Taisyti',
    'preview' => 'Peržiūrėti',
    'publish' => 'Paskelbti',
    'publish_edit' => 'Taisyti paskelbimą',
    'publish_date_edit' => 'Taisyti paskelbimo datą',
    'unpublish' => 'Nebeskelbti',
    'publish_error' => 'Šis epizodas jau paskelbtas.',
    'publish_edit_error' => 'Šis epizodas jau paskelbtas.',
    'publish_cancel_error' => 'Šis epizodas jau paskelbtas.',
    'publish_date_edit_error' => 'Šis epizodas dar nepaskelbtas, jo paskelbimo datos taisyti negalima.',
    'publish_date_edit_future_error' => 'Nurodyta epizodo paskelbimo data gali būti tik praeityje. Jei norite jį paskelbti vėliau, pirma nurodykite jo nebeskelbti.',
    'publish_date_edit_success' => 'Epizodo paskelbimo data sėkmingai pakeista!',
    'unpublish_error' => 'Šis epizodas dar nepaskelbtas.',
    'delete' => 'Šalinti',
    'go_to_page' => 'Eiti į puslapį',
    'create' => 'Pridėti epizodą',
    'publication_status' => [
        'published' => 'Paskelbtas',
        'with_podcast' => 'Paskelbtas',
        'scheduled' => 'Suplanuotas',
        'not_published' => 'Nepaskelbtas',
    ],
    'with_podcast_hint' => 'Bus paskelbtas kartu su tinklalaide',
    'list' => [
        'search' => [
            'placeholder' => 'Ieškoti epizodo',
            'clear' => 'Išvalyti paiešką',
            'submit' => 'Ieškoti',
        ],
        'number_of_episodes' => '{numberOfEpisodes, plural,
            one {# epizodas}
            few {# epizodai}
            other {# epizodų}
        }',
        'episode' => 'Epizodas',
        'visibility' => 'Matomumas',
        'downloads' => 'Parsisiuntimai',
        'comments' => 'Komentarai',
        'actions' => 'Veiksmai',
    ],
    'messages' => [
        'createSuccess' => 'Epizodas sėkmingai sukurtas!',
        'editSuccess' => 'Epizodas sėkmingai atnaujintas!',
        'publishSuccess' => '{publication_status, select,
            published {Epizodas sėkmingai paskelbtas!}
            scheduled {Epizodo paskelbimo data numatyta sėkmingai.}
            with_podcast {Epizodą planuojama paskelbti kartu su tinklalaide.}
            other {Šis epizodas nepaskelbtas.}
        }',
        'publishCancelSuccess' => 'Epizodo paskelbimas sėkmingai atšauktas!',
        'unpublishBeforeDeleteTip' => 'Prieš šalindami epizodą, turite atšaukti jo paskelbimą.',
        'scheduleDateError' => 'Turite nurodyti paskelbimo datą!',
        'deletePublishedEpisodeError' => 'Prieš pašalindami šį epizodą, atšaukite jo paskelbimą.',
        'deleteSuccess' => 'Epizodas sėkmingai pašalintas!',
        'deleteError' => 'Nepavyko pašalinti epizodo {type, select,
            transcript {nuorašo}
            chapters {skyrelių}
            image {viršelio}
            audio {garso įrašo}
            other {daugialypės terpės}
        }.',
        'deleteFileError' => 'Nepavyko pašalinti {type, select,
            transcript {nuorašo}
            chapters {skyrelių}
            image {viršelio}
            audio {garso įrašo}
            other {daugialypės terpės}
        } failo {file_key}. Jį galite pašalinti iš disko rankiniu būdu.',
        'sameSlugError' => 'Epizodas su tokiu nuorodiniu pavadinimu jau yra.',
    ],
    'form' => [
        'file_size_error' =>
            'Jūsų įkeltas failas per didelis! Leistinas dydis yra iki {0}. Jei norite šį failą įkelti, savo PHP konfigūracijoje padidinkite `memory_limit`, `upload_max_filesize` ir `post_max_size` reikšmes, tada perleiskite saityno serverio tarnybą.',
        'audio_file' => 'Garso įrašas',
        'audio_file_hint' => 'Pasirinkite .mp3 arba .m4a garso įrašą.',
        'info_section_title' => 'Epizodo duomenys',
        'cover' => 'Epizodo viršelis',
        'cover_hint' =>
            'Jei viršelio nenurodysite, bus naudojamas tinklalaidės viršelis.',
        'cover_size_hint' => 'Viršelis turi būti kvadratinis, bent 1400 taškų aukščio ir pločio.',
        'title' => 'Pavadinimas',
        'title_hint' =>
            'Įveskite glaustą ir aiškų epizodo pavadinimą. Čia nerašykite epizodo ar sezono numerio.',
        'permalink' => 'Pastovi nuoroda',
        'season_number' => 'Sezonas',
        'episode_number' => 'Epizodas',
        'type' => [
            'label' => 'Tipas',
            'full' => 'Visas',
            'full_hint' => 'Visas turinys (epizodas)',
            'trailer' => 'Anonsas',
            'trailer_hint' => 'Trumpas reklaminis įrašas, pristatantis šią laidą',
            'bonus' => 'Papildomas',
            'bonus_hint' => 'Papildomas laidos turinys (pavyzdžiui, įrašas „už kadro“ ar interviu su komanda) arba kitos laidos reklama',
        ],
        'premium_title' => 'Premium',
        'premium' => 'Epizodas turi būti pasiekiamas tik premium prenumeratoriams',
        'parental_advisory' => [
            'label' => 'Pastaba tėvams',
            'hint' => 'Ar epizode yra atviro turinio (necenzūrinės leksikos, nevaikiškų temų ar pan.)?',
            'undefined' => 'neapibrėžta',
            'clean' => 'Saugus',
            'explicit' => 'Atviras',
        ],
        'show_notes_section_title' => 'Laidos pastabos',
        'show_notes_section_subtitle' =>
            'Iki 4000 ženklų, rašykite aiškiai ir glaustai. Laidos pastabos gali padėti potencialiems klausytojams atrasti šį epizodą.',
        'description' => 'Aprašymas',
        'description_footer' => 'Aprašymo prierašas',
        'description_footer_hint' =>
            'Šis tekstas bus pridedamas prie kiekvieno epizodo aprašymo. Tai – nebloga vieta, pavyzdžiui, sudėti nuorodoms į jūsų soc. tinklų profilius.',
        'additional_files_section_title' => 'Papildomi failai',
        'additional_files_section_subtitle' =>
            'Šie failai gali būti naudojami kitų platformų geresnei jūsų klausytojų patirčiai suteikti. Išsamiau apie juos – čia: {podcastNamespaceLink}.',
        'location_section_title' => 'Vietovė',
        'location_section_subtitle' => 'Apie kokią vietovę yra šis epizodas?',
        'location_name' => 'Vietovės vardas ar adresas',
        'location_name_hint' => 'Vietovė gali būti tikra ar išgalvota',
        'transcript' => 'Nuorašas (subtitrai)',
        'transcript_hint' => 'Leidžiami tik .srt ir .vtt failai.',
        'transcript_download' => 'Parsisiųsti nuorašą',
        'transcript_file' => 'Nuorašo failas (.srt ar .vtt)',
        'transcript_remote_url' => 'Nuorašo URL adresas',
        'transcript_file_delete' => 'Šalinti nuorašo failą',
        'chapters' => 'Skyreliai',
        'chapters_hint' => 'Failas turi būti „JSON Chapters“ formatu.',
        'chapters_download' => 'Parsisiųsti skyrelius',
        'chapters_file' => 'Skyrelių failas',
        'chapters_remote_url' => 'Skyrelių failo URL adresas',
        'chapters_file_delete' => 'Šalinti skyrelių failą',
        'advanced_section_title' => 'Papildomi parametrai',
        'advanced_section_subtitle' =>
            'Jeigu norite naudoti RSS gaires, kurių „Castopod“ neapdoroja, galite jas nustatyti čia.',
        'custom_rss' => 'Papildomos epizodo RSS gairės',
        'custom_rss_hint' => 'Tai bus įterpta į <item> gairę.',
        'block' => 'Epizodas neturėtų būti matomas viešuosiuose kataloguose',
        'block_hint' =>
            'Ribotas epizodo matomumas: įjungus šią parinktį, epizodas nebus matomas „Apple Podcasts“, „Google Podcasts“ ir kitose trečiųjų šalių programose, naudojančiose šių tarnybų katalogus (negarantuojama).',
        'submit_create' => 'Sukurti epizodą',
        'submit_edit' => 'Įrašyti epizodą',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Grįžti į epizodų skydelį',
        'post' => 'Jūsų įrašas-anonsas',
        'post_hint' =>
            "Parašykite pranešimą, kuriuo anonsuosite šio epizodo išleidimą. Šis pranešimas bus ištransliuotas visiems jūsų sekėjams Fedivisatoje bei matomas jūsų tinklalaidės pradžios tinklalapyje.",
        'message_placeholder' => 'Parašykite savo pranešimą…',
        'publication_date' => 'Paskelbimo data',
        'publication_method' => [
            'now' => 'Dabar',
            'schedule' => 'Suplanuoti',
            'with_podcast' => 'Paskelbti kartu su tinklalaide',
        ],
        'scheduled_publication_date' => 'Suplanuota paskelbimo data',
        'scheduled_publication_date_clear' => 'Pašalinti paskelbimo datą',
        'scheduled_publication_date_hint' =>
            'Galite suplanuoti epizodo paskelbimą pagal tvarkaraštį, nurodydami paskelbimo datą ateityje. Reikšmę turite įrašyti tokiu formatu: metai-mėnuo-diena valandos:minutės',
        'submit' => 'Paskelbti',
        'submit_edit' => 'Taisyti paskelbimą',
        'cancel_publication' => 'Atšaukti paskelbimą',
        'message_warning' => 'Neparašėte teksto savo įrašui-anonsui!',
        'message_warning_hint' => 'Parašę trumpą pranešimą, padidinsite epizodo matomumą ir klausytojų įsitraukimą.',
        'message_warning_submit' => 'Vis tiek paskelbti',
    ],
    'publish_date_edit_form' => [
        'new_publication_date' => 'Nauja paskelbimo data',
        'new_publication_date_hint' => 'Data turi būti praeityje.',
        'submit' => 'Taisyti paskelbimo datą',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Nutraukdami epizodo skelbimą, pašalinsite visus su juo susijusius komentarus ir įrašus bei pašalinsite jį iš tinklalaidės RSS sklaidos kanalo.",
        'understand' => 'Suprantu, bet vis tiek noriu nutraukti epizodo skelbimą',
        'submit' => 'Nebeskelbti',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Pašalinus epizodą, bus pašalinti ir visi su juo susieti daugialypės terpės failai, komentarai, vaizdo įrašai bei įrašo ištraukos.",
        'understand' => 'Suprantu, bet vis tiek noriu pašalinti epizodą',
        'submit' => 'Šalinti',
    ],
    'embed' => [
        'title' => 'Įtaisomasis grotuvas',
        'label' =>
            'Pasirinkite akcento slapvą, nukopijuokite įtaisomąjį grotuvą į iškarpinę, tada įdėkite jį į savo svetainę.',
        'clipboard_iframe' => 'Kopijuoti įtaisomąjį grotuvą į iškarpinę',
        'clipboard_url' => 'Kopijuoti adresą į iškarpinę',
        'dark' => 'Tamsus',
        'dark-transparent' => 'Tamsus skaidrus',
        'light' => 'Šviesus',
        'light-transparent' => 'Šviesus skaidrus',
    ],
    'publication_status_banner' => [
        'draft_mode' => 'juodraščio veiksena',
        'text' => '{publication_status, select,
            published {Šis epizodas dar nepaskelbtas.}
            scheduled {Šį epizodą numatoma paskelbti {publication_date}.}
            with_podcast {Šį epizodą numatoma paskelbti kartu su tinklalaide.}
            other {Šis epizodas dar nepaskelbtas.}
        }',
        'preview' => 'Peržiūra',
    ],
];
