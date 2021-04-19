<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'all_podcasts' => 'Wszystkie podcasty',
    'no_podcast' => 'Nie znaleziono podcastu!',
    'create' => 'Utwórz podcast',
    'import' => 'Importuj podcast',
    'new_episode' => 'Nowy odcinek',
    'feed' => 'RSS',
    'view' => 'Zobacz podcast',
    'edit' => 'Edytuj podcast',
    'delete' => 'Usuń podcast',
    'see_episodes' => 'Zobacz odcinki',
    'see_contributors' => 'See contributors',
    'go_to_page' => 'Przejdź na stronę',
    'latest_episodes' => 'Najnowsze odcinki',
    'see_all_episodes' => 'Zobacz wszystkie odcinki',
    'form' => [
        'identity_section_title' => 'Tożsamość podcastu',
        'identity_section_subtitle' => 'Te pola pomogą się wyróżnić.',
        'image' => 'Cover image',
        'title' => 'Tytuł',
        'name' => 'Nazwa',
        'name_hint' =>
            'Used for generating the podcast URL. Uppercase, lowercase, numbers and underscores are accepted.',
        'type' => [
            'label' => 'Type',
            'hint' =>
                '- <strong>episodic</strong>: if episodes are intended to be consumed without any specific order. Newest episodes will be presented first.<br/>- <strong>serial</strong>: if episodes are intended to be consumed in sequential order. The oldest episodes will be presented first.',
            'episodic' => 'Episodic',
            'serial' => 'Serial',
        ],
        'description' => 'Opis',
        'classification_section_title' => 'Klasyfikacja',
        'classification_section_subtitle' =>
            'These fields will impact your audience and competition.',
        'language' => 'Język',
        'category' => 'Kategoria',
        'other_categories' => 'Inne kategorie',
        'parental_advisory' => [
            'label' => 'Parental advisory',
            'hint' => 'Does it contain explicit content?',
            'undefined' => 'undefined',
            'clean' => 'Clean',
            'explicit' => 'Explicit',
        ],
        'author_section_title' => 'Autor',
        'author_section_subtitle' => 'Kto zarządza podcastem?',
        'owner_name' => 'Owner name',
        'owner_name_hint' =>
            'For administrative use only. Visible in the public RSS feed.',
        'owner_email' => 'Owner email',
        'owner_email_hint' =>
            'Will be used by most platforms to verify the podcast ownership. Visible in the public RSS feed.',
        'publisher' => 'Publisher',
        'publisher_hint' =>
            'The group responsible for creating the show. Often refers to the parent company or network of a podcast. This field is sometimes labeled as ’Author’.',
        'copyright' => 'Copyright',
        'location_section_title' => 'Location',
        'location_section_subtitle' => 'What place is this podcast about?',
        'location_name' => 'Location name or address',
        'location_name_hint' => 'This can be a real place or fictional',
        'monetization_section_title' => 'Monetization',
        'monetization_section_subtitle' =>
            'Earn money thanks to your audience.',
        'payment_pointer' => 'Payment Pointer for Web Monetization',
        'payment_pointer_hint' =>
            'This is your where you will receive money thanks to Web Monetization',
        'advanced_section_title' => 'Advanced Parameters',
        'advanced_section_subtitle' =>
            'If you need RSS tags that Castopod does not handle, set them here.',
        'custom_rss' => 'Custom RSS tags for the podcast',
        'custom_rss_hint' => 'This will be injected within the ❬channel❭ tag.',
        'partnership' => 'Partnership',
        'partner_id' => 'ID',
        'partner_link_url' => 'Link URL',
        'partner_image_url' => 'URL obrazu',
        'partner_id_hint' => 'Your own partner ID',
        'partner_link_url_hint' => 'The generic partner link address',
        'partner_image_url_hint' => 'The generic partner image address',
        'status_section_title' => 'Status',
        'status_section_subtitle' => 'Dead or alive?',
        'block' => 'Podcast should be hidden from all platforms',
        'complete' => 'Podcast will not be having new episodes',
        'lock' => 'Prevent podcast from being copied',
        'lock_hint' =>
            'The purpose is to tell other podcast platforms whether they are allowed to import this feed. A value of yes means that any attempt to import this feed into a new platform should be rejected.',
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
        'performing_arts' => 'Performing Arts',
        'visual_arts' => 'Visual Arts',
        'careers' => 'Kariera',
        'entrepreneurship' => 'Przedsiębiorczość',
        'investing' => 'Inwestowanie',
        'management' => 'Zarządzanie',
        'marketing' => 'Marketing',
        'non_profit' => 'Non-profit',
        'comedy_interviews' => 'Comedy Interviews',
        'improv' => 'Improv',
        'stand_up' => 'Stand-Up',
        'courses' => 'Courses',
        'how_to' => 'How To',
        'language_learning' => 'Language Learning',
        'self_improvement' => 'Self-Improvement',
        'comedy_fiction' => 'Comedy Fiction',
        'drama' => 'Drama',
        'science_fiction' => 'Science Fiction',
        'alternative_health' => 'Alternative Health',
        'fitness' => 'Fitness',
        'medicine' => 'Medicine',
        'mental_health' => 'Mental Health',
        'nutrition' => 'Nutrition',
        'sexuality' => 'Seksualność',
        'education_for_kids' => 'Education for Kids',
        'parenting' => 'Parenting',
        'pets_and_animals' => 'Pets &amp Animals',
        'stories_for_kids' => 'Stories for Kids',
        'animation_and_manga' => 'Animation &amp Manga',
        'automotive' => 'Automotive',
        'aviation' => 'Aviation',
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
        'sports_news' => 'Sports News',
        'tech_news' => 'Tech News',
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
    'list_of_episodes_year' => '{year} odcinki ({episodeCount})',
    'list_of_episodes_season' =>
        'Season {seasonNumber} episodes ({episodeCount})',
    'no_episode' => 'Nie znaleziono o episode found!',
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
