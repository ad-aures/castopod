<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'banner' => [
        'disclaimer' => 'Importowanie',
        'text' => '{podcastTitle} jest obecnie importowany.',
        'cta' => 'Zobacz status importu',
    ],
    'old_podcast_section_title' => 'Podcast do zaimportowania',
    'old_podcast_legal_disclaimer_title' => 'Zastrzeżenie prawne',
    'old_podcast_legal_disclaimer' =>
        'Upewnij się, że masz prawa do tego podcastu zanim go zaimportujesz. Kopiowanie i nadawanie podcastu bez odpowiednich praw jest piractwem i podlega ściganiu.',
    'imported_feed_url' => 'Adres URL kanału',
    'imported_feed_url_hint' => 'Kanał musi być w formacie xml lub rss.',
    'new_podcast_section_title' => 'Nowy podcast',
    'lock_import' =>
        'Ten kanał jest chroniony. Nie możesz go zaimportować. Jeśli jesteś jego właścicielem — usuń ochronę na platformie, z której pochodzi.',
    'submit' => 'Dodaj import do kolejki',
    'queue' => [
        'status' => [
            'label' => 'Status',
            'queued' => 'w kolejce',
            'queued_hint' => 'Import czeka na przetworzenie.',
            'canceled' => 'anulowano',
            'canceled_hint' => 'Zadanie importu zostało anulowane.',
            'running' => 'w toku',
            'running_hint' => 'Import jest przetwarzany.',
            'failed' => 'niepowodzenie',
            'failed_hint' => 'Zadanie importu nie powiodło się: błąd skryptu.',
            'passed' => 'powodzenie',
            'passed_hint' => 'Zadanie importu zostało zakończone pomyślnie!',
        ],
        'feed' => 'Kanał',
        'duration' => 'Czas trwania importu',
        'imported_episodes' => 'Zaimportowane odcinki',
        'imported_episodes_hint' => '{newlyImportedCount} nowoimportowanych, {alreadyImportedCount} już zaimportowanych.',
        'actions' => [
            'cancel' => 'Anuluj',
            'retry' => 'Ponów',
            'delete' => 'Usuń',
        ],
    ],
    'syncForm' => [
        'title' => 'Synchronizuj kanały',
        'feed_url' => 'Adres URL kanału',
        'feed_url_hint' => 'URL kanału, który chcesz zsynchronizować z bieżącym podcastem.',
        'submit' => 'Dodaj do kolejki',
    ],
    'messages' => [
        'canceled' => 'Zadanie importu zostało pomyślnie anulowane!',
        'notRunning' => 'Nie można anulować importu, ponieważ nie jest on uruchomiony.',
        'alreadyRunning' => 'Zadanie importu jest już uruchomione. Możesz je anulować przed ponowną próbą.',
        'retried' => 'Zadanie importu zostało umieszczone w kolejce, zostanie ono wkrótce ponowione!',
        'deleted' => 'Zadanie importu zostało pomyślnie usunięte!',
        'importTaskQueued' => 'Nowe zadanie zostało dodane, import rozpocznie się wkrótce!',
        'syncTaskQueued' => 'Nowe zadanie importu zostało dodane, synchronizacja rozpocznie się wkrótce!',
    ],
];
