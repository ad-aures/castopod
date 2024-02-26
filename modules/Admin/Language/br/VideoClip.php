<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'list' => [
        'title' => 'Klipoù video',
        'status' => [
            'label' => 'Statud',
            'queued' => 'el lost',
            'queued_hint' => 'Emañ ar c\'hlip video el lost.',
            'pending' => 'o c\'hortoz',
            'pending_hint' => 'Ganet e vo ar c\'hlip a-benn nebeut.',
            'running' => 'war ar stern',
            'running_hint' => 'Emañ ar c\'hlip o vezañ ganet.',
            'failed' => 'c\'hwitet',
            'failed_hint' => 'Ar c\'hlip n\'eo ket bet ganet: fazi skript.',
            'passed' => 'berzh',
            'passed_hint' => 'Ganet eo bet ar c\'hlip gant berzh!',
        ],
        'clip' => 'Klip',
        'duration' => 'Padelezh al labour',
    ],
    'title' => 'Klip video: {videoClipLabel}',
    'download_clip' => 'Pellgargañ ar c\'hlip',
    'create' => 'Klip video nevez',
    'go_to_page' => 'Mont da pajenn ar c\'hlip',
    'retry' => 'Klask genel ar c\'hlip en-dro',
    'delete' => 'Dilemel ar c\'hlip',
    'logs' => 'Roll istor al labourioù',
    'messages' => [
        'alreadyExistingError' => 'Bez ez eus eus ur c\'hlip video heñvel-mik dija!',
        'addToQueueSuccess' => 'Ouzhpennet eo bet ar c\'hlip video d\'al lost, o c\'hortoz e vefe krouet!',
        'deleteSuccess' => 'Dilamet eo bet ar c\'hlip video gant berzh!',
    ],
    'format' => [
        'landscape' => 'A-led',
        'portrait' => 'A-blom',
        'squared' => 'Karrezek',
    ],
    'form' => [
        'title' => 'Klip video nevez',
        'params_section_title' => 'Arventennoù ar c\'hlip video',
        'clip_title' => 'Titl ar c\'hlip',
        'format' => [
            'label' => 'Choazit ur furmad',
            'landscape_hint' => 'Videoioù a-led gant ur ratio 16:9 a zo dispar evit PeerTube, Youtube ha Vimeo.',
            'portrait_hint' => 'Videoioù a-blom gant ur ratio 9:16 a zo dispar evit TikTok, Youtube shorts ha stories Instagram.',
            'squared_hint' => 'Videoioù karrezek gant ur ratio 1:1 a zo dispar evit Mastodon, Facebook, Twitter ha LinkedIn.',
        ],
        'theme' => 'Dibab un neuz',
        'start_time' => 'Kregiñ da',
        'duration' => 'Padelezh',
        'trim_start' => 'Krennañ ar penn-kentañ',
        'trim_end' => 'Krennañ an dibenn',
        'submit' => 'Krouiñ ur c\'hlip video',
    ],
    'requirements' => [
        'title' => 'Mankout a ra binvioù',
        'missing' => 'Mankout a ra ostilhoù. Bezit sur eo bet ouzhpennet an holl vinvioù ez ezhomm anezho evit bezañ gouest da sevel ur video diwar ar rann-mañ!',
        'ffmpeg' => 'FFmpeg',
        'gd' => 'Graphics Draw (GD)',
        'freetype' => 'Levraoueg Freetype evit GD',
        'transcript' => 'Restr an treuzskrivadur (.srt)',
    ],
];
