<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Série {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Epizoda {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Série {seasonNumber} epizoda {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}E{episodeNumber}',
    'number_of_comments' => '{numberOfComments, plural,
        one {# komentář}
        other {# komentáře}
    }',
    'all_podcast_episodes' => 'Všechny epizody podcastu',
    'back_to_podcast' => 'Přejít zpět na podcast',
    'edit' => 'Upravit',
    'preview' => 'Náhled',
    'publish' => 'Publikovat',
    'publish_edit' => 'Upravit publikování',
    'publish_date_edit' => 'Upravit datum publikování',
    'unpublish' => 'Zrušit publikování',
    'publish_error' => 'Epizoda již byla publikována.',
    'publish_edit_error' => 'Epizoda již byla publikována.',
    'publish_cancel_error' => 'Epizoda již byla publikována.',
    'publish_date_edit_error' => 'Epizoda ještě nebyla publikována, nemůžete upravit datum jejího zveřejnění.',
    'publish_date_edit_future_error' => 'Datum publikování epizody může být nastaveno pouze na dřívější datum! Pokud chcete změnit naplánování, nejprve zrušte publikování.',
    'publish_date_edit_success' => 'Datum publikování epizody bylo úspěšně aktualizováno!',
    'unpublish_error' => 'Epizoda není publikována.',
    'delete' => 'Smazat',
    'go_to_page' => 'Přejít na stránku',
    'create' => 'Přidat epizodu',
    'publication_status' => [
        'published' => 'Publikováno',
        'with_podcast' => 'Publikováno',
        'scheduled' => 'Naplánováno',
        'not_published' => 'Nepublikováno',
    ],
    'with_podcast_hint' => 'Zveřejní se současně s podcastem',
    'list' => [
        'search' => [
            'placeholder' => 'Hledat epizodu',
            'clear' => 'Vymazat vyhledávání',
            'submit' => 'Hledat',
        ],
        'number_of_episodes' => '{numberOfEpisodes, plural,
            one {# epizoda}
            other {# epizody}
        }',
        'episode' => 'Epizoda',
        'visibility' => 'Viditelnost',
        'downloads' => 'Stažení',
        'comments' => 'Komentáře',
        'actions' => 'Akce',
    ],
    'messages' => [
        'createSuccess' => 'Epizoda byla úspěšně vytvořena!',
        'editSuccess' => 'Epizoda byla úspěšně aktualizována!',
        'publishSuccess' => '{publication_status, select,
            published {Epizoda byla úspěšně publikována!}
            scheduled {Publikace epizody byla úspěšně naplánována!}
            with_podcast {Tato epizoda bude zveřejněna současně s podcastem.}
            other {Tato epizoda není publikována.}
        }',
        'publishCancelSuccess' => 'Publikování epizody úspěšně zrušeno!',
        'unpublishBeforeDeleteTip' => 'Je nutné zrušit publikování epizody před jejím odstraněním.',
        'scheduleDateError' => 'Musí být nastaveno datum publikování!',
        'deletePublishedEpisodeError' => 'Před odstraněním epizody prosím zrušte publikování.',
        'deleteSuccess' => 'Epizoda byla úspěšně smazána!',
        'deleteError' => 'U epizody se nepodařilo odstranit {type, select,
            transcript {přepis}
            chapters {kapitoly}
            image {obal}
            audio {audio}
            other {media}
        }',
        'deleteFileError' => 'Nepodařilo se odstranit {type, select,
            transcript {přepis}
            chapters {kapitoly}
            image {obal}
            audio {audio}
            other {média}
        } soubor {file_key}. Můžete ručně odebrat ze svého disku.',
        'sameSlugError' => 'Epizoda se zvolenou částí URL již existuje.',
    ],
    'form' => [
        'file_size_error' =>
            'Soubor je příliš velký! Maximální velikost je {0}. Zvyšte hodnoty `memory_limit`, `upload_max_filesize` a `post_max_size` v konfiguračním souboru php a pak restartujte váš webový server pro nahrání souboru.',
        'audio_file' => 'Zvukový soubor',
        'audio_file_hint' => 'Vyberte zvukový soubor .mp3 nebo .m4a.',
        'info_section_title' => 'Informace o epizodě',
        'cover' => 'Obal epizody',
        'cover_hint' =>
            'Pokud nenastavíte obal, bude místo toho použit obal podcastu.',
        'cover_size_hint' => 'Obal musí být čtvercový a nejméně 1400px široký a vysoký.',
        'title' => 'Název',
        'title_hint' =>
            'Mělo by obsahovat jasný a stručný název epizody. Zde nespecifikujte čísla epizod nebo sezóny.',
        'permalink' => 'Trvalý odkaz',
        'season_number' => 'Série',
        'episode_number' => 'Epizoda',
        'type' => [
            'label' => 'Typ',
            'full' => 'Plné',
            'full_hint' => 'Kompletní obsah (epizoda)',
            'trailer' => 'Upoutávka',
            'trailer_hint' => 'Krátký propagační materiál, který představuje náhled aktuálního seriálu',
            'bonus' => 'Bonus',
            'bonus_hint' => 'Extra obsah pro seriál (například ze zákulisí nebo rozhovory s účinkujícími) nebo průřezový propagační obsah pro jiný seriál',
        ],
        'premium_title' => 'Prémium',
        'premium' => 'Epizoda musí být přístupná pouze pro prémiové odběratele',
        'parental_advisory' => [
            'label' => 'Rodičovské informace',
            'hint' => 'Obsahuje epizoda explicitní obsah?',
            'undefined' => 'nedefinováno',
            'clean' => 'Čisté',
            'explicit' => 'Explicitní',
        ],
        'show_notes_section_title' => 'Zobrazit poznámky',
        'show_notes_section_subtitle' =>
            'Až 4000 znaků, buďte jasní a struční. Poznámky pomáhají potenciálním posluchačům při hledání epizody.',
        'description' => 'Popis',
        'description_footer' => 'Zápatí popisu',
        'description_footer_hint' =>
            'Tento text je přidán na konec popisu každé epizody, je to dobré místo pro vložení vašich sociálních odkazů.',
        'additional_files_section_title' => 'Další soubory',
        'additional_files_section_subtitle' =>
            'Tyto soubory mohou být použity jinými platformami pro lepší zážitek pro vaše publikum. Pro více informací si přečtěte {podcastNamespaceLink}.',
        'location_section_title' => 'Místo',
        'location_section_subtitle' => 'O kterém místě je tato epizoda?',
        'location_name' => 'Název nebo adresa místa',
        'location_name_hint' => 'Toto může být skutečné nebo fiktivní místo',
        'transcript' => 'Přepis (titulky)',
        'transcript_hint' => 'Jsou povoleny pouze .srt nebo .vtt.',
        'transcript_download' => 'Stáhnout přepis',
        'transcript_file' => 'Soubor přepisu (.srt nebo .vtt)',
        'transcript_remote_url' => 'Vzdálená URL pro přepis',
        'transcript_file_delete' => 'Odstranit soubor přepisu',
        'chapters' => 'Kapitoly',
        'chapters_hint' => 'Soubor musí být ve formátu JSON kapitol.',
        'chapters_download' => 'Stáhnout kapitoly',
        'chapters_file' => 'Soubor kapitol',
        'chapters_remote_url' => 'Vzdálená url pro soubor kapitol',
        'chapters_file_delete' => 'Odstranit soubor kapitol',
        'advanced_section_title' => 'Pokročilá nastavení',
        'advanced_section_subtitle' =>
            'Pokud potřebujete RSS tagy, které Castopod nepodporuje, nastavte je zde.',
        'custom_rss' => 'Vlastní RSS tagy pro epizodu',
        'custom_rss_hint' => 'Toto bude vloženo do tagu ❬item❭.',
        'block' => 'Epizoda by měla být skryta ve veřejných katalogech',
        'block_hint' =>
            'Zobrazit nebo skrýt stav: přepnutí tohoto zabraňuje tomu, aby se epizoda objevila v Apple Podcasts, Google Podcasts, a všech aplikacích třetích stran, které stahují seriály z těchto adresářů. (Nezaručeno)',
        'submit_create' => 'Vytvořit epizodu',
        'submit_edit' => 'Uložit epizodu',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Zpět na nástěnku epizody',
        'post' => 'Váš oznamovací příspěvek',
        'post_hint' =>
            "Napište zprávu pro oznámení zveřejnění vaší epizody. Zpráva bude odeslána všem vašim následovníkům ve fediverse a bude zobrazena na domovské stránce vašeho podcastu.",
        'message_placeholder' => 'Napište zprávu…',
        'publication_date' => 'Datum publikování',
        'publication_method' => [
            'now' => 'Teď',
            'schedule' => 'Naplánovat',
            'with_podcast' => 'Publikovat s podcastem',
        ],
        'scheduled_publication_date' => 'Naplánované datum publikování',
        'scheduled_publication_date_clear' => 'Vymazat datum publikování',
        'scheduled_publication_date_hint' =>
            'Vydání epizody můžete naplánovat nastavením data zveřejnění. Toto pole musí být formátováno jako YY-MM-DD HH:mm',
        'submit' => 'Publikovat',
        'submit_edit' => 'Upravit publikování',
        'cancel_publication' => 'Zrušit publikování',
        'message_warning' => 'Nepsali jste zprávu pro váš příspěvek s oznámením!',
        'message_warning_hint' => 'Zpráva zvyšuje viditelnost na sociálních sítích, což má za následek lepší popularitu vaší epizody.',
        'message_warning_submit' => 'Přesto publikovat',
    ],
    'publish_date_edit_form' => [
        'new_publication_date' => 'Nové datum publikace',
        'new_publication_date_hint' => 'Musí být nastaveno na uplynulé datum.',
        'submit' => 'Upravit datum publikace',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Zrušením publikování epizody smažete všechny komentáře a příspěvky spojené s ní a odeberete z RSS kanálu podcastu.",
        'understand' => 'Chápu, chci zrušit publikování epizody',
        'submit' => 'Zrušit publikování',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Smazáním epizody smažete všechny mediální soubory, komentáře, videoklipy a zvuky, které jsou s ní spojeny.",
        'understand' => 'Chápu, chci odstranit epizodu',
        'submit' => 'Smazat',
    ],
    'embed' => [
        'title' => 'Vložitelný přehrávač',
        'label' =>
            'Vyberte si barvu motivu, zkopírujte vložený přehrávač do schránky a vložte jej na váš web.',
        'clipboard_iframe' => 'Kopírovat vložitelný přehrávač do schránky',
        'clipboard_url' => 'Kopírovat adresu do schránky',
        'dark' => 'Tmavý',
        'dark-transparent' => 'Tmavý průhledný',
        'light' => 'Světlý',
        'light-transparent' => 'Světlý průhledný',
    ],
    'publication_status_banner' => [
        'draft_mode' => 'režim konceptu',
        'text' => '{publication_status, select,
            published {Tato epizoda ještě není publikována.}
            scheduled {Tato epizoda je naplánována pro publikování na {publication_date}}
            with_podcast {Tato epizoda bude zveřejněna současně s podcastem.}
            other {Tato epizoda ještě není publikována.}
        }',
        'preview' => 'Náhled',
    ],
];
