<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'list' => [
        'title' => 'Videoklypp',
        'status' => [
            'label' => 'Status',
            'queued' => 'i kø',
            'queued_hint' => 'Klyppet ventar på handsaming.',
            'pending' => 'ventar',
            'pending_hint' => 'Klyppet blir generert snart.',
            'running' => 'køyrer',
            'running_hint' => 'Klyppet blir generert.',
            'failed' => 'mislukka',
            'failed_hint' => 'Greidde ikkje laga klyppet: skriptfeil.',
            'passed' => 'utført',
            'passed_hint' => 'Klyppet vart laga!',
        ],
        'clip' => 'Klypp',
        'duration' => 'Jobbtid',
    ],
    'title' => 'Filmklypp: {videoClipLabel}',
    'download_clip' => 'Last ned klyppet',
    'create' => 'Nytt filmklypp',
    'go_to_page' => 'Gå til filmklyppsida',
    'retry' => 'Prøv å laga klyppet på nytt',
    'delete' => 'Slett klyppet',
    'logs' => 'Arbeidsloggar',
    'messages' => [
        'alreadyExistingError' => 'Filmen du prøver å laga finst frå før!',
        'addToQueueSuccess' => 'Filmklyppet er lagt i kø og ventar på å bli laga!',
        'deleteSuccess' => 'Filmklyppet er fjerna!',
    ],
    'format' => [
        'landscape' => 'Liggjande',
        'portrait' => 'Ståande',
        'squared' => 'Kvadratisk',
    ],
    'form' => [
        'title' => 'Nytt filmklypp',
        'params_section_title' => 'Innstillingar for filmklypp',
        'clip_title' => 'Namn på filmklyppet',
        'format' => [
            'label' => 'Vel format',
            'landscape_hint' => 'Filmar i liggjande 16:9-format er fine til Peertube, Youtube og Vimeo.',
            'portrait_hint' => 'Filmar i ståande 9:16-format er fine til Tiktok, korte Youtube-filmar og Instagram-historier.',
            'squared_hint' => 'Filmar i kvadratisk 1:1-format er fine til Mastodon, Facebook, Twitter og Linkedin.',
        ],
        'theme' => 'Vel bunad',
        'start_time' => 'Start på',
        'duration' => 'Lengd',
        'trim_start' => 'Skjer til starten',
        'trim_end' => 'Skjer til slutten',
        'submit' => 'Lag videoklypp',
    ],
    'requirements' => [
        'title' => 'Manglande krav',
        'missing' => 'Du har manglande krav. Pass på å leggja til alle dei påkravde elementa for å laga ein film til denne episoden!',
        'ffmpeg' => 'FFmpeg',
        'gd' => 'Graphics Draw (GD)',
        'freetype' => 'Freetype-bibliotek for GD',
        'transcript' => 'Transkriberingsfil (.srt)',
    ],
];
