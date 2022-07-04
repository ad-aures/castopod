<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Ustawienia ogólne',
    'instance' => [
        'title' => 'Instancja',
        'site_icon' => 'Ikona witryny',
        'site_icon_delete' => 'Usuń ikonę witryny',
        'site_icon_hint' => 'Ikony witryny są widoczne na kartach przeglądarki, paskach zakładek oraz po dodaniu witryny jako skrótu na urządzeniach mobilnych.',
        'site_icon_helper' => 'Icon must be squared and at least 512px wide and tall.',
        'site_name' => 'Nazwa strony',
        'site_description' => 'Opis strony',
        'submit' => 'Zapisz',
        'editSuccess' => 'Instancja została pomyślnie zaktualizowana!',
        'deleteIconSuccess' => 'Ikona witryny została pomyślnie usunięta!',
    ],
    'images' => [
        'title' => 'Obrazy',
        'subtitle' => 'Tutaj możesz ponownie wygenerować wszystkie obrazy na podstawie przesłanych oryginałów. Do wykorzystania, jeśli okaże się, że brakuje niektórych obrazów. To zadanie może chwilę potrwać.',
        'regenerate' => 'Wygeneruj ponownie obrazy',
        'regenerationSuccess' => 'Wszystkie obrazy zostały pomyślnie wygenerowane ponownie!',
    ],
    'housekeeping' => [
        'title' => 'Porządkowanie',
        'subtitle' => 'Wykonuje różne zadania porządkowe. Użyj tej funkcji jeśli kiedykolwiek napotkasz problemy z plikami multimedialnymi lub integralnością danych. Te zadania mogą chwilę potrwać.',
        'reset_counts' => 'Zresetuj liczniki',
        'reset_counts_helper' => 'Ta opcja zresetuje i ponownie obliczy wszystkie liczniki danych (liczbę obserwujących, wpisów, komentarzy, …).',
        'rewrite_media' => 'Przepisz metadane multimediów',
        'rewrite_media_helper' => 'Ta opcja usunie wszystkie zbędne pliki multimedialne i odtworzy je (obrazy, pliki audio, transkrypcje, rozdziały, …)',
        'clear_cache' => 'Wyczyść całą pamięć podręczną',
        'clear_cache_helper' => 'Ta opcja opróżni pamięć podręczną (cache) redis lub zapisywalne/buforowane pliki.',
        'run' => 'Przeprowadź porządkowanie',
        'runSuccess' => 'Porządkowanie zostało przeprowadzone pomyślnie!',
    ],
    'theme' => [
        'title' => 'Motyw',
        'accent_section_title' => 'Kolor akcentu',
        'accent_section_subtitle' => 'Wybierz kolor, aby określić wygląd i styl wszystkich stron publicznych.',
        'pine' => 'Sosna',
        'crimson' => 'Karmazynowy',
        'amber' => 'bursztynowy',
        'lake' => 'Jezioro',
        'jacaranda' => 'Jacaranda',
        'onyx' => 'Onyks',
        'submit' => 'Zapisz',
        'setInstanceThemeSuccess' => 'Motyw został pomyślnie zaktualizowany!',
    ],
];
