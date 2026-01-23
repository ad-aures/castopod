<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'list' => [
        'title' => 'Vaizdo klipai',
        'status' => [
            'label' => 'Būsena',
            'queued' => 'eilėje',
            'queued_hint' => 'Klipas laukia apdorojimo.',
            'pending' => 'laukiama',
            'pending_hint' => 'Klipas bus sugeneruotas netrukus.',
            'running' => 'rengiamas',
            'running_hint' => 'Klipas šiuo metu generuojamas.',
            'failed' => 'nepavyko',
            'failed_hint' => 'Klipo sugeneruoti nepavyko: scenarijaus klaida.',
            'passed' => 'parengtas',
            'passed_hint' => 'Klipas sėkmingai sugeneruotas!',
        ],
        'clip' => 'Klipas',
        'duration' => 'Užduoties vykdymo trukmė',
    ],
    'title' => 'Vaizdo klipas: {videoClipLabel}',
    'download_clip' => 'Atsisiųsti klipą',
    'create' => 'Naujas vaizdo klipas',
    'go_to_page' => 'Eiti į klipo tinklalapį',
    'retry' => 'Kartoti generavimo bandymą',
    'delete' => 'Šalinti klipą',
    'logs' => 'Užduočių žurnalai',
    'messages' => [
        'alreadyExistingError' => 'Bandomas sukurti vaizdo klipas jau egzistuoja!',
        'addToQueueSuccess' => 'Vaizdo klipo parengimo užduotis patalpinta į eilę!',
        'deleteSuccess' => 'Vaizdo klipas sėkmingai pašalintas!',
    ],
    'format' => [
        'landscape' => 'Gulsčias',
        'portrait' => 'Stačias',
        'squared' => 'Kvadratinis',
    ],
    'form' => [
        'title' => 'Naujas vaizdo klipas',
        'params_section_title' => 'Vaizdo klipo parametrai',
        'clip_title' => 'Klipo pavadinimas',
        'format' => [
            'label' => 'Pasirinkite formatą',
            'landscape_hint' => 'Klipai, kurių kraštinių santykis 16:9, puikiai tinka kėlimui į „PeerTube“, „Youtube“ ir „Vimeo“.',
            'portrait_hint' => 'Klipai, kurių kraštinių santykis 9:16, puikiai tinka kėlimui į „TikTok“, „Youtube shorts“ ir „Instagram stories“.',
            'squared_hint' => 'Klipai, kurių kraštinių santykis 1:1, puikiai tinka kėlimui į „Mastodon“, „Facebook“, „Twitter“ ir „LinkedIn“.',
        ],
        'theme' => 'Pasirinkite temą',
        'start_time' => 'Pradžia',
        'duration' => 'Trukmė',
        'trim_start' => 'Nukirpti pradžią',
        'trim_end' => 'Nukirpti pabaigą',
        'submit' => 'Kurti vaizdo klipą',
    ],
    'requirements' => [
        'title' => 'Netenkinami reikalavimai',
        'missing' => 'Trūksta įdiegtų priklausomybių. Įsitikinkite, jog įdiegta visa programinė įranga, būtina šio epizodo vaizdo įrašui parengti!',
        'ffmpeg' => 'FFmpeg',
        'gd' => 'Graphics Draw (GD)',
        'freetype' => 'GD „Freetype“ biblioteka',
        'transcript' => 'Nuorašo failas (.srt)',
    ],
];
