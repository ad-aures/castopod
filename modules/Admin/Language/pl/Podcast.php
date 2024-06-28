<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'all_podcasts' => 'Wszystkie podcasty',
    'no_podcast' => 'Nie znaleziono podcastu!',
    'create' => 'Stwórz podcast',
    'import' => 'Importuj podcast',
    'all_imports' => 'Importy podcastów',
    'new_episode' => 'Nowy Odcinek',
    'view' => 'Wyświetl podcast',
    'edit' => 'Edytuj podcast',
    'publish' => 'Opublikuj podcast',
    'publish_edit' => 'Edytuj publikację',
    'delete' => 'Usuń podcast',
    'see_episodes' => 'Zobacz odcinki',
    'see_contributors' => 'Zobacz kontrybutorów',
    'monetization_other' => 'Inna monetyzacja',
    'go_to_page' => 'Idź do strony',
    'latest_episodes' => 'Najnowsze odcinki',
    'see_all_episodes' => 'Zobacz wszystkie odcinki',
    'draft' => 'Wersja robocza',
    'messages' => [
        'createSuccess' => 'Podcast został pomyślnie utworzony!',
        'editSuccess' => 'Podcast został pomyślnie zaktualizowany!',
        'importSuccess' => 'Podcast został pomyślnie zaimportowany!',
        'deleteSuccess' => 'Podcast @{podcast_handle} został pomyślnie usunięty!',
        'deletePodcastMediaError' => 'Nie udało się usunąć {type, select,
            cover {okładki}
            banner {baneru}
            other {mediów}
        } podcastu.',
        'deleteEpisodeMediaError' => 'Nie udało się usunąć {episode_slug} {type, select,
            transcript {transkrypcji}
            chapters {rozdziału}
            image {okładki}
            audio {audio}
            other {mediów}
        } odcinka.',
        'deletePodcastMediaFolderError' => 'Nie udało się usunąć folderu z mediami podcastu {folder_path}. Możesz go ręcznie usunąć ze swojego dysku.',
        'podcastFeedUpdateSuccess' => 'Zaktualizowano pomyślnie: {number_of_new_episodes, plural,
            one {# odcinek został dodany}
            few {# odcinki zostały dodane}
            other {# odcinków zostało dodanych}
        } do podcastu!',
        'podcastFeedUpToDate' => 'Podcast jest już aktualny.',
        'publishError' => 'Ten podcast jest już opublikowany lub zaplanowany do publikacji.',
        'publishEditError' => 'Ten podcast nie jest zaplanowany do publikacji.',
        'publishCancelSuccess' => 'Publikacja odcinka pomyślnie anulowana!',
        'scheduleDateError' => 'Zaplanowana data musi być ustawiona!',
    ],
    'form' => [
        'identity_section_title' => 'Tożsamość podcastu',
        'identity_section_subtitle' => 'Te pola pozwalają Ci zostać zauważonym.',
        'fediverse_section_title' => 'Tożsamość w Fediwersum',

        'cover' => 'Okładka podcastu',
        'cover_size_hint' => 'Okładka musi być kwadratowa oraz mieć co najmniej 1400px wysokości i szerokości.',
        'banner' => 'Baner podcastu',
        'banner_size_hint' => 'Banner musi mieć proporcje 3:1 oraz mieć co najmniej 1500px szerokości.',
        'banner_delete' => 'Usuń baner podcastu',
        'title' => 'Tytuł',
        'handle' => 'Uchwyt',
        'handle_hint' =>
            'Służy do identyfikacji podcastu. Akceptowane są wielkie i małe litery, cyfry i podkreślenia.',
        'type' => [
            'label' => 'Typ',
            'episodic' => 'Epizodyczny',
            'episodic_hint' => 'Jeśli odcinki mają być pobierane bez określonej kolejności. Najnowsze odcinki zostaną zaprezentowane jako pierwsze.',
            'serial' => 'Seryjny',
            'serial_hint' => 'Jeśli odcinki są przeznaczone do wykorzystania w kolejności sekwencyjnej. Odcinki będą wyświetlane w kolejności numerycznej.',
        ],
        'medium' => [
            'label' => 'Medium',
            'hint' => 'Medium reprezentowane przez tag podcast:medium w RSS. Zmiana tego może mieć wpływ na wygląd w odtwarzaczach podcastów.',
            'podcast' => 'Podcast',
            'podcast_hint' => 'Opisuje kanał dla podcastu.',
            'music' => 'Muzyka',
            'music_hint' => 'Kanał muzyki zorganizowany w "album" z każdym elementem jako utwór w albumie.',
            'audiobook' => 'Audiobook',
            'audiobook_hint' => 'Specyficzne typy audio z jednym elementem na kanał lub gdzie każdy element reprezentuje rozdział książki.',
        ],
        'description' => 'Opis',
        'classification_section_title' => 'Klasyfikacja',
        'classification_section_subtitle' =>
            'Te pola wpłyną na twoją publiczność i konkurencję.',
        'language' => 'Język',
        'category' => 'Kategoria',
        'category_placeholder' => 'Wybierz kategorię…',
        'other_categories' => 'Inne kategorie',
        'parental_advisory' => [
            'label' => 'Kontrola rodzicielska',
            'hint' => 'Czy zawiera treści dla dorosłych?',
            'undefined' => 'niezdefiniowana',
            'clean' => 'Czysta',
            'explicit' => 'Dla dorosłych',
        ],
        'author_section_title' => 'Autor',
        'author_section_subtitle' => 'Kto zarządza podcastem?',
        'owner_name' => 'Nazwa właściciela',
        'owner_name_hint' =>
            'Wyłącznie do użytku administracyjnego. Widoczne w publicznym kanale RSS.',
        'owner_email' => 'Email właściciela',
        'owner_email_hint' =>
            'Będzie używany przez większość platform do weryfikacji własności podcastu. Widoczne w publicznym kanale RSS.',
        'is_owner_email_removed_from_feed' => 'Usuń email właściciela z publicznego kanału RSS',
        'is_owner_email_removed_from_feed_hint' => 'Może być konieczne tymczasowe odkrycie adresu e-mail, aby katalog mógł zweryfikować właściciela podcastu.',
        'publisher' => 'Wydawca',
        'publisher_hint' =>
            'Grupa odpowiedzialna za stworzenie programu. Często odnosi się do firmy macierzystej lub sieci podcastów. To pole jest czasami oznaczone jako "Autor".',
        'copyright' => 'Prawa autorskie',
        'location_section_title' => 'Lokalizacja',
        'location_section_subtitle' => 'O jakim miejscu jest ten podcast?',
        'location_name' => 'Nazwa lub adres lokalizacji',
        'location_name_hint' => 'Może to być prawdziwe lub fikcyjne miejsce',
        'monetization_section_title' => 'Monetyzacja',
        'monetization_section_subtitle' =>
            'Zarabiaj dzięki swoim odbiorcom.',
        'premium' => 'Premium',
        'premium_by_default' => 'Odcinki muszą być domyślnie ustawione jako premium',
        'premium_by_default_hint' => 'Odcinki podcastów będą domyślnie oznaczone jako premium. Nadal możesz ustawić niektóre odcinki, zwiastuny lub bonusy jako publiczne.',
        'op3' => 'Open Podcast Prefix Project (OP3)',
        'op3_link' => 'Odwiedź panel OP3 (link zewnętrzny)',
        'op3_hint' => 'Oceń swoje dane analityczne z OP3, otwartej i zaufanej usługi strony trzeciej. Udostępnij, weryfikuj i porównuj swoje dane analityczne za pomocą ekosystemu otwartego podcastingu.',
        'op3_enable' => 'Włącz usługę analityczną OP3',
        'op3_enable_hint' => 'Ze względów bezpieczeństwa dane analityczne odcinków premium nie będą udostępniane OP3.',
        'payment_pointer' => 'Wskaźnik płatności do zarabiania w sieci',
        'payment_pointer_hint' =>
            'To tutaj otrzymasz pieniądze dzięki Monetyzacji Internetowej',
        'advanced_section_title' => 'Parametry Zaawansowane',
        'advanced_section_subtitle' =>
            'Jeśli potrzebujesz tagów RSS, których Castopod nie obsługuje, ustaw je tutaj.',
        'custom_rss' => 'Własne tagi RSS dla podcastu',
        'custom_rss_hint' => 'Zostanie wstawione w tagu ❬channel❭.',
        'verify_txt' => 'Weryfikacja własności TXT',
        'verify_txt_hint' => 'Zamiast polegać na e-mailu, niektóre usługi firm trzecich mogą potwierdzić twoje prawa własności podcastu, prosząc Cię o osadzenie tekstu weryfikacyjnego w twoim kanale.',
        'verify_txt_helper' => 'Ten tekst jest wstrzykiwany do znacznika <podcast:txt purpose="verify">.',
        'new_feed_url' => 'Nowy adres URL kanału',
        'new_feed_url_hint' => 'Użyj tego pola, gdy przenosisz się do innej domeny lub platformy hostingowej podcastu. Domyślnie wartość jest ustawiona na bieżący adres URL RSS, jeśli podcast jest importowany.',
        'old_feed_url' => 'Stary URL kanału',
        'partnership' => 'Partnerstwo',
        'partner_id' => 'ID',
        'partner_link_url' => 'Adres URL linku',
        'partner_image_url' => 'Adres URL obrazu',
        'partner_id_hint' => 'Twój własny ID partnera',
        'partner_link_url_hint' => 'Ogólny adres linku partnera',
        'partner_image_url_hint' => 'Ogólny adres obrazu partnera',
        'block' => 'Odcinek powinien być ukryty w publicznych katalogach',
        'block_hint' =>
            'Pokazywanie lub ukrywanie odcinka: przełączanie tej funkcji zapobiega pojawieniu się odcinka w Apple Podcasts, Google Podcasts, a także w aplikacjach innych firm, które pobierają z tych katalogów. (Niegwarantowane)',
        'complete' => 'Podcast nie będzie miał nowych odcinków',
        'lock' => 'Zapobiegaj kopiowaniu podcastu',
        'lock_hint' =>
            'Celem jest poinformowanie innych platform podcastów, czy są uprawnione do importowania tego kanału. Wartość tak oznacza, że każda próba zaimportowania tego kanału na nową platformę powinna zostać odrzucona.',
        'submit_create' => 'Stwórz podcast',
        'submit_edit' => 'Zapisz podcast',
    ],
    'category_options' => [
        'uncategorized' => 'bez kategorii',
        'arts' => 'Sztuka',
        'business' => 'Biznes',
        'comedy' => 'Komedia',
        'education' => 'Edukacja',
        'fiction' => 'Fikcja',
        'government' => 'Rząd',
        'health_and_fitness' => 'Zdrowie i Fitness',
        'history' => 'Historia',
        'kids_and_family' => 'Dzieci i Rodzina',
        'leisure' => 'Wypoczynek',
        'music' => 'Muzyka',
        'news' => 'Wiadomości',
        'religion_and_spirituality' => 'Religia i Duchowość',
        'science' => 'Nauka',
        'society_and_culture' => 'Społeczność i Kultura',
        'sports' => 'Sport',
        'technology' => 'Technologia',
        'true_crime' => 'Prawdziwe Zbrodnie',
        'tv_and_film' => 'Telewizja i Film',
        'books' => 'Książki',
        'design' => 'Projektowanie',
        'fashion_and_beauty' => 'Moda i Uroda',
        'food' => 'Żywność',
        'performing_arts' => 'Sztuki Sceniczne',
        'visual_arts' => 'Dzieła Wizualne',
        'careers' => 'Kariera',
        'entrepreneurship' => 'Przedsiębiorczość',
        'investing' => 'Inwestowanie',
        'management' => 'Zarządzanie',
        'marketing' => 'Marketing',
        'non_profit' => 'Non-Profit',
        'comedy_interviews' => 'Wywiady Komediowe',
        'improv' => 'Improwizacja',
        'stand_up' => 'Stand-Up',
        'courses' => 'Kursy',
        'how_to' => 'Poradnik',
        'language_learning' => 'Nauka Języków',
        'self_improvement' => 'Samorozwój',
        'comedy_fiction' => 'Fikcja komediowa',
        'drama' => 'Dramat',
        'science_fiction' => 'Fantastyka Naukowa',
        'alternative_health' => 'Zdrowie Alternatywne',
        'fitness' => 'Fitness',
        'medicine' => 'Medycyna',
        'mental_health' => 'Zdrowie Psychiczne',
        'nutrition' => 'Odżywianie',
        'sexuality' => 'Seksualność',
        'education_for_kids' => 'Edukacja dla Dzieci',
        'parenting' => 'Rodzicielstwo',
        'pets_and_animals' => 'Zwierzęta i Zwierzęta Domowe',
        'stories_for_kids' => 'Historie dla Dzieci',
        'animation_and_manga' => 'Animacja i manga',
        'automotive' => 'Motoryzacja',
        'aviation' => 'Lotnictwo',
        'crafts' => 'Rzemieślnictwo',
        'games' => 'Gry',
        'hobbies' => 'Hobby',
        'home_and_garden' => 'Dom i Ogród',
        'video_games' => 'Gry Wideo',
        'music_commentary' => 'Komentarz Muzyczny',
        'music_history' => 'Historia Muzyki',
        'music_interviews' => 'Wywiady Muzyczne',
        'business_news' => 'Wiadomości Biznesowe',
        'daily_news' => 'Codzienne Wiadomości',
        'entertainment_news' => 'Wiadomości Rozrywkowe',
        'news_commentary' => 'Komentarz Wiadomości',
        'politics' => 'Polityka',
        'sports_news' => 'Wiadomości Sportowe',
        'tech_news' => 'Wiadomości Techniczne',
        'buddhism' => 'Buddyzm',
        'christianity' => 'Chrześcijaństwo',
        'hinduism' => 'Hinduizm',
        'islam' => 'Islam',
        'judaism' => 'Judaizm',
        'religion' => 'Religia',
        'spirituality' => 'Duchowość',
        'astronomy' => 'Astronomia',
        'chemistry' => 'Chemia',
        'earth_sciences' => 'Nauka o Ziemi',
        'life_sciences' => 'Nauki o Życiu',
        'mathematics' => 'Matematyka',
        'natural_sciences' => 'Nauki Przyrodnicze',
        'nature' => 'Natura',
        'physics' => 'Fizyka',
        'social_sciences' => 'Nauki Społeczne',
        'documentary' => 'Dokument',
        'personal_journals' => 'Dzienniki Osobiste',
        'philosophy' => 'Filozofia',
        'places_and_travel' => 'Miejsca i podróże',
        'relationships' => 'Związki',
        'baseball' => 'Baseball',
        'basketball' => 'Koszykówka',
        'cricket' => 'Krykiet',
        'fantasy_sports' => 'Sporty fantasy',
        'football' => 'Futbol',
        'golf' => 'Golf',
        'hockey' => 'Hokej',
        'rugby' => 'Rugby',
        'running' => 'Bieg',
        'soccer' => 'Piłka nożna',
        'swimming' => 'Pływanie',
        'tennis' => 'Tenis',
        'volleyball' => 'Siatkówka',
        'wilderness' => 'Dzika przyroda',
        'wrestling' => 'Zapasy',
        'after_shows' => 'Po audycji',
        'film_history' => 'Historia Filmu',
        'film_interviews' => 'Wywiady filmowe',
        'film_reviews' => 'Recenzje filmów',
        'tv_reviews' => 'Recenzje telewizyjne',
    ],
    'publish_form' => [
        'back_to_podcast_dashboard' => 'Powrót do panelu podcastów',
        'post' => 'Twój wpis ogłoszeniowy',
        'post_hint' =>
            "Napisz wiadomość, aby ogłosić publikację podcastu. Wiadomość będzie wyświetlana na stronie głównej podcastu.",
        'message_placeholder' => 'Napisz swoją wiadomość…',
        'submit' => 'Opublikuj',
        'publication_date' => 'Data publikacji',
        'publication_method' => [
            'now' => 'Teraz',
            'schedule' => 'Zaplanuj',
        ],
        'scheduled_publication_date' => 'Planowana data publikacji',
        'scheduled_publication_date_hint' =>
            'Możesz zaplanować wydanie odcinka, ustawiając przyszłą datę publikacji. To pole musi być sformatowane jako YYYY-MM-DD HH:mm',
        'submit_edit' => 'Edytuj publikację',
        'cancel_publication' => 'Anuluj publikację',
        'message_warning' => 'Nie napisałeś wiadomości do swojego wpisu ogłoszeniowego!',
        'message_warning_hint' => 'Posiadanie wiadomości zwiększa zaangażowanie społeczne, co skutkuje lepszą widocznością Twojego podcastu.',
        'message_warning_submit' => 'Opublikuj mimo to',
    ],
    'publication_status_banner' => [
        'draft_mode' => 'tryb szkicu',
        'not_published' => 'Ten podcast nie został jeszcze opublikowany.',
        'scheduled' => 'Ten podcast jest zaplanowany do publikacji na {publication_date}.',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Usunięcie podcastu spowoduje usunięcie wszystkich odcinków, plików multimedialnych, postów i analityk z nim związanych. Ta akcja jest nieodwracalna, nie będziesz w stanie odzyskać tego wszystkiego później.",
        'understand' => 'Rozumiem, chciałbym, aby podcast został trwale usunięty',
        'submit' => 'Usuń',
    ],
    'by' => 'Przez {publisher}',
    'season' => 'Sezon {seasonNumber}',
    'list_of_episodes_year' => '{year} odcinki ({episodeCount})',
    'list_of_episodes_season' =>
        'Sezon {seasonNumber} odcinki ({episodeCount})',
    'no_episode' => 'Nie znaleziono odcinków!',
    'follow' => 'Obserwuj',
    'followers' => '{numberOfFollowers, plural,
        one {# polubienie}
        few {# polubienia}
        other {# polubień}
    }',
    'posts' => '{numberOfPosts, plural,
        one {# osoba}
        few {# osoby}
        other {# osób}
    }',
    'activity' => 'Aktywność',
    'episodes' => 'Odcinki',
    'sponsor' => 'Sponsoruj',
    'funding_links' => 'Linki finansowania dla {podcastTitle}',
    'find_on' => 'Znajdź {podcastTitle} na',
    'listen_on' => 'Słuchaj na',
];
