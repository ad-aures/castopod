<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'warning' =>
        'Ta procedura może potrwać długo.<br/>Ponieważ obecna wersja nie wyświetla żadnych informacji o postępie, nie zobaczysz niczego przed jej zakończeniem.<br/>W przypadku błędu timeout, zwiększ wartość `max_execution_time`.',
    'old_podcast_section_title' => 'Podcast do zaimportowania',
    'old_podcast_section_subtitle' =>
        'Upewnij się, że masz prawa do tego podcastu przed zaimportowaniem go. Kopiowanie i nadawanie podcastu bez odpowiednich praw jest piractwem i może podlegać karze.',
    'imported_feed_url' => 'Adres URL kanału',
    'imported_feed_url_hint' => 'Kanał musi być w formacie XML lub RSS.',
    'new_podcast_section_title' => 'Nowy podcast',
    'name' => 'Nazwa',
    'name_hint' => 'Wykorzystywana do generowania adresu URL podcastu.',
    'advanced_params_section_title' => 'Zaawansowane parametry',
    'advanced_params_section_subtitle' =>
        'Pozostaw domyślne wartości, jeżeli nie wiesz do czego służą te pola.',
    'slug_field' => [
        'label' => 'Które pole powinno być wykorzystane do wygenerowania sluga odcinku',
        'link' => '&lt;link&gt;',
        'title' => '&lt;title&gt;',
    ],
    'description_field' =>
        'Pole źródła wykorzysytwane dla opisu odcinka/wyświetlanych notatek',
    'force_renumber' => 'Wymuś ponowne numerowanie odcinków podcastu',
    'force_renumber_hint' =>
        'Użyj tego, jeżeli podcast nie ma numeracji odcinków, ale chcesz ustawić je w trakcie importowania.',
    'season_number' => 'Numer sezonu',
    'season_number_hint' =>
        'Użyj tego, jeżeli podcast nie ma  numeracji sezonów, ale chcesz ustawić je w trakcie importowania. Jeżeli nie chcesz, pozostaw puste.',
    'max_episodes' => 'Maksymalna liczba odcinków do zaimportowania',
    'max_episodes_hint' => 'Pozostaw pustą, aby zaimportować wszystkie odcinki',
    'lock_import' =>
        'Ten kanał jest zabezpieczony. Nie możesz go zaimportować. Jeżeli jesteś właścicielem, odblokuj go na platformie źródłowej.',
    'submit' => 'Importuj podcast',
];
