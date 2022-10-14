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
    'publish' => 'Zverejniť',
    'publish_edit' => 'Upraviť zverejnenie',
    'publish_date_edit' => 'Edit publication date',
    'unpublish' => 'Zrušiť zverejnenie',
    'publish_error' => 'Epizóda je už zverejnená.',
    'publish_edit_error' => 'Epizóda je už zverejnená.',
    'publish_cancel_error' => 'Epizóda je už zverejnená.',
    'publish_date_edit_error' => 'Episode has not been published yet, you cannot edit its publication date.',
    'publish_date_edit_future_error' => 'Episode\'s publication date can only be set to a past date! If you would like to reschedule it, unpublish it first.',
    'publish_date_edit_success' => 'Episode\'s publication date has been updated successfully!',
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
        'deleteFileError' => 'Nepodarilo sa vymazať {type, select,
            transcript {prepis}
            chapters {kapitoly}
            image {obrázok}
            audio {zvuk}
            other {médiá}
        } súbor {file_path}. Môžete ho z disku odstrániť ručne.',
        'sameSlugError' => 'Epizóda s takýmto trvalým odkazom už existuje.',
    ],
    'form' => [
        'file_size_error' =>
            'Your file size is too big! Max size is {0}. Increase the `memory_limit`, `upload_max_filesize` and `post_max_size` values in your php configuration file then restart your web server to upload your file.',
        'audio_file' => 'Zvukový súbor',
        'audio_file_hint' => 'Vyberte zvukový súbor .mp3, alebo .m4a.',
        'info_section_title' => 'Informácie o časti',
        'cover' => 'Obal k časti',
        'cover_hint' =>
            'If you do not set a cover, the podcast cover will be used instead.',
        'cover_size_hint' => 'Cover must be squared and at least 1400px wide and tall.',
        'title' => 'Názov',
        'title_hint' =>
            'Should contain a clear and concise episode name. Do not specify the episode or season numbers here.',
        'permalink' => 'Trvalý odkaz',
        'season_number' => 'Season',
        'episode_number' => 'Epizóda',
        'type' => [
            'label' => 'Type',
            'full' => 'Full',
            'full_hint' => 'Complete content (the episode)',
            'trailer' => 'Trailer',
            'trailer_hint' => 'Short, promotional piece of content that represents a preview of the current show',
            'bonus' => 'Bonus',
            'bonus_hint' => 'Extra content for the show (for example, behind the scenes info or interviews with the cast) or cross-promotional content for another show',
        ],
        'premium_title' => 'Premium',
        'premium' => 'Episode must be accessible to premium subscribers only',
        'parental_advisory' => [
            'label' => 'Parental advisory',
            'hint' => 'Does the episode contain explicit content?',
            'undefined' => 'undefined',
            'clean' => 'Clean',
            'explicit' => 'Chúlostivé',
        ],
        'show_notes_section_title' => 'Show notes',
        'show_notes_section_subtitle' =>
            'Up to 4000 characters, be clear and concise. Show notes help potential listeners in finding the episode.',
        'description' => 'Popis',
        'description_footer' => 'Description footer',
        'description_footer_hint' =>
            'This text is added at the end of each episode description, it is a good place to input your social links for example.',
        'additional_files_section_title' => 'Dodatočné súbory',
        'additional_files_section_subtitle' =>
            'Tieto súbory sú určené na použitie s inými platformami s cieľom poslucháčom poskytovať bohačšiu skúsenosť. Pre viac informácií si pozrite {podcastNamespaceLink}.',
        'location_section_title' => 'Lokácia',
        'location_section_subtitle' => 'O akom mieste / oblasti pojednáva táto epizóda?',
        'location_name' => 'Názov oblasti alebo adresa',
        'location_name_hint' => 'Môže to byť skutočné alebo vymyslené miesto',
        'transcript' => 'Prepis (titulky / skryté titulky)',
        'transcript_hint' => 'Povolené sú len súbory .srt.',
        'transcript_download' => 'Stiahnuť prepis',
        'transcript_file' => 'Súbor s prepisom (.srt)',
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
        'new_publication_date' => 'New publication date',
        'new_publication_date_hint' => 'Must be set to a past date.',
        'submit' => 'Edit publication date',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Unpublishing the episode will delete all the comments and posts associated with it and remove it from the podcast's RSS feed.",
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
        'dark-transparent' => 'Dark transparent',
        'light' => 'Light',
        'light-transparent' => 'Light transparent',
    ],
];
