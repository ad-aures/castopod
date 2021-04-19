<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'all_podcasts' => 'Wszystkie podcasty',
    'no_podcast' => 'Nie znaleziono żadnego podcastu!',
    'create' => 'Utwórz podcast',
    'import' => 'Importuj podcast',
    'new_episode' => 'Nowy odcinek',
    'feed' => 'RSS',
    'view' => 'Zobacz podcast',
    'edit' => 'Edytuj podcast',
    'delete' => 'Usuń podcast',
    'see_episodes' => 'Zobacz odcinki',
    'see_contributors' => 'Zobacz twórców',
    'go_to_page' => 'Przejdź na stronę',
    'latest_episodes' => 'Najnowsze odcinki',
    'see_all_episodes' => 'Zobacz wszystkie odcinki',
    'form' => [
        'identity_section_title' => 'Tożsamość podcastu',
        'identity_section_subtitle' => 'Te pola pomogą się wyróżnić.',
        'image' => 'Obraz okładki',
        'title' => 'Tytuł',
        'name' => 'Nazwa',
        'name_hint' =>
            'Wykorzystywana do tworzenia adresu URL podcastu. Akceptowane są wielkie i małe litery, cyfry i podkreślniki.',
        'type' => [
            'label' => 'Rodzaj',
            'hint' =>
                '- <strong>episodic</strong>: if episodes are intended to be consumed without any specific order. Newest episodes will be presented first.<br/>- <strong>serial</strong>: if episodes are intended to be consumed in sequential order. The oldest episodes will be presented first.',
            'episodic' => 'Episodic',
            'serial' => 'Serial',
        ],
        'description' => 'Opis',
        'classification_section_title' => 'Klasyfikacja',
        'classification_section_subtitle' =>
            'Te pola wpłyną na widownię i konkurencyjność.',
        'language' => 'Język',
        'category' => 'Kategoria',
        'other_categories' => 'Inne kategorie',
        'parental_advisory' => [
            'label' => 'Parental advisory',
            'hint' => 'Does it contain explicit content?',
            'undefined' => 'nie określono',
            'clean' => 'Clean',
            'explicit' => 'Explicit',
        ],
        'author_section_title' => 'Autor',
        'author_section_subtitle' => 'Kto zarządza podcastem?',
        'owner_name' => 'Nazwa właściciela',
        'owner_name_hint' =>
            'Tylko dla użytku administracyjnego. Widoczny w publicznym kanale RSS.',
        'owner_email' => 'Adres e-mail właściciela',
        'owner_email_hint' =>
            'Będzie wykorzystywany przez większość platform do weryfikacji własności podcastu. Widoczny w publicznym kanale RSS.',
        'publisher' => 'Wydawca',
        'publisher_hint' =>
            'Grupa odpowiedzialna za tworzenie podcastu. Zwykle jest to firma lub sieć, która stoi za podcastem. Pole to czasem jest podpisywane jako „Autor”.',
        'location_section_title' => 'Miejsce',
        'location_section_subtitle' => 'Jakiego miejsca dotyczy ten poddcast?',
        'location_name' => 'Nazwa lub adres lokalizacji',
        'location_name_hint' => 'Może to być rzeczywiste lub fikcyjne miejsce',
        'monetization_section_title' => 'Monetyzacja',
        'monetization_section_subtitle' =>
            'Zarabiaj pieniądze dzięki swoim odbiorcom.',
        'payment_pointer' => 'Wskaźnik płatnośći dla Web Monetization',
        'payment_pointer_hint' =>
            'To tutaj otrzymasz pieniądze dzięki Web Monetization',
        'advanced_section_title' => 'Zaawansowane parametry',
        'advanced_section_subtitle' =>
            'Jeżeli potrzebujesz tagów RSS nieobsługiwanych przez Castopod, ustaw je tutaj.',
        'custom_rss' => 'Niestandardowe tagi RSS dla podcastu',
        'custom_rss_hint' => 'Zostanie to umieszczone wewnątrz tagu ❬channel❭.',
        'partnership' => 'Partnerstwo',
        'partner_id' => 'ID',
        'partner_link_url' => 'Link URL',
        'partner_image_url' => 'URL obrazu',
        'partner_id_hint' => 'Your own partner ID',
        'partner_link_url_hint' => 'The generic partner link address',
        'partner_image_url_hint' => 'The generic partner image address',
        'status_section_title' => 'Stan',
        'status_section_subtitle' => 'Żyje, czy nie?',
        'block' => 'Podcast powinien być ukryty na wszystkich platformach',
        'complete' => 'Podcast nie będzie miał nowych odcinków',
        'lock' => 'Zapobiegaj kopiowaniu podcastu',
        'lock_hint' =>
            'Celem jest przekazanie innym platformom do podcastów, czy mogą zaimportować ten kanał. Jeżeli zaznaczono tę opcję, dowolna opcja zaimportowania tego kanału na nową platformę powinna być odrzucana.',
        'submit_create' => 'Utwórz podcast',
        'submit_edit' => 'Zapisz podcast',
    ],
    'category_options' => [
        'uncategorized' => 'bez kategorii',
        'arts' => 'Sztuka',
        'business' => 'Biznes',
        'comedy' => 'Komedia',
        'education' => 'Edukacja',
        'fiction' => 'Fikcja',
        'government' => 'Rządowe',
        'health_and_fitness' => 'Zdrowie i fitness',
        'history' => 'Historia',
        'kids_and_family' => 'Dzieci i rodzina',
        'leisure' => 'Czas wolny',
        'music' => 'Muzyka',
        'news' => 'Wiadomości',
        'religion_and_spirituality' => 'Religia i duchowość',
        'science' => 'Nauka',
        'society_and_culture' => 'Społeczeństwo i kultura',
        'sports' => 'Sport',
        'technology' => 'Technologia',
        'true_crime' => 'True Crime',
        'tv_and_film' => 'TV i filmy',
        'books' => 'Książki',
        'design' => 'Projektowanie',
        'fashion_and_beauty' => 'Moda i piękno',
        'food' => 'Jedzenie',
        'performing_arts' => 'Sztuki widowiskowe',
        'visual_arts' => 'Sztuki wizualne',
        'careers' => 'Kariera',
        'entrepreneurship' => 'Przedsiębiorczość',
        'investing' => 'Inwestowanie',
        'management' => 'Zarządzanie',
        'marketing' => 'Marketing',
        'non_profit' => 'Non-profit',
        'comedy_interviews' => 'Comedy Interviews',
        'improv' => 'Improwizacja',
        'stand_up' => 'Stand-Up',
        'courses' => 'Kursy',
        'how_to' => 'Poradniki',
        'language_learning' => 'Nauka języków',
        'self_improvement' => 'Samodoskonalenie',
        'comedy_fiction' => 'Comedy Fiction',
        'drama' => 'Dramat',
        'science_fiction' => 'Fantastyka naukowa',
        'alternative_health' => 'Medycyna alternatywna',
        'fitness' => 'Fitness',
        'medicine' => 'Medycyna',
        'mental_health' => 'Zdrowie psychiczne',
        'nutrition' => 'Odżywianie',
        'sexuality' => 'Seksualność',
        'education_for_kids' => 'Education for Kids',
        'parenting' => 'Rodzicielstwo',
        'pets_and_animals' => 'Zwierzęta',
        'stories_for_kids' => 'Opowiadania dla dzieci',
        'animation_and_manga' => 'Animacje i manga',
        'automotive' => 'Motoryzacja',
        'aviation' => 'Lotnictwo',
        'crafts' => 'Crafts',
        'games' => 'Gry',
        'hobbies' => 'Hobby',
        'home_and_garden' => 'Dom i ogród',
        'video_games' => 'Gry wideo',
        'music_commentary' => 'Music Commentary',
        'music_history' => 'Music History',
        'music_interviews' => 'Music Interviews',
        'business_news' => 'Business News',
        'daily_news' => 'Daily News',
        'entertainment_news' => 'Entertainment News',
        'news_commentary' => 'News Commentary',
        'politics' => 'Polityka',
        'sports_news' => 'Informacje sportowe',
        'tech_news' => 'Informacje techniczne',
        'buddhism' => 'Buddyzm',
        'christianity' => 'Chrześcijaństwo',
        'hinduism' => 'Hinduizm',
        'islam' => 'Islam',
        'judaism' => 'Judaizm',
        'religion' => 'Religia',
        'spirituality' => 'Duchowość',
        'astronomy' => 'Astronomia',
        'chemistry' => 'Chemia',
        'earth_sciences' => 'Earth Sciences',
        'life_sciences' => 'Life Sciences',
        'mathematics' => 'Matematyka',
        'natural_sciences' => 'Natural Sciences',
        'nature' => 'Natura',
        'physics' => 'Fizyka',
        'social_sciences' => 'Nauki społeczne',
        'documentary' => 'Dokumentalne',
        'personal_journals' => 'Personal Journals',
        'philosophy' => 'Filozofia',
        'places_and_travel' => 'Miejsca i podróżowanie',
        'relationships' => 'Związki',
        'baseball' => 'Baseball',
        'basketball' => 'Koszykówka',
        'cricket' => 'Cricket',
        'fantasy_sports' => 'Fantasy Sports',
        'football' => 'Football amerykański',
        'golf' => 'Golf',
        'hockey' => 'Hokej',
        'rugby' => 'Rugby',
        'running' => 'Biegi',
        'soccer' => 'Piłka nożna',
        'swimming' => 'Pływanie',
        'tennis' => 'Tenis',
        'volleyball' => 'Siatkówka',
        'wilderness' => 'Wilderness',
        'wrestling' => 'Wrestling',
        'after_shows' => 'After Shows',
        'film_history' => 'Film History',
        'film_interviews' => 'Film Interviews',
        'film_reviews' => 'Recenzje filmów',
        'tv_reviews' => 'Recenzje TV',
    ],
    'by' => 'Od {publisher}',
    'season' => 'Sezon {seasonNumber}',
    'list_of_episodes_year' => 'Odcinki z {year} ({episodeCount})',
    'list_of_episodes_season' =>
        'Odcinki z sezonu {seasonNumber} ({episodeCount})',
    'no_episode' => 'Nie znaleziono żadnego odcinku!',
    'no_episode_hint' =>
        'Navigate the podcast episodes with the navigation bar above.',
    'follow' => 'Obserwuj',
    'followers' => '{numberOfFollowers, plural,
        one {<span class="font-semibold">#</span> obserwujący}
        few {<span class="font-semibold">#</span> obserwujących}
        many {<span class="font-semibold">#</span> obserwujących}
        other {<span class="font-semibold">#</span> obserwujących}
    }',
    'notes' => '{numberOfNotes, plural,
        one {<span class="font-semibold">#</span> wpis}
        few {<span class="font-semibold">#</span> wpisy}
        many {<span class="font-semibold">#</span> wpisów}
        other {<span class="font-semibold">#</span> wpisy}
    }',
    'activity' => 'Aktywność',
    'episodes' => 'Odcinki',
    'sponsor_title' => 'Podoba Ci się?',
    'sponsor' => 'Sponsoruj',
    'funding_links' => 'Odnośniki do finansowania {podcastTitle}',
    'find_on' => 'Znajdź {podcastTitle} na',
    'listen_on' => 'Słuchaj na',
];
