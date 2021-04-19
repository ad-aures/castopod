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
        'Make sure you own the rights for this podcast before importing it. Copying and broadcasting a podcast without the proper rights is piracy and is liable to prosecution.',
    'imported_feed_url' => 'Adres URL kanału',
    'imported_feed_url_hint' => 'Kanał musi być w formacie XML lub RSS.',
    'new_podcast_section_title' => 'The new podcast',
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
        'Source field used for episode description / show notes',
    'force_renumber' => 'Wymuś ponowne numerowanie odcinków podcastu',
    'force_renumber_hint' =>
        'Use this if your podcast does not have episode numbers but wish to set them during import.',
    'season_number' => 'Numer sezonu',
    'season_number_hint' =>
        'Use this if your podcast does not have a season number but wish to set one during import. Leave blank otherwise.',
    'max_episodes' => 'Maksymalna liczba odcinków do zaimportowania',
    'max_episodes_hint' => 'Pozostaw pustą, aby zaimportować wszystkie odcinki',
    'lock_import' =>
        'This feed is protected. You cannot import it. If you are the owner, unprotect it on the origin platform.',
    'submit' => 'Importuj podcast',
];
