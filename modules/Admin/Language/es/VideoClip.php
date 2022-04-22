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
            'queued' => 'en cola',
            'queued_hint' => 'El clip está esperando ser procesado.',
            'pending' => 'pendiente',
            'pending_hint' => 'El clip se generará en breve.',
            'running' => 'ejecutándose',
            'running_hint' => 'El clip se está generando.',
            'failed' => 'sin éxito',
            'failed_hint' => 'No se pudo generar el clip: fallo del script.',
            'passed' => 'aprobado',
            'passed_hint' => '¡El clip se ha generado correctamente!',
        ],
        'clip' => 'Recorte',
        'duration' => 'Duración del trabajo',
    ],
    'title' => 'Recorte de vídeo: {videoClipLabel}',
    'download_clip' => 'Descargar recorte',
    'create' => 'Nuevo recorte de video',
    'go_to_page' => 'Ir a la página del recorte',
    'retry' => 'Reintentar la generación de recorte',
    'delete' => 'Borrar recorte',
    'logs' => 'Registros de trabajo',
    'messages' => [
        'alreadyExistingError' => 'El recorte de video que estás intentando crear ya existe!',
        'addToQueueSuccess' => 'El recorte de video ha sido añadido a la cola, ¡esperando ser creado!',
        'deleteSuccess' => 'El recorte de vídeo se ha eliminado con éxito!',
    ],
    'format' => [
        'landscape' => 'Horizontal',
        'portrait' => 'Vertical',
        'squared' => 'Cuadrado',
    ],
    'form' => [
        'title' => 'Nuevo recorte de video',
        'params_section_title' => 'Parámetros del recorte de video',
        'clip_title' => 'Titulo del recorte',
        'format' => [
            'label' => 'Elija un formato',
            'landscape_hint' => 'Con una relación de 16:9, videos horizontales son excelentes para PeerTube, Youtube y Vimeo.',
            'portrait_hint' => 'Con una relación de 9:16, los videos verticales son excelentes para TikTok, los cortos de Youtube y las historias de Instagram.',
            'squared_hint' => 'Con una relación 1:1, los videos cuadrados son excelentes para Mastodon, Facebook, Twitter y LinkedIn.',
        ],
        'theme' => 'Seleccionar un tema',
        'start_time' => 'Comenzar en',
        'duration' => 'Duración',
        'trim_start' => 'Recortar Inicio',
        'trim_end' => 'Recortar final',
        'submit' => 'Crear recorte de video',
    ],
    'requirements' => [
        'title' => 'Faltan requisitos',
        'missing' => 'Faltan requisitos. ¡Asegúrate de añadir todos los elementos necesarios para que se les permita crear un vídeo para este episodio!',
        'ffmpeg' => 'FFmpeg',
        'gd' => 'Dibujo de Gráficos (GD)',
        'freetype' => 'Librería Freetype para GD',
        'transcript' => 'Archivo de transcripción (.srt)',
    ],
];
