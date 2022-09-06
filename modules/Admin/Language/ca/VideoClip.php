<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'list' => [
        'title' => 'Vídeoclips',
        'status' => [
            'label' => 'Estat',
            'queued' => 'en cua',
            'queued_hint' => 'El clip està esperant a ser processat.',
            'pending' => 'pendent',
            'pending_hint' => 'El clip es generarà aviat.',
            'running' => 'en execució',
            'running_hint' => 'S\'està generant el clip.',
            'failed' => 'ha fallat',
            'failed_hint' => 'No s\'ha pogut generar el clip: error de l\'script.',
            'passed' => 'passat',
            'passed_hint' => 'El clip s\'ha generat correctament.',
        ],
        'clip' => 'Clip',
        'duration' => 'Duració de la tasca',
    ],
    'title' => 'Videoclip: {videoClipLabel}',
    'download_clip' => 'Baixar el clip',
    'create' => 'Nou videoclip',
    'go_to_page' => 'Anar a la pàgina del clip ',
    'retry' => 'Intentar de nou la generació del clip',
    'delete' => 'Eliminar el clip',
    'logs' => 'Registres de la tasca',
    'messages' => [
        'alreadyExistingError' => 'El videoclip que intenteu crear ja existeix!',
        'addToQueueSuccess' => 'El videoclip s\'ha afegit a la cua, a l\'espera de ser creat!',
        'deleteSuccess' => 'El videoclip s\'ha eliminat correctament.',
    ],
    'format' => [
        'landscape' => 'Horitzontal',
        'portrait' => 'Vertical',
        'squared' => 'Quadrat',
    ],
    'form' => [
        'title' => 'Nou videoclip',
        'params_section_title' => 'Paràmetres del videoclip',
        'clip_title' => 'Títol del videoclip',
        'format' => [
            'label' => 'Trieu el format',
            'landscape_hint' => 'Amb una proporció de 16:9, els vídeos horitzontals són ideals per a PeerTube, Youtube i Vimeo.',
            'portrait_hint' => 'Amb una proporció de 9:16, els vídeos verticals són ideals per a TikTok, curts de Youtube i històries d\'Instagram.',
            'squared_hint' => 'Amb una proporció 1:1, els vídeos quadrats són ideals per a Mastodon, Facebook, Twitter i LinkedIn.',
        ],
        'theme' => 'Trieu un tema',
        'start_time' => 'Començar a',
        'duration' => 'Durada',
        'trim_start' => 'Retallar l\'inici',
        'trim_end' => 'Retallar el final',
        'submit' => 'Crear videoclip',
    ],
    'requirements' => [
        'title' => 'Falten requisits',
        'missing' => 'Et falten requisits. Assegureu-vos d\'afegir tots els elements necessaris per poder crear un vídeo per a aquest episodi.',
        'ffmpeg' => 'FFmpeg',
        'gd' => 'Graphics Draw (GD)',
        'freetype' => 'Llibreria `FreeType` per a GD',
        'transcript' => 'Fitxer de la transcripció (.srt)',
    ],
];
