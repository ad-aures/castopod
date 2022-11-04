<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'list' => [
        'title' => 'Videoklipp',
        'status' => [
            'label' => 'Status',
            'queued' => 'köad',
            'queued_hint' => 'Klipp väntar på att bearbetas.',
            'pending' => 'väntande',
            'pending_hint' => 'Klipp kommer att genereras inom kort.',
            'running' => 'körs',
            'running_hint' => 'Klipp genereras.',
            'failed' => 'misslyckades',
            'failed_hint' => 'Klipp kunde inte genereras: skript misslyckades.',
            'passed' => 'godkänd',
            'passed_hint' => 'Klipp har skapats framgångsrikt!',
        ],
        'clip' => 'Klipp',
        'duration' => 'Varaktighet för jobb',
    ],
    'title' => 'Videoklipp: {videoClipLabel}',
    'download_clip' => 'Ladda ner klipp',
    'create' => 'Nytt videoklipp',
    'go_to_page' => 'Gå till klippsida',
    'retry' => 'Generering av nytt klipp',
    'delete' => 'Ta bort klipp',
    'logs' => 'Job logs',
    'messages' => [
        'alreadyExistingError' => 'Det videoklipp du försöker skapa finns redan!',
        'addToQueueSuccess' => 'Videoklipp har lagts till i kön, väntar på att skapas!',
        'deleteSuccess' => 'Videoklipp har tagits bort!',
    ],
    'format' => [
        'landscape' => 'Liggande',
        'portrait' => 'Stående',
        'squared' => 'Kvadrat',
    ],
    'form' => [
        'title' => 'Nytt videoklipp',
        'params_section_title' => 'Parametrar för videoklipp',
        'clip_title' => 'Klipp titel',
        'format' => [
            'label' => 'Välj ett format',
            'landscape_hint' => 'Med ett 16:9 förhållande, landskapsvideor är bra för PeerTube, Youtube och Vimeo.',
            'portrait_hint' => 'Med 9:16 förhållande, porträttfilmer är bra för TikTok, Youtube shorts och Instagram berättelser.',
            'squared_hint' => 'Med en 1:1 förhållande, fyrkantiga videor är bra för Mastodon, Facebook, Twitter och LinkedIn.',
        ],
        'theme' => 'Välj ett tema',
        'start_time' => 'Starta vid',
        'duration' => 'Längd',
        'trim_start' => 'Trimma start',
        'trim_end' => 'Trimma slut',
        'submit' => 'Skapa videoklipp',
    ],
    'requirements' => [
        'title' => 'Krav ej uppfyllda',
        'missing' => 'Du har saknade krav. Se till att lägga till alla nödvändiga objekt som tillåts att skapa en video för detta avsnitt!',
        'ffmpeg' => 'FFmpeg',
        'gd' => 'Grafik Rita (GD)',
        'freetype' => 'Freetyp bibliotek för GD',
        'transcript' => 'Avskrift fil (.srt)',
    ],
];
