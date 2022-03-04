<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'warning' =>
        'Ta procedura może zająć dużo czasu.<br/>Ponieważ bieżąca wersja nie pokazuje żadnego postępu podczas działania, nie zobaczysz żadnych aktualizacji dopóki nie zostanie wykonana.<br/>W przypadku błędu przekroczenia limitu czasu, zwiększ wartość `max_execution_time`.',
    'old_podcast_section_title' => 'Podcast do zaimportowania',
    'old_podcast_section_subtitle' =>
        'Upewnij się, że masz prawa do tego podcastu zanim go zaimportujesz. Kopiowanie i nadawanie podcastu bez odpowiednich praw jest piractwem i podlega ściganiu.',
    'imported_feed_url' => 'Adres URL kanału',
    'imported_feed_url_hint' => 'Kanał musi być w formacie xml lub rss.',
    'new_podcast_section_title' => 'Nowy podcast',
    'advanced_params_section_title' => 'Parametry zaawansowane',
    'advanced_params_section_subtitle' =>
        'Zachowaj wartości domyślne jeśli nie masz pojęcia, do czego służą te pola.',
    'slug_field' => 'Pole używane do obliczenia slugu odcinka',
    'description_field' =>
        'Pole źródłowe używane do opisu odcinka/notatek programu',
    'force_renumber' => 'Wymuś przenumerowanie odcinków',
    'force_renumber_hint' =>
        'Użyj tego, jeśli Twój podcast nie ma numerów odcinków, ale chcesz je ustawić podczas importu.',
    'season_number' => 'Numer sezonu',
    'season_number_hint' =>
        'Użyj tego, jeśli Twój podcast nie ma numeru sezonu, ale chcesz go ustawić podczas importu. W przeciwnym razie pozostaw pusty.',
    'max_episodes' => 'Maksymalna liczba odcinków do zaimportowania',
    'max_episodes_hint' => 'Pozostaw puste, aby zaimportować wszystkie odcinki',
    'lock_import' =>
        'Ten kanał jest chroniony. Nie możesz go zaimportować. Jeśli jesteś jego właścicielem - usuń ochronę na platformie, z której pochodzi.',
    'submit' => 'Importuj podcast',
];
