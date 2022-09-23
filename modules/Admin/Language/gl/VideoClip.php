<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'list' => [
        'title' => 'Recortes de vídeo',
        'status' => [
            'label' => 'Estado',
            'queued' => 'na cola',
            'queued_hint' => 'Agardando para procesar o vídeo.',
            'pending' => 'pendente',
            'pending_hint' => 'En breve será creado o vídeo.',
            'running' => 'en execución',
            'running_hint' => 'Estase creando o vídeo.',
            'failed' => 'fallou',
            'failed_hint' => 'Non se puido crear o vídeo: fallou o script.',
            'passed' => 'correcto',
            'passed_hint' => 'Creouse correctamente o vídeo!',
        ],
        'clip' => 'Recorte',
        'duration' => 'Duración da tarefa',
    ],
    'title' => 'Recorte de vídeo: {videoClipLabel}',
    'download_clip' => 'Descargar vídeo',
    'create' => 'Novo recorte de vídeo',
    'go_to_page' => 'Ir á páxina do vídeo',
    'retry' => 'Volver a intentar a xeración',
    'delete' => 'Eliminar recorte',
    'logs' => 'Rexistros da tarefa',
    'messages' => [
        'alreadyExistingError' => 'O recorte de vídeo que intentas crear xa existe!',
        'addToQueueSuccess' => 'Engadiuse o recorte de vídeo á cola, agardando a ser creado!',
        'deleteSuccess' => 'Eliminouse correctamente o recorte de vídeo!',
    ],
    'format' => [
        'landscape' => 'Horizontal',
        'portrait' => 'Vertical',
        'squared' => 'Cadrado',
    ],
    'form' => [
        'title' => 'Novo recorte de vídeo',
        'params_section_title' => 'Parámetros do vídeo',
        'clip_title' => 'Título do vídeo',
        'format' => [
            'label' => 'Elixe o formato',
            'landscape_hint' => 'Cunha razón 16:9, os vídeos horizontais quedan ben en PeerTube, Youtube e Vimeo.',
            'portrait_hint' => 'Cunha razón 9:16, os vídeos verticais lucen ben en TikTok, curtas de Youtube e historias de Instagram.',
            'squared_hint' => 'Cunha razón 1:1, os vídeos cadrados quedan ben en Mastodon, Facebook, Twitter e LinkedIn.',
        ],
        'theme' => 'Elixe un decorado',
        'start_time' => 'Comezar en',
        'duration' => 'Duración',
        'trim_start' => 'Axustar inicio',
        'trim_end' => 'Axustar final',
        'submit' => 'Crear recorte de vídeo',
    ],
    'requirements' => [
        'title' => 'Falta de requisitos',
        'missing' => 'Non cumpres certos requisitos. Comproba que engadiches tódolos elementos requeridos para poder crear un vídeo para este episodio!',
        'ffmpeg' => 'FFmpeg',
        'gd' => 'Graphics Draw (GD)',
        'freetype' => 'Biblioteca Freetype para GD',
        'transcript' => 'Ficheiro Transcript (.srt)',
    ],
];
