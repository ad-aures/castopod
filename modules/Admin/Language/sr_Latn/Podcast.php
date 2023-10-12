<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'all_podcasts' => 'Svi podkasti',
    'no_podcast' => 'Nema pronađenih podkasta!',
    'create' => 'Napravi podkast',
    'import' => 'Uvezi podkast',
    'all_imports' => 'Podcast imports',
    'new_episode' => 'Nova epizoda',
    'view' => 'Pogledaj epizodu',
    'edit' => 'Uredi podkast',
    'publish' => 'Objavi podkast',
    'publish_edit' => 'Uredi objavu',
    'delete' => 'Obriši podkast',
    'see_episodes' => 'Pogledaj epizode',
    'see_contributors' => 'Pogledaj saradnike',
    'go_to_page' => 'Idi na stranicu',
    'latest_episodes' => 'Najnovije epizode',
    'see_all_episodes' => 'Prikaži sve epizode',
    'draft' => 'Nacrt',
    'messages' => [
        'createSuccess' => 'Podkast uspešno kreiran!',
        'editSuccess' => 'Podkast je uspešno ažuriran!',
        'importSuccess' => 'Podkast je uspešno uvezen!',
        'deleteSuccess' => 'Podkast @{podcast_handle} je uspešno obrisan!',
        'deletePodcastMediaError' => 'Neuspešno brisanje podkast {type, select,
            cover {omota}
            banner {banera}
            other {medija}
        }.',
        'deleteEpisodeMediaError' => 'Neuspešno brisanje {episode_slug} {type, select,
            transcript {transkripta}
            chapters {poglavlja}
            image {omota}
            audio {zvuka}
            other {medija}
        }.',
        'deletePodcastMediaFolderError' => 'Neuspešno brisanje podkast medija direktorijuma {folder_path}. Možete ga ručno ukloniti sa diska.',
        'podcastFeedUpdateSuccess' => 'Uspešno ažuriranje: {number_of_new_episodes, plural,
            one {# epizoda je}
            other {# epizode su}
        } deo podkasta!',
        'podcastFeedUpToDate' => 'Podkast je već ažuriran.',
        'publishError' => 'Ovaj podkast je ili već objavljen ili zakazan za objavu.',
        'publishEditError' => 'Ovaj podkast nije zakazan za objavu.',
        'publishCancelSuccess' => 'Objavljivanje podkasta je uspešno otkazano!',
        'scheduleDateError' => 'Morate zakazati datum objave!',
    ],
    'form' => [
        'identity_section_title' => 'Identitet podkasta',
        'identity_section_subtitle' => 'Ova polja vam pomažu da budete prepoznati.',
        'cover' => 'Omot podkasta',
        'cover_size_hint' => 'Omot mora biti kvadratnog oblika i minimum 1400px širok i visok.',
        'banner' => 'Baner podkasta',
        'banner_size_hint' => 'Baner mora imati odnos 3:1 i biti najmanje 1500px širok.',
        'banner_delete' => 'Obriši baner podkasta',
        'title' => 'Naslov',
        'handle' => 'Handle',
        'handle_hint' =>
            'Koristi se radi identifikacije podkasta. Velika slova, mala slova, brojevi i donja crta su prihvatljivi.',
        'type' => [
            'label' => 'Vrsta',
            'episodic' => 'Epizodno',
            'episodic_hint' => 'Ukoliko su epizode namenjene za konzumiranje bez nekog specifičnog reda. Najnovija epizoda će biti predstavljena prva u redosledu.',
            'serial' => 'Serijski',
            'serial_hint' => 'Ukoliko su epizode namenjene za konzumiranje specifičnim redom. Najstarija epizoda će biti predstavljena prva u redosledu.',
        ],
        'description' => 'Description',
        'classification_section_title' => 'Classification',
        'classification_section_subtitle' =>
            'These fields will impact your audience and competition.',
        'language' => 'Language',
        'category' => 'Category',
        'category_placeholder' => 'Select a category…',
        'other_categories' => 'Other categories',
        'parental_advisory' => [
            'label' => 'Parental advisory',
            'hint' => 'Does it contain explicit content?',
            'undefined' => 'undefined',
            'clean' => 'Clean',
            'explicit' => 'Explicit',
        ],
        'author_section_title' => 'Author',
        'author_section_subtitle' => 'Who is managing the podcast?',
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
        'premium' => 'Premium',
        'premium_by_default' => 'Episodes must be set as premium by default',
        'premium_by_default_hint' => 'Podcast episodes will be marked as premium by default. You can still choose to set some episodes, trailers or bonuses as public.',
        'op3' => 'Open Podcast Prefix Project (OP3)',
        'op3_hint' => 'Value your analytics data with OP3, an open-source and trusted third party analytics service. Share, validate and compare your analytics data with the open podcasting ecosystem.',
        'op3_enable' => 'Enable OP3 analytics service',
        'op3_enable_hint' => 'For security reasons, premium episodes\' analytics data will not be shared with OP3.',
        'payment_pointer' => 'Payment Pointer for Web Monetization',
        'payment_pointer_hint' =>
            'This is your where you will receive money thanks to Web Monetization',
        'advanced_section_title' => 'Advanced Parameters',
        'advanced_section_subtitle' =>
            'If you need RSS tags that Castopod does not handle, set them here.',
        'custom_rss' => 'Custom RSS tags for the podcast',
        'custom_rss_hint' => 'This will be injected within the ❬channel❭ tag.',
        'new_feed_url' => 'New feed URL',
        'new_feed_url_hint' => 'Use this field when you move to another domain or podcast hosting platform. By default, the value is set to the current RSS URL if the podcast is imported.',
        'old_feed_url' => 'Old feed URL',
        'partnership' => 'Partnership',
        'partner_id' => 'ID',
        'partner_link_url' => 'URL adresa veze',
        'partner_image_url' => 'URL adresa slike',
        'partner_id_hint' => 'Vaš partnerski ID',
        'partner_link_url_hint' => 'Generička adresa veze partnera',
        'partner_image_url_hint' => 'Generička adresa slike partnera',
        'status_section_title' => 'Status',
        'block' => 'Podkast treba sakriti iz javnih kataloga',
        'block_hint' =>
            'Prikazan ili sakriven status podkasta: ukoliko uključite ovu opciju onemogućavate prikazivanje vašeg podkasta na paltformama za slušanje podkasta kao što su Apple Podcasts, Google Podcasts i sličnim direktorijima. (Nije zagarantovano)',
        'complete' => 'Podkast više neće imati novih epizoda',
        'lock' => 'Sprečite kopiranje podkasta',
        'lock_hint' =>
            'Cilj ovoga je da komunicira sa drugim podkast platformama i ne dozvoli im da povlače vaš sadržaj. Ukoliko odaberete Da, to znači da će svaki njihov pokušaj da izlistaju vaš sadržaj na svojoj platformi biti odbijen.',
        'submit_create' => 'Napravi podkast',
        'submit_edit' => 'Sačuvaj podkast',
    ],
    'category_options' => [
        'uncategorized' => 'nekategorizovano',
        'arts' => 'Umetnost',
        'business' => 'Posao',
        'comedy' => 'Komedija',
        'education' => 'Obrazovanje',
        'fiction' => 'Fikcija',
        'government' => 'Vlada',
        'health_and_fitness' => 'Zdravlje i Fitnes',
        'history' => 'Istorija',
        'kids_and_family' => 'Deca i Porodica',
        'leisure' => 'Razonoda',
        'music' => 'Muzika',
        'news' => 'Vesti',
        'religion_and_spirituality' => 'Religija i spiritualnost',
        'science' => 'Nauka',
        'society_and_culture' => 'Društvo i Kultura',
        'sports' => 'Sport',
        'technology' => 'Tehnologija',
        'true_crime' => 'Istinski zločini',
        'tv_and_film' => 'Televizija i Film',
        'books' => 'Knjige',
        'design' => 'Dizajn',
        'fashion_and_beauty' => 'Moda i Lepota',
        'food' => 'Hrana',
        'performing_arts' => 'Izvođačka umetnost',
        'visual_arts' => 'Likovna umetnost',
        'careers' => 'Karijera',
        'entrepreneurship' => 'Prednuzetništvo',
        'investing' => 'Investiranje',
        'management' => 'Upravljanje',
        'marketing' => 'Marketing',
        'non_profit' => 'Neprofitna udruženja',
        'comedy_interviews' => 'Komični intervjui',
        'improv' => 'Improvizacija',
        'stand_up' => 'Stendap komedija',
        'courses' => 'Kursevi',
        'how_to' => 'Uradi sam',
        'language_learning' => 'Učenje jezika',
        'self_improvement' => 'Samopoboljšanje',
        'comedy_fiction' => 'Komična fantastika',
        'drama' => 'Drama',
        'science_fiction' => 'Naučna Fantastika',
        'alternative_health' => 'Alternativno zdravlje',
        'fitness' => 'Fitnes',
        'medicine' => 'Medicina',
        'mental_health' => 'Mentalno zdravlje',
        'nutrition' => 'Nutricionizam',
        'sexuality' => 'Seksualnost',
        'education_for_kids' => 'Obrazovanje dece',
        'parenting' => 'Roditeljstvo',
        'pets_and_animals' => 'Ljubimci i životinje',
        'stories_for_kids' => 'Priče za decu',
        'animation_and_manga' => 'Animacija i Manga',
        'automotive' => 'Automobilizam',
        'aviation' => 'Avijacija',
        'crafts' => 'Zanati',
        'games' => 'Igre',
        'hobbies' => 'Hobiji',
        'home_and_garden' => 'Dom i bašta',
        'video_games' => 'Video igre',
        'music_commentary' => 'Komentari muzike',
        'music_history' => 'Istorija muzike',
        'music_interviews' => 'Muzički intervjui',
        'business_news' => 'Vesti iz preduzetništva',
        'daily_news' => 'Dnevne vesti',
        'entertainment_news' => 'Vesti iz zabave',
        'news_commentary' => 'Komentari vesti',
        'politics' => 'Politika',
        'sports_news' => 'Sportske vesti',
        'tech_news' => 'Tehnološke vesti',
        'buddhism' => 'Budizam',
        'christianity' => 'Hrišćanstvo',
        'hinduism' => 'Hinduizam',
        'islam' => 'Islam',
        'judaism' => 'Judeizam',
        'religion' => 'Religija',
        'spirituality' => 'Duhovnost',
        'astronomy' => 'Astronomija',
        'chemistry' => 'Hemija',
        'earth_sciences' => 'Studije zemlje',
        'life_sciences' => 'Studije života',
        'mathematics' => 'Matematika',
        'natural_sciences' => 'Prirodne nauke',
        'nature' => 'Priroda',
        'physics' => 'Fizika',
        'social_sciences' => 'Social Sciences',
        'documentary' => 'Documentary',
        'personal_journals' => 'Lični dnevnici',
        'philosophy' => 'Filozofija',
        'places_and_travel' => 'Mesta i Putovanje',
        'relationships' => 'Veze',
        'baseball' => 'Bejzbol',
        'basketball' => 'Košarka',
        'cricket' => 'Kriket',
        'fantasy_sports' => 'Fantazi sport',
        'football' => 'Američki fudbal',
        'golf' => 'Golf',
        'hockey' => 'Hokej',
        'rugby' => 'Ragbi',
        'running' => 'Trčanje',
        'soccer' => 'Fudbal',
        'swimming' => 'Plivanje',
        'tennis' => 'Tenis',
        'volleyball' => 'Odbojka',
        'wilderness' => 'Divljina',
        'wrestling' => 'Rvanje',
        'after_shows' => 'Posle emisija',
        'film_history' => 'Filmska istorija',
        'film_interviews' => 'Filmski intervjui',
        'film_reviews' => 'Filmske recenzije',
        'tv_reviews' => 'Televizijske recenzije',
    ],
    'publish_form' => [
        'back_to_podcast_dashboard' => 'Nazad na komandnu tablu podkasta',
        'post' => 'Najava vaše objave',
        'post_hint' =>
            "Napišite poruku kako bi ste najavili objavljivanje vašeg podkasta. Ova poruka će biti istaknuta na početnoj stranici vašeg podkasta.",
        'message_placeholder' => 'Napišite poruku…',
        'submit' => 'Objavi',
        'publication_date' => 'Datum objavljivanja',
        'publication_method' => [
            'now' => 'Sada',
            'schedule' => 'Raspored',
        ],
        'scheduled_publication_date' => 'Planiran datum objave',
        'scheduled_publication_date_hint' =>
            'Možete zakazati objavu podkasta u budućnosti. Ovo polje mora biti popunjeno u YYYY-MM-DD HH:mm formatu',
        'submit_edit' => 'Uredi objavu',
        'cancel_publication' => 'Poništi objavu',
        'message_warning' => 'Niste napisali poruku za najavu objave!',
        'message_warning_hint' => 'Poruka povećava šanse za angažovanjem na društvenim mrežama, rezultirajući u većoj vidljivosti vašeg podkasta.',
        'message_warning_submit' => 'Objavi svakako',
    ],
    'publication_status_banner' => [
        'draft_mode' => 'režim nacrta',
        'not_published' => 'Ovaj podkast nije još uvek objavljen.',
        'scheduled' => 'Ovaj podkast je zakazan za objavu {publication_date}.',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Brisanjem podkasta obrisaće se i sve epizode, medijske datoteke, objave i analitika povezana sa njim. Ova radnja je nepovratna, nakon toga nećete više moći da ih preuzmete ili povratite.",
        'understand' => 'Razumem, želim da trajno obrišem podkast',
        'submit' => 'Obriši',
    ],
    'by' => 'Od {publisher}',
    'season' => 'Sezona {seasonNumber}',
    'list_of_episodes_year' => '{year} epizoda ({episodeCount})',
    'list_of_episodes_season' =>
        'Sezona {seasonNumber} epizoda ({episodeCount})',
    'no_episode' => 'Nijedna epizode nije pronađena!',
    'follow' => 'Follow',
    'followers' => '{numberOfFollowers, plural,
        one {# follower}
        other {# followers}
    }',
    'posts' => '{numberOfPosts, plural,
        one {# post}
        other {# posts}
    }',
    'activity' => 'Activity',
    'episodes' => 'Episodes',
    'sponsor' => 'Sponsor',
    'funding_links' => 'Funding links for {podcastTitle}',
    'find_on' => 'Find {podcastTitle} on',
    'listen_on' => 'Listen on',
];
