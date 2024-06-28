<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'list' => [
        'title' => 'Klipy wideo',
        'status' => [
            'label' => 'Status',
            'queued' => 'w kolejce',
            'queued_hint' => 'Klip czeka na przetworzenie.',
            'pending' => 'oczekuje',
            'pending_hint' => 'Klip zostanie wkrótce wygenerowany.',
            'running' => 'w toku',
            'running_hint' => 'Klip jest generowany.',
            'failed' => 'niepowodzenie',
            'failed_hint' => 'Nie można było wygenerować klipu: błąd skryptu.',
            'passed' => 'powodzenie',
            'passed_hint' => 'Klip został pomyślnie wygenerowany!',
        ],
        'clip' => 'Klip',
        'duration' => 'Czas zadania',
    ],
    'title' => 'Klip wideo: {videoClipLabel}',
    'download_clip' => 'Pobierz klip',
    'create' => 'Nowy klip wideo',
    'go_to_page' => 'Idź do strony klipu',
    'retry' => 'Ponów generowanie klipu',
    'delete' => 'Usuń klip',
    'logs' => 'Dzienniki zadania',
    'messages' => [
        'alreadyExistingError' => 'Klip wideo, który próbujesz utworzyć, już istnieje!',
        'addToQueueSuccess' => 'Klip wideo został dodany do kolejki i oczekuje na utworzenie!',
        'deleteSuccess' => 'Klip wideo został pomyślnie usunięty!',
    ],
    'format' => [
        'landscape' => 'Poziomy',
        'portrait' => 'Pionowy',
        'squared' => 'Kwadratowy',
    ],
    'form' => [
        'title' => 'Nowy klip wideo',
        'params_section_title' => 'Parametry klipu wideo',
        'clip_title' => 'Tytuł klipu',
        'format' => [
            'label' => 'Wybierz format',
            'landscape_hint' => 'W proporcji 16:9, filmy w orientacji poziomej są świetne do PeerTube, Youtube i Vimeo.',
            'portrait_hint' => 'W proporcji 9:16, filmy pionowe świetnie nadają się do TikTok, krótkich filmów na YouTube i Stories na Instagramie.',
            'squared_hint' => 'W proporcji 1:1, kwadratowe filmy są świetne dla Mastodon, Facebooka, Twittera i LinkedIn.',
        ],
        'theme' => 'Wybierz motyw',
        'start_time' => 'Rozpocznij od',
        'duration' => 'Długość',
        'trim_start' => 'Przytnij początek',
        'trim_end' => 'Przytnij koniec',
        'submit' => 'Stwórz klip wideo',
    ],
    'requirements' => [
        'title' => 'Brakujące wymagania',
        'missing' => 'Brakuje wymaganych elementów. Upewnij się, że dodałeś wszystkie wymagane elementy, aby móc tworzyć wideo do tego odcinka!',
        'ffmpeg' => 'FFmpeg',
        'gd' => 'Graphics Draw (GD)',
        'freetype' => 'Biblioteka Freetype dla GD',
        'transcript' => 'Plik z transkrypcją (.srt)',
    ],
];
