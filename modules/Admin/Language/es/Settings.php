<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Configuración General',
    'instance' => [
        'title' => 'Instancia',
        'site_icon' => 'Icono del sitio',
        'site_icon_delete' => 'Borrar icono del sitio',
        'site_icon_hint' => 'Los iconos del sitio son lo que ves en las pestañas del navegador, la barra de marcadores y cuando agregas un sitio web como un acceso directo en los dispositivos móviles.',
        'site_icon_helper' => 'El icono debe ser cuadrado con al menos 512 px de ancho y alto.',
        'site_name' => 'Nombre del sitio',
        'site_description' => 'Descripción del sitio',
        'submit' => 'Guardar',
        'editSuccess' => 'La instancia ha sido actualizada correctamente!',
        'deleteIconSuccess' => '¡El icono del sitio se ha eliminado con éxito!',
    ],
    'images' => [
        'title' => 'Imágenes',
        'subtitle' => 'Aquí puede regenerar todas las imágenes basadas en los originales que fueron subidos. Para ser usado si encuentras que faltan algunas imágenes. Esta tarea puede llevar un tiempo.',
        'regenerate' => 'Regenerar imágenes',
        'regenerationSuccess' => '¡Todas las imágenes han sido regeneradas con éxito!',
    ],
    'housekeeping' => [
        'title' => 'Mantenimiento',
        'subtitle' => 'Ejecuta varias tareas de limpieza. Usa esta función si alguna vez encuentras problemas con los archivos multimedia o la integridad de datos. Estas tareas pueden tardar algún tiempo.',
        'reset_counts' => 'Reiniciar contadores',
        'reset_counts_helper' => 'Esta opción recalculará y restablecerá todos los conteos de datos (número de seguidores, publicaciones, comentarios, …).',
        'rewrite_media' => 'Reescribir metadatos de medios',
        'rewrite_media_helper' => 'Esta opción eliminará todos los archivos multimedia superfluos y los volverá a crear (imágenes, archivos de audio, transcripciones, capítulos, …)',
        'rename_episodes_files' => 'Renombrar archivos de audio del episodio',
        'rename_episodes_files_hint' => 'Esta opción renombrará todos los archivos de audio de episodios a una cadena aleatoria de caracteres. Usa esto si uno de tus episodios privados fue filtrado ya que esto lo ocultará efectivamente.',
        'clear_cache' => 'Borrar toda la caché',
        'clear_cache_helper' => 'Esta opción eliminará la caché de redis o archivos de escritura/caché.',
        'run' => 'Ejecutar tareas de mantenimiento',
        'runSuccess' => '¡El mantenimiento se ha realizado con éxito!',
    ],
    'theme' => [
        'title' => 'Tema',
        'accent_section_title' => 'Color de acento',
        'accent_section_subtitle' => 'Elija el color para determinar la apariencia de todas las páginas públicas.',
        'pine' => 'Pino',
        'crimson' => 'Carmesí',
        'amber' => 'Ámbar',
        'lake' => 'Lago',
        'jacaranda' => 'Jacaranda',
        'onyx' => 'Onyx',
        'submit' => 'Guardar',
        'setInstanceThemeSuccess' => '¡El tema se ha actualizado con éxito!',
    ],
];
