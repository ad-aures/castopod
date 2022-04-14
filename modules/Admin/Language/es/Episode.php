<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Temporada {seasonNumber}',
    'season_abbr' => 'T{seasonNumber}',
    'number' => 'Episodio {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Temporada {seasonNumber} episodio {episodeNumber}',
    'season_episode_abbr' => 'T{seasonNumber}E{episodeNumber}',
    'number_of_comments' => '{numberOfComments, plural,
        one {# comentario}
        other {# comentarios}
    }',
    'all_podcast_episodes' => 'Todos los episodios del podcast',
    'back_to_podcast' => 'Regresar al podcast',
    'edit' => 'Editar',
    'publish' => 'Publicar',
    'publish_edit' => 'Editar publicación',
    'unpublish' => 'Anular publicación',
    'publish_error' => 'El episodio ya está publicado.',
    'publish_edit_error' => 'El episodio ya está publicado.',
    'publish_cancel_error' => 'El episodio ya está publicado.',
    'unpublish_error' => 'El episodio no está publicado.',
    'delete' => 'Borrar',
    'go_to_page' => 'Ir a la página',
    'create' => 'Añadir un episodio',
    'publication_status' => [
        'published' => 'Publicado',
        'scheduled' => 'Programado',
        'not_published' => 'No publicado',
    ],
    'list' => [
        'episode' => 'Episodio',
        'visibility' => 'Visibilidad',
        'comments' => 'Comentarios',
        'actions' => 'Acciones',
    ],
    'messages' => [
        'createSuccess' => '¡El episodio ha sido creado correctamente!',
        'editSuccess' => '¡El episodio ha sido actualizado correctamente!',
        'publishCancelSuccess' => '¡La publicación del episodio ha sido cancelada correctamente!',
    ],
    'form' => [
        'file_size_error' =>
            '¡El tamaño de tu archivo es demasiado grande! El tamaño máximo es {0}. Aumenta los valores de `memory_limit`, `upload_max_filesize` y `post_max_size` en tu archivo de configuración php y reinicia tu servidor web para subir tu archivo.',
        'audio_file' => 'Archivo de audio',
        'audio_file_hint' => 'Choose an .mp3 or .m4a audio file.',
        'info_section_title' => 'Información de episodio',
        'cover' => 'Episode cover',
        'cover_hint' =>
            'If you do not set a cover, the podcast cover will be used instead.',
        'cover_size_hint' => 'Cover must be squared with at least 1400px wide and tall.',
        'title' => 'Título',
        'title_hint' =>
            'Should contain a clear and concise episode name. Do not specify the episode or season numbers here.',
        'permalink' => 'Enlace permanente',
        'season_number' => 'Temporada',
        'episode_number' => 'Episodio',
        'type' => [
            'label' => 'Tipo',
            'full' => 'Completo',
            'full_hint' => 'Contenido completo (el episodio)',
            'trailer' => 'Avance',
            'trailer_hint' => 'Pequeña pieza promocional de contenido que representa una vista previa de la serie actual',
            'bonus' => 'Extra',
            'bonus_hint' => 'Contenido extra para la serie (por ejemplo, detrás de escenas o entrevistas con el elenco) o contenido promocional para otra serie',
        ],
        'parental_advisory' => [
            'label' => 'Aviso parental',
            'hint' => '¿El episodio contiene contenido explícito?',
            'undefined' => 'indefinido',
            'clean' => 'Limpio',
            'explicit' => 'Explícito',
        ],
        'show_notes_section_title' => 'Mostrar notas',
        'show_notes_section_subtitle' =>
            'Hasta 4000 caracteres, sea claro y conciso. Muestre notas que ayudan a los potenciales oyentes a encontrar el episodio.',
        'description' => 'Descripción',
        'description_footer' => 'Descripción al pie',
        'description_footer_hint' =>
            'Este texto se añade al final de cada descripción de episodios, es un buen lugar para introducir sus enlaces sociales, por ejemplo.',
        'additional_files_section_title' => 'Archivos adicionales',
        'additional_files_section_subtitle' =>
            'Estos archivos pueden ser usados por otras plataformas para proporcionar una mejor experiencia a tu audiencia.<br />Ver el {podcastNamespaceLink} para más información.',
        'location_section_title' => 'Ubicación',
        'location_section_subtitle' => '¿De qué lugar trata este episodio?',
        'location_name' => 'Nombre o dirección de ubicación',
        'location_name_hint' => 'Esta puede ser una ubicación real o ficticia',
        'transcript' => 'Transcripción (subtítulos / subtítulos ocultos)',
        'transcript_hint' => 'Sólo se permiten .srt.',
        'transcript_download' => 'Descargar transcripción',
        'transcript_file' => 'Archivo de transcripción (.srt)',
        'transcript_remote_url' => 'Url remota para transcripción',
        'transcript_file_delete' => 'Eliminar archivo de transcripción',
        'chapters' => 'Capítulos',
        'chapters_hint' => 'El archivo debe estar en formato Capítulos JSON.',
        'chapters_download' => 'Descargar capítulos',
        'chapters_file' => 'Archivo de capítulos',
        'chapters_remote_url' => 'Url remota para el archivo de capítulos',
        'chapters_file_delete' => 'Eliminar archivo de capítulos',
        'advanced_section_title' => 'Parámetros Avanzados',
        'advanced_section_subtitle' =>
            'Si necesita etiquetas RSS que Castopod no maneja, póngalas aquí.',
        'custom_rss' => 'Etiquetas RSS personalizadas para el episodio',
        'custom_rss_hint' => 'Esto se inyectará dentro de la etiqueta del {item}.',
        'block' => 'El episodio debe estar oculto para todas las plataformas',
        'block_hint' =>
            'Mostrar u ocultar el episodio. Si quieres que este episodio se elimine del directorio de Apple, active esto.',
        'submit_create' => 'Crear episodio',
        'submit_edit' => 'Guardar episodio',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Volver al panel del episodio',
        'post' => 'Tu post de anuncio',
        'post_hint' =>
            "Write a message to announce the publication of your episode. The message will be broadcasted to all your followers in the fediverse and be featured in your podcast's homepage.",
        'message_placeholder' => 'Write your message…',
        'publication_date' => 'Fecha de publicación',
        'publication_method' => [
            'now' => 'Ahora',
            'schedule' => 'Schedule',
        ],
        'scheduled_publication_date' => 'Scheduled publication date',
        'scheduled_publication_date_clear' => 'Clear publication date',
        'scheduled_publication_date_hint' =>
            'You can schedule the episode release by setting a future publication date. This field must be formatted as YYYY-MM-DD HH:mm',
        'submit' => 'Publicar',
        'submit_edit' => 'Editar publicación',
        'cancel_publication' => 'Cancelar publicación',
        'message_warning' => 'You did not write a message for your announcement post!',
        'message_warning_hint' => 'Having a message increases social engagement, resulting in a better visibility for your episode.',
        'message_warning_submit' => 'Publicar de todos modos',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Unpublishing the episode will delete all the posts associated with it and remove it from the podcast's RSS feed.",
        'understand' => 'Lo entiendo, quiero anular la publicación del episodio',
        'submit' => 'Anular publicación',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Deleting the episode will delete all the posts associated with it and remove it from the podcast's RSS feed.",
        'understand' => 'I understand, I want to delete the episode',
        'submit' => 'Borrar',
    ],
    'embed' => [
        'title' => 'Embeddable player',
        'label' =>
            'Pick a theme color, copy the embeddable player to clipboard, then paste it on your website.',
        'clipboard_iframe' => 'Copy embeddable player to clipboard',
        'clipboard_url' => 'Copiar dirección al portapapeles',
        'dark' => 'Oscuro',
        'dark-transparent' => 'Dark transparent',
        'light' => 'Claro',
        'light-transparent' => 'Light transparent',
    ],
];
