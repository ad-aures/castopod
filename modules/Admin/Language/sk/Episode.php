<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Séria {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Epizóda {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Séria {seasonNumber} epizóda {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}E{episodeNumber}',
    'number_of_comments' => '{numberOfComments, plural,
        one {# komentár}
        few {# komentáre}
        many {# komentárov}
        other {# komentárov}
    }',
    'all_podcast_episodes' => 'Všetky epizódy podcastu',
    'back_to_podcast' => 'Späť na podcast',
    'edit' => 'Upraviť',
    'preview' => 'Náhľad',
    'publish' => 'Zverejniť',
    'publish_edit' => 'Upraviť zverejnenie',
    'publish_date_edit' => 'Upraviť dátum zverejnenia',
    'unpublish' => 'Zrušiť zverejnenie',
    'publish_error' => 'Epizóda je už zverejnená.',
    'publish_edit_error' => 'Epizóda je už zverejnená.',
    'publish_cancel_error' => 'Epizóda je už zverejnená.',
    'publish_date_edit_error' => 'Epizóda zatiaľ nie je zverejnená, nie je možné upraviť dátum zverejnenia.',
    'publish_date_edit_future_error' => 'Dátum zverejnenia musí byť v minulosti! Ak si zverejnenie želáte naplánovať v budúcnosti, musíte ho najskôr zrušiť.',
    'publish_date_edit_success' => 'Dátum zverejnenia epizódy bol úspešne aktualizovaný!',
    'unpublish_error' => 'Epizóda nie je zverejnená.',
    'delete' => 'Vymazať',
    'go_to_page' => 'Prejsť na stránku',
    'create' => 'Pridať epizódu',
    'publication_status' => [
        'published' => 'Zverejnená',
        'with_podcast' => 'Zverejnený',
        'scheduled' => 'Naplánovaná',
        'not_published' => 'Nezverejnená',
    ],
    'with_podcast_hint' => 'Bude publikovaná v rovnakom čase ako podcast',
    'list' => [
        'search' => [
            'placeholder' => 'Vyhľadať epizódu',
            'clear' => 'Vyčistiť hľadanie',
            'submit' => 'Hľadať',
        ],
        'number_of_episodes' => '{numberOfEpisodes, plural,
            one {# epizóda}
            few {# epizódy}
            many {# epizód}
            other {# epizód}
        }',
        'episode' => 'Epizóda',
        'visibility' => 'Viditeľnosť',
        'downloads' => 'Stiahnutia',
        'comments' => 'Komentáre',
        'actions' => 'Úkony',
    ],
    'messages' => [
        'createSuccess' => 'Epizóda je úspešne vytvorená!',
        'editSuccess' => 'Epizóda je úspešne aktualizovaná!',
        'publishSuccess' => '{publication_status, select,
            published {Epizóda je úspešne zverejnená!}
            scheduled {Zverejnenie epizódy je úspešne načasované!}
            with_podcast {Táto epizóda bude zverejnená v rovnakom čase ako podcast.}
            other {Táto epizóda nie je zverejnená.}
        }',
        'publishCancelSuccess' => 'Zverejnenie epizódy úspešne zrušené!',
        'unpublishBeforeDeleteTip' => 'Pred vymazaním musíte zrušiť zverejnenie epizódy.',
        'scheduleDateError' => 'Musí byť nastavený plánovaný dátum zverejnenia!',
        'deletePublishedEpisodeError' => 'Prosím zrušte zverejnenie epizódy pred jej vymazaním.',
        'deleteSuccess' => 'Epizóda úspešne vymazaná!',
        'deleteError' => 'Nepodarilo sa vymazať epizódu: {type, select,
            transcript {prepis}
            chapters {kapitoly}
            image {obrázok}
            audio {zvuk}
            other {médiá}
        }.',
        'deleteFileError' => 'Failed to delete {type, select,
            transcript {transcript}
            chapters {chapters}
            image {cover}
            audio {audio}
            other {media}
        } file {file_key}. You may manually remove it from your disk.',
        'sameSlugError' => 'Epizóda s takýmto trvalým odkazom už existuje.',
    ],
    'form' => [
        'file_size_error' =>
            'Súbor je príliš veľký! Maximálna povolená veľkosť je {0}. V konfigurácii Php zvýšte hodnoty nastavení `memory_limit`, `upload_max_filesize` a `post_max_size` a následne reštartujte web server, aby ste súbor mohli nahrať znovu.',
        'audio_file' => 'Zvukový súbor',
        'audio_file_hint' => 'Vyberte zvukový súbor .mp3, alebo .m4a.',
        'info_section_title' => 'Informácie o časti',
        'cover' => 'Obal k časti',
        'cover_hint' =>
            'Ak obrázok nepridáte, použije sa obrázok podcastu.',
        'cover_size_hint' => 'Obrázok musí byť štvorcový minimálny rozmer 1400px.',
        'title' => 'Názov',
        'title_hint' =>
            'Má obsahovať jasný a výstižný názov. Nepridávajte čísla sérií a epizód.',
        'permalink' => 'Trvalý odkaz',
        'season_number' => 'Séria',
        'episode_number' => 'Epizóda',
        'type' => [
            'label' => 'Typ',
            'full' => 'Celá epizóda',
            'full_hint' => '´Uplný obsah',
            'trailer' => 'Upútavka',
            'trailer_hint' => 'Krátky promočný úryvok obsahu, ktorý slúži ako ukážka podcastu',
            'bonus' => 'Bonus',
            'bonus_hint' => 'Doplnkový obsah podcastu (Informácie zo zákulisia alebo rozhovor s účinkujúcimi) alebo upútavka iného podcastu',
        ],
        'premium_title' => 'Prémiový obsah',
        'premium' => 'Epizóda je prístupná len pre predplatiteľov prémiového obsahu',
        'parental_advisory' => [
            'label' => 'Rodičovská kontrola',
            'hint' => 'Obsahuje epizóda explicitný obsah?',
            'undefined' => 'neuvedené',
            'clean' => 'Čisté',
            'explicit' => 'Chúlostivé',
        ],
        'show_notes_section_title' => 'Poznámky epizódy',
        'show_notes_section_subtitle' =>
            'Maximálne 4000 znakov, buďte jasní a výstižní.',
        'description' => 'Popis',
        'description_footer' => 'Päta popisu',
        'description_footer_hint' =>
            'Tento text je pridaný na koniec popisu každej epizódy, je vhodný napríklad na zverejnenie odkazov na sociálne siete.',
        'additional_files_section_title' => 'Dodatočné súbory',
        'additional_files_section_subtitle' =>
            'Tieto súbory sú určené na použitie s inými platformami s cieľom poslucháčom poskytovať bohačšiu skúsenosť. Pre viac informácií si pozrite {podcastNamespaceLink}.',
        'location_section_title' => 'Lokácia',
        'location_section_subtitle' => 'O akom mieste / oblasti pojednáva táto epizóda?',
        'location_name' => 'Názov oblasti alebo adresa',
        'location_name_hint' => 'Môže to byť skutočné alebo vymyslené miesto',
        'transcript' => 'Prepis (titulky / skryté titulky)',
        'transcript_hint' => 'Only .srt or .vtt are allowed.',
        'transcript_download' => 'Stiahnuť prepis',
        'transcript_file' => 'Transcript file (.srt or .vtt)',
        'transcript_remote_url' => 'Vzdialená adresa Url s prepisom',
        'transcript_file_delete' => 'Vymazať súbor s prepisom',
        'chapters' => 'Kapitoly',
        'chapters_hint' => 'Súbor musí byť vo formáte JSON Chapters.',
        'chapters_download' => 'Prevziať kapitoly',
        'chapters_file' => 'Súbor s kapitolami',
        'chapters_remote_url' => 'Vzdialená adresa url súboru s kapitolami',
        'chapters_file_delete' => 'Vymazať súbor s kapitolami',
        'advanced_section_title' => 'Pokročilé vlastnosti',
        'advanced_section_subtitle' =>
            'Ak potrebujete pokročilé tagy RSS, ktoré castopod nepodporuje, nastavte ich tu.',
        'custom_rss' => 'Vlastné tagy RSS pre túto epizódu',
        'custom_rss_hint' => 'Toto bude vložené vo vnútri tagu ❬item❭.',
        'block' => 'Epizóda má byť skrytá z verejných katalógov',
        'block_hint' =>
            'Stav skryť / zobraziť pre túto epizódu: zapnutím zabránite, aby sa epizóda zobrazila v katalógoch Apple Podcasts, Google Podcasts a v ďalších aplikáciách tretích strán ktoré získavajú podcasty z týchto služieb. (Negarantované)',
        'submit_create' => 'Vytvoriť epizódu',
        'submit_edit' => 'Uložiť epizódu',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Späť na nástenku epizódy',
        'post' => 'Príspevok, ktorým oznamujete zverejnenie',
        'post_hint' =>
            "Napíšte správu, v ktorej oznámite zverejnenie tejto epizódy. Správu uvidia všetci sledujúci vo fediverse a správa bude zobrazená na úvodnej stránke podcastu.",
        'message_placeholder' => 'Napíšte správu…',
        'publication_date' => 'Dátum zverejnenia',
        'publication_method' => [
            'now' => 'Hneď teraz',
            'schedule' => 'Naplánovať',
            'with_podcast' => 'Publikovať spolu s podcastom',
        ],
        'scheduled_publication_date' => 'Dátum plánovaného zverejnenia',
        'scheduled_publication_date_clear' => 'Vyčistiť dátum zverejnenia',
        'scheduled_publication_date_hint' =>
            'Uvedenie epizódy môžete naplánovať nastavením dátumu zverejnenia v budúcnosti. Formát tohoto vstupného poľa je YYYY-MM-DD HH:mm',
        'submit' => 'Zverejniť',
        'submit_edit' => 'Upraviť zverejnenie',
        'cancel_publication' => 'Zrušiť zverejnenie',
        'message_warning' => 'Nenapísali ste text oznamujúceho príspevku!',
        'message_warning_hint' => 'Odoslaním uvádzacieho príspevku zlepšujete sociálnu účasť, čím môžete ešte viac zviditeľniť váš podcast.',
        'message_warning_submit' => 'Napriek tomu zverejniť',
    ],
    'publish_date_edit_form' => [
        'new_publication_date' => 'Nový dátum zverejnenia',
        'new_publication_date_hint' => 'Musí byť dátum v minulosti.',
        'submit' => 'Upraviť dátum zverejnenia',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Zrušenie zverejnenia odstráni všetky pridružené príspevky a komentáre a odstráni epizódu z kanála RSS.",
        'understand' => 'Rozumiem, chcem zrušiť zverejnenie epizódy',
        'submit' => 'Zrušiť zverejnenie',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Vymazaním epizódy odstránite všetky prepojené mediálne súbory, komentáre, video klipy a zvukové ukážky.",
        'understand' => 'Rozumiem, chcem vymazať epizódu',
        'submit' => 'Vymazať',
    ],
    'embed' => [
        'title' => 'Vnorený prehrávač',
        'label' =>
            'Vyberte farbu vzhľadu, skopírujte kód prehrávača do schránky a prilepte ho na vašej stránke.',
        'clipboard_iframe' => 'Skopírovať kód prehrávača do schránky',
        'clipboard_url' => 'Skopírovať adresu do schránky',
        'dark' => 'Tmavý',
        'dark-transparent' => 'Tmavý priehľadný',
        'light' => 'Svetlý',
        'light-transparent' => 'Svetlý priehľadný',
    ],
    'publication_status_banner' => [
        'draft_mode' => 'konceptový režim',
        'text' => '{publication_status, select,
            published {Táto epizóda ešte nieje zverejnená.}
            scheduled {Táto epizóda je naplánovaná na zverejnenie {publication_date}.}
            with_podcast {Táto epizóda bude zverejnená zarovno s podcastom.}
            other {Táto epizóda ešte nieje zverejnená.}
        }',
        'preview' => 'Náhľad',
    ],
];
