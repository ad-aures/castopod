<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'list' => [
        'title' => 'Video isečci',
        'status' => [
            'label' => 'Status',
            'queued' => 'čekanje',
            'queued_hint' => 'Video isečak čeka na obradu.',
            'pending' => 'na čekanju',
            'pending_hint' => 'Video isečak će uskoro biti napravljen.',
            'running' => 'u toku',
            'running_hint' => 'Video isečak se pravi.',
            'failed' => 'nije uspеlo',
            'failed_hint' => 'Pravljenje video isečka nije uspelo: greška u skripti.',
            'passed' => 'prošlo',
            'passed_hint' => 'Video isečak je uspešno napravljen!',
        ],
        'clip' => 'Isečak',
        'duration' => 'Trajanje posla',
    ],
    'title' => 'Video Isečak: {videoClipLabel}',
    'download_clip' => 'Preuzmi isečak',
    'create' => 'Novi video isečak',
    'go_to_page' => 'Idi na stranicu isečka',
    'retry' => 'Ponovo pokušaj da napraviš isečak',
    'delete' => 'Obriši isečak',
    'logs' => 'Katalog poslova',
    'messages' => [
        'alreadyExistingError' => 'Video isečak koji pokušavate da napravite već postoji!',
        'addToQueueSuccess' => 'Video isečak je dodat u katalog poslova, čeka da bude napravljen!',
        'deleteSuccess' => 'Video isečak je uspešno uklonjen!',
    ],
    'format' => [
        'landscape' => 'Položeno',
        'portrait' => 'Uspravno',
        'squared' => 'Kvadratno',
    ],
    'form' => [
        'title' => 'Novi video isečak',
        'params_section_title' => 'Parametri video isečka',
        'clip_title' => 'Naziv isečka',
        'format' => [
            'label' => 'Odaberite format',
            'landscape_hint' => 'U 16:9 formatu, položeni video klipovi su odlični za platforme kao što su PeerTube, YouTube i Vimeo.',
            'portrait_hint' => 'U 9:16 formatu, uspravni video isečci su odlični za TikTok, YouTube shorts i Instagram stories.',
            'squared_hint' => 'U 1:1 formatu, kvadratni video isečci su odlični za Mastodon, Facebook, Twitter i LinkedIn.',
        ],
        'theme' => 'Odaberite temu',
        'start_time' => 'Počni na',
        'duration' => 'Trajanje',
        'trim_start' => 'Početak isečka',
        'trim_end' => 'Kraj isečka',
        'submit' => 'Napravi video isečak',
    ],
    'requirements' => [
        'title' => 'Nedostaje polje',
        'missing' => 'Niste popunili sva polja. Potrudite se da ubacite sve što je potrebno kako bi ste napravili video za ovu epizodu!',
        'ffmpeg' => 'FFmpeg',
        'gd' => 'Graphics Draw (GD)',
        'freetype' => 'Freetype library for GD',
        'transcript' => 'Datoteka transkripta (.srt)',
    ],
];
