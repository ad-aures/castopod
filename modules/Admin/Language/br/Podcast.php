<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'all_podcasts' => 'An holl bodkastoù',
    'no_podcast' => 'N\'eo bet kavet podkast ebet!',
    'create' => 'Krouiñ ur podkast',
    'import' => 'Enporzhiañ ur podkast',
    'all_imports' => 'Ar podkastoù enporzhiet',
    'new_episode' => 'Rann nevez',
    'view' => 'Gwelet ar podkast',
    'edit' => 'Kemmañ ar podkast',
    'publish' => 'Embann ar podkast',
    'publish_edit' => 'Kemmañ an embannadur',
    'delete' => 'Dilemel ar podkast',
    'see_episodes' => 'Gwelet ar rannoù',
    'see_contributors' => 'Gwelet ar berzhidi, ar perzhiadezed',
    'monetization_other' => 'Doare arc\'hantaouiñ all',
    'go_to_page' => 'Gwelet ar bajenn',
    'latest_episodes' => 'Rannoù diwezhañ',
    'see_all_episodes' => 'Gwelet an holl rannoù',
    'draft' => 'Brouilhed',
    'messages' => [
        'createSuccess' => 'Krouet eo bet ar podkast gant berzh!',
        'editSuccess' => 'Nevesaet eo bet ar podkast gant berzh!',
        'importSuccess' => 'Enporzhiet eo bet ar podkast gant berzh!',
        'deleteSuccess' => 'Dilamet eo bet ar podkast @{podcast_handle} gant berzh!',
        'deletePodcastMediaError' => 'C\'hwitadenn war dilemel {type, select,
            cover {golo}
            banner {giton}
            other {media}
        } ar podkast.',
        'deleteEpisodeMediaError' => 'C\'hwitadenn war dilemel {type, select,
            transcript {treuzskrivadur}
            chapters {chabistroù}
            image {golo}
            audio {aodio}
            other {media}
        } ar rann {episode_slug}.',
        'deletePodcastMediaFolderError' => 'C\'hwitadenn war dilemel teuliad ar mediaioù {folder_path}. Gallout a rit lemel an teuliad-mañ diouzh ar gantenn dre zorn.',
        'podcastFeedUpdateSuccess' => 'Nevesadenn: {number_of_new_episodes, plural,
            one {# rann}
            two {# rann}
            few {# rann}
            many {# rann}
            other {# rann}
        } a zo bet ouzhpennet d\'ar podkast gant berzh!',
        'podcastFeedUpToDate' => 'Nevesaet eo bet ar podkast dija.',
        'publishError' => 'Ar podkast-mañ a zo bet embannet dija pe steuñvet eo e embannadur.',
        'publishEditError' => 'N\'eo ket steuñvet embannadur ar podkast-mañ.',
        'publishCancelSuccess' => 'Nullet eo bet embannadur ar podkast gant berzh!',
        'scheduleDateError' => 'Ret eo lakaat un deiziad evit an embannadur!',
    ],
    'form' => [
        'identity_section_title' => 'Titouroù diwar-benn ar podkast',
        'identity_section_subtitle' => 'Ar maeziennoù a laka ac\'hanoc\'h da vezañ remerket.',
        'fediverse_section_title' => 'Identelezh er Fediverse',

        'cover' => 'Golo ar podkast',
        'cover_size_hint' => 'Ar golo a rankfe bezañ ur c\'harrez ha 1400px e vent da nebeutañ.',
        'banner' => 'Giton ar podkast',
        'banner_size_hint' => 'Ar giton a rankfe bezañ 3:1 e feur led/sav ha bezañ 1500px e led d\'an nebeutañ.',
        'banner_delete' => 'Dilemel giton ar podkast',
        'title' => 'Titl',
        'handle' => 'Anv ar podkast (handle)',
        'handle_hint' =>
            'Implijet evit anavezout ar podkast. Lizherennoù bras pe munut, niveroù hag islinenn (_) degemeret.',
        'type' => [
            'label' => 'Doare',
            'episodic' => 'Bep ur mare',
            'episodic_hint' => 'M\'eo ar rannoù da vezañ selaouet hep urzh resis. Ar rannoù nevesoc’h a vo kinniget da gentañ.',
            'serial' => 'Heuliad',
            'serial_hint' => 'M\'eo ar rannoù da vezañ selaouet gant un urzh resis. Ar rannoù a vo kinniget hervez urzh an niverennoù.',
        ],
        'medium' => [
            'label' => 'Medium',
            'hint' => 'Ar medium evel ma vez kinniget gant ar valizenn RSS podcast:medium. Cheñch an dra-se a c\'hell cheñch an doare ma vo kinniget ho kwazh gant al lennerien.',
            'podcast' => 'Podkast',
            'podcast_hint' => 'Evit deskrivañ gwazh ur podkast.',
            'music' => 'Sonerezh',
            'music_hint' => 'Ur wazh gant sonerezh aozet e-barzh un "album". Pep item zo un ton en album.',
            'audiobook' => 'Levr klevet',
            'audiobook_hint' => 'Ur seurt aodio dibar gant un item dre wazh, peotramant pa glot an itemoù gant chabistroù al levr.',
        ],
        'description' => 'Deskrivadur',
        'classification_section_title' => 'Rummatadur',
        'classification_section_subtitle' =>
            'Ar maeziennoù-mañ o do ul levezon war an niver a selaouerien·ezed hag ho kevezerezh.',
        'language' => 'Yezh',
        'category' => 'Rummad',
        'category_placeholder' => 'Dibab ur rummad…',
        'other_categories' => 'Rummadoù all',
        'parental_advisory' => [
            'label' => 'Kemenn evit ar gerent',
            'hint' => 'Hag an dra-se a zo danvez ha ne zlefe ket gwelet gant bugale?',
            'undefined' => 'andermenet',
            'clean' => 'Dereat',
            'explicit' => 'Danvez evit an oadourien',
        ],
        'author_section_title' => 'Aozer·ez',
        'author_section_subtitle' => 'Piv zo o verañ ar podkast?',
        'owner_name' => 'Anv ar perc\'henn·ez',
        'owner_name_hint' =>
            'Evit a sell ouzh ar mererezh. War ar wazh RSS publik e vo.',
        'owner_email' => 'Chomlec\'h postel ar perc\'henn·ez',
        'owner_email_hint' =>
            'Implijet e vo gant an darn vrasañ eus ar savennoù evit gwiriañ perc\'hentiezh ar podkast. War ar wazh RSS publik e vo.',
        'is_owner_email_removed_from_feed' => 'Lemel chomlec\'h postel ar perc\'henn·ez diouzh ar wazh RSS publik',
        'is_owner_email_removed_from_feed_hint' => 'Rankout a rafec\'h lakaat ar chomlec\'h war wel adarre, evit ur mare, evit ma vefe gouest ur meneger da wiriañ oc\'h ar perc\'henn·ez.',
        'publisher' => 'Embanner·ez',
        'publisher_hint' =>
            'Ar strollad kiriek eus sevel ar podkast. Alies eo embregerezh pe rouedad ar podkast. A-wechoù e vez anvet ar vaezienn-mañ "Aozer·ez".',
        'copyright' => 'Gwirioù an aozer·ez',
        'location_section_title' => 'Lec\'h',
        'location_section_subtitle' => 'Eus peseurt lec\'h ez eus kaoz er podkast-mañ?',
        'location_name' => 'Anv pe chomlec\'h al lec\'h',
        'location_name_hint' => 'Gallout a ra bezañ gwir pe faltaziek',
        'monetization_section_title' => 'Moneisaat',
        'monetization_section_subtitle' =>
            'Dastum arc\'hant a-drugarez d\'ho selaouerien·ezed.',
        'premium' => 'Premium',
        'premium_by_default' => 'Ar rannoù a zo evit ar re bremium dre ziouer',
        'premium_by_default_hint' => 'Rannoù ar podkast a vo merket Premium dre ziouer. Gallout a rit lakaat rannoù zo evel publik.',
        'op3' => 'Open Podcast Prefix Project (OP3)',
        'op3_link' => 'Mont da welet ho taolenn-stur OP3 (liamm diavaez)',
        'op3_hint' => 'Talvoudekait ho roadennoù gant OP3, zo ur servij open source diavaez evit dielfennañ ar muzulioù heklev. Rannit, kadarnait ha lakait ho roadennoù keñver-ha-keñver gant re ekosistem ar podkastoù digor.',
        'op3_enable' => 'Gweredekaat ar servij dielfennañ OP3',
        'op3_enable_hint' => 'Evit abegoù surentez ne vo ket rannet roadennoù ar rannoù Premium gant OP3.',
        'payment_pointer' => 'Chomlec\'h paeañ (Payment Poienter) evit Web Monetization',
        'payment_pointer_hint' =>
            'Ar chomlec\'h ma vo dastumet an arc\'hant ganeoc\'h a-drugarez da Web Monetization',
        'advanced_section_title' => 'Arventennoù kempleshoc\'h',
        'advanced_section_subtitle' =>
            'M\'ho peus ezhomm eus balizennoù RSS ha n\'eus ket anezho e Castopod e c\'hellit o lakaat amañ.',
        'custom_rss' => 'Balizennoù RSS personelaet evit ar podkast',
        'custom_rss_hint' => 'An dra-se a vo ouzhpennet e-barzh ar valizenn ❬channel❭.',
        'verify_txt' => 'Ownership verification TXT',
        'verify_txt_hint' => 'Rather than relying on email, certain third-party services may confirm your podcast ownership by requesting you to embed a verification text within your feed.',
        'verify_txt_helper' => 'This text is injected into a <podcast:txt purpose="verify"> tag.',
        'new_feed_url' => 'URL nevez ar wazh',
        'new_feed_url_hint' => 'Implijit ar vaezienn-mañ pa cheñchit anv domani pe savenn herberc\'hiañ ho podkast. M\'eo enporzhiet ar podkast e vez lakaet enni URL a-vremañ ar wazh dre ziouer.',
        'old_feed_url' => 'URL kozh ar wazh',
        'partnership' => 'Kevelerezh',
        'partner_id' => 'ID',
        'partner_link_url' => 'Ere URL',
        'partner_image_url' => 'URL ar skeudenn',
        'partner_id_hint' => 'Hoc’h ID deoc\'h-c\'hwi e ti ar c\'heveler',
        'partner_link_url_hint' => 'Chomlec\'h generek an ereoù gant ar c\'heveler',
        'partner_image_url_hint' => 'Chomlec\'h generek ar skeudennoù gant ar c\'heveler',
        'block' => 'Ar podkast a rankfe bezañ kuzhet diouzh ar rolladoù publik',
        'block_hint' =>
            'Diskouez pe kuzhat ar podkast: trec\'haoliñ an afell-mañ a viro ar podkast a-bezh ouzh bezañ diskouezet war Apple Podcasts, Google Podcasts pe savennoù all hag a implij ar renabloù-se. (N\'eus gwarant ebet)',
        'complete' => 'Ne vo mui rannoù nevez gant ar podkast',
        'lock' => 'Mirout ar podkast ouzh bezañ eilet',
        'lock_hint' =>
            'Ar pal eo lavaret d\'ar savennoù all hag aotreet int da enporzhiañ ar wazh-mañ pe get. "Ya" a dalv eo nac\'het an holl c\'houlennoù enporzhiañ.',
        'submit_create' => 'Krouiñ ar podkast',
        'submit_edit' => 'Enrollañ ar podkast',
    ],
    'category_options' => [
        'uncategorized' => 'hep rummad',
        'arts' => 'Arzoù',
        'business' => 'Embregerezh',
        'comedy' => 'Fentc\'hoari',
        'education' => 'Deskadurezh',
        'fiction' => 'Faltazi',
        'government' => 'Gouarnamant',
        'health_and_fitness' => 'Yec\'hed ha fitness',
        'history' => 'Istor',
        'kids_and_family' => 'Bugale ha familh',
        'leisure' => 'Dudi',
        'music' => 'Sonerezh',
        'news' => 'Keleier',
        'religion_and_spirituality' => 'Relijion ha speredelezh',
        'science' => 'Skiant',
        'society_and_culture' => 'Kevredigezh ha sevenadur',
        'sports' => 'Sportoù',
        'technology' => 'Teknologiezh',
        'true_crime' => 'Teulioù an torfed',
        'tv_and_film' => 'Skinwel ha filmoù',
        'books' => 'Levrioù',
        'design' => 'Ergrafañ',
        'fashion_and_beauty' => 'Giz ha kened',
        'food' => 'Boued',
        'performing_arts' => 'Arzoù an arvest',
        'visual_arts' => 'Arzoù ar gweled',
        'careers' => 'Respetoù',
        'entrepreneurship' => 'Antreprenerezh',
        'investing' => 'Postadur',
        'management' => 'Mererezh',
        'marketing' => 'Marketing',
        'non_profit' => 'Hep pal kenwerzhel',
        'comedy_interviews' => 'Atersadennoù fentus',
        'improv' => 'Primaozañ',
        'stand_up' => 'Stand up',
        'courses' => 'Kentelioù',
        'how_to' => 'Tutorial',
        'language_learning' => 'Deskiñ yezhoù',
        'self_improvement' => 'Diorren hiniennel',
        'comedy_fiction' => 'Fentc\'hoari faltaziek',
        'drama' => 'Drama',
        'science_fiction' => 'Skiant-faltazi',
        'alternative_health' => 'Yec\'hed all',
        'fitness' => 'Fitness',
        'medicine' => 'Medisinerezh',
        'mental_health' => 'Yec\'hed-spered',
        'nutrition' => 'Magadurezh',
        'sexuality' => 'Seksualegezh',
        'education_for_kids' => 'Deskadurezh evit ar vugale',
        'parenting' => 'Kerentelezh',
        'pets_and_animals' => 'Loened-ti ha loened',
        'stories_for_kids' => 'Marvailhoù evit ar vugale',
        'animation_and_manga' => 'Tresadennoù bev ha Manga',
        'automotive' => 'Kirri-tan',
        'aviation' => 'Kirri-nij',
        'crafts' => 'Artizanerezh',
        'games' => 'C\'hoarioù',
        'hobbies' => 'Dudioù',
        'home_and_garden' => 'Ti ha jardin',
        'video_games' => 'C\'hoarioù video',
        'music_commentary' => 'Evezhiadenn sonerezh',
        'music_history' => 'Istor ar sonerezh',
        'music_interviews' => 'Atersadennoù sonerezh',
        'business_news' => 'Keleier ekonomikel',
        'daily_news' => 'Keleier pemdeziek',
        'entertainment_news' => 'Keleier an diduamant',
        'news_commentary' => 'Evezhiadenn ar c\'heleier',
        'politics' => 'Politikerezh',
        'sports_news' => 'Keleier sport',
        'tech_news' => 'Keleier teknologiezh',
        'buddhism' => 'Boudaegezh',
        'christianity' => 'Kristeniezh',
        'hinduism' => 'Hindouegezh',
        'islam' => 'Islam',
        'judaism' => 'Yuzevegezh',
        'religion' => 'Relijion',
        'spirituality' => 'Speredelezh',
        'astronomy' => 'Steredoniezh',
        'chemistry' => 'Kimiezh',
        'earth_sciences' => 'Skiantoù an douar',
        'life_sciences' => 'Bevoniezh',
        'mathematics' => 'Matematikoù',
        'natural_sciences' => 'Skiantoù an natur',
        'nature' => 'Natur',
        'physics' => 'Fizik',
        'social_sciences' => 'Skiantoù sokial',
        'documentary' => 'Teulioù',
        'personal_journals' => 'Deizlevr hiniennel',
        'philosophy' => 'Prederouriezh',
        'places_and_travel' => 'Lec\'hioù ha beajoù',
        'relationships' => 'Darempredoù',
        'baseball' => 'Baseball',
        'basketball' => 'Basket-ball',
        'cricket' => 'Kriked',
        'fantasy_sports' => 'Sportoù faltaziek',
        'football' => 'Mell-droad',
        'golf' => 'Golf',
        'hockey' => 'Hockey',
        'rugby' => 'Rugbi',
        'running' => 'Redek',
        'soccer' => 'Mell-droad',
        'swimming' => 'Neuierezh',
        'tennis' => 'Tennis',
        'volleyball' => 'Volleyball',
        'wilderness' => 'Natur',
        'wrestling' => 'Gouren',
        'after_shows' => 'Goude abadenn',
        'film_history' => 'Istor ar sinema',
        'film_interviews' => 'Atersadennoù er sinema',
        'film_reviews' => 'Barnadennoù filmoù',
        'tv_reviews' => 'Barnadennoù tele',
    ],
    'publish_form' => [
        'back_to_podcast_dashboard' => 'Distreiñ da daolenn-stur ar podkast',
        'post' => 'Ho kemennadenn vrudañ',
        'post_hint' =>
            "Skrivit ur gemennadenn evit kemenn embannadur ho podkast. War bajenn degemer ho podkast e vo diskouezet ar gemennadenn.",
        'message_placeholder' => 'Skrivit ho kemennadenn…',
        'submit' => 'Embann',
        'publication_date' => 'Deiziad an embann',
        'publication_method' => [
            'now' => 'Bremañ',
            'schedule' => 'Steuñviñ',
        ],
        'scheduled_publication_date' => 'Deiziad embannadur steuñvet',
        'scheduled_publication_date_hint' =>
            'Gallout a rit steuñviñ embannadur ar podkast en ur choaz un deiziad evit an embannadur. Dleout a ra ar vaezienn bezañ er furmad YYYY-MM-DD HH:mm',
        'submit_edit' => 'Kemmañ an embannadur',
        'cancel_publication' => 'Nullañ an embann',
        'message_warning' => 'N\'ho peus ket skrivet ur gemennadenn evit brudañ ho rann !',
        'message_warning_hint' => 'Ouzhpennañ ur gemennadenn a lakay muioc\'h a dud er jeu, ha diwar se e vo gwelet muioc\'h ho podkast.',
        'message_warning_submit' => 'Embann memestra',
    ],
    'publication_status_banner' => [
        'draft_mode' => 'mod brouilhed',
        'not_published' => 'N\'eo ket embannet ar podkast-mañ c\'hoazh.',
        'scheduled' => 'Ar podkast-mañ a vo embannet d\'an/d\'ar {publication_date}.',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Pa vo dilamet ar podkast e vo dilamet an holl rannoù, restroù media, kemennadennoù ha stadegoù liammet outañ. Ur wech dilamet, ne c'hell bezañ adtapet an traoù.",
        'understand' => 'Kompren a ran, c\'hoant am eus da zilemel ar podkast da vat',
        'submit' => 'Dilemel',
    ],
    'by' => 'Gant {publisher}',
    'season' => 'Koulzad {seasonNumber}',
    'list_of_episodes_year' => 'Rannoù {year} ({episodeCount})',
    'list_of_episodes_season' =>
        'Rannoù ar c\'houlzad {seasonNumber} ({episodeCount})',
    'no_episode' => 'N\'eus bet kavet rann ebet !',
    'follow' => 'Heuliañ',
    'followers' => '{numberOfFollowers, plural,
        one {# heulier·ez}
        two {# heulier·ez}
        other {# heulier·ez}
    }',
    'posts' => '{numberOfPosts, plural,
        one {# gemennadenn}
        two {# gemennadenn}
        few {# c\'hemennadenn}
        many {a gemennadennoù}
        other {# kemennadenn}
    }',
    'activity' => 'Oberiantiz',
    'episodes' => 'Rannoù',
    'sponsor' => 'Harpit ac\'hanomp',
    'funding_links' => 'Ereoù evit arc\'hantaouiñ {podcastTitle}',
    'find_on' => 'Kavit {podcastTitle} war',
    'listen_on' => 'Selaouit war',
];
