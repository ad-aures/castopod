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
        'with_podcast' => 'Published',
        'scheduled' => 'Programado',
        'not_published' => 'No publicado',
    ],
    'with_podcast_hint' => 'To be published at the same time as the podcast',
    'list' => [
        'search' => [
            'placeholder' => 'Search for an episode',
            'clear' => 'Clear search',
            'submit' => 'Search',
        ],
        'number_of_episodes' => '{numberOfEpisodes, plural,
            one {# episode}
            other {# episodes}
        }',
        'episode' => 'Episodio',
        'visibility' => 'Visibilidad',
        'comments' => 'Comentarios',
        'actions' => 'Acciones',
    ],
    'messages' => [
        'createSuccess' => '¡El episodio ha sido creado correctamente!',
        'editSuccess' => '¡El episodio ha sido actualizado correctamente!',
        'publishSuccess' => '{publication_status, select,
            published {Episode successfully published!}
            scheduled {Episode publication successfully scheduled!}
            with_podcast {This episode will be published at the same time as the podcast.}
            other {This episode is not published.}
        }',
        'publishCancelSuccess' => '¡La publicación del episodio ha sido cancelada correctamente!',
        'unpublishBeforeDeleteTip' => 'Debe anular la publicación del episodio antes de eliminarlo.',
        'scheduleDateError' => 'Schedule date must be set!',
        'deletePublishedEpisodeError' => 'Por favor, anule la publicación del episodio antes de eliminarlo.',
        'deleteSuccess' => '¡Episodio eliminado con éxito!',
        'deleteError' => 'Error al eliminar episodio {type, select,
            transcript {transcripción}
            chapters {capítulos}
            image {portada}
            audio {audio}
            other {media}
        }.',
        'deleteFileError' => 'Failed to delete {type, select,
            transcript {transcript}
            chapters {chapters}
            image {cover}
            audio {audio}
            other {media}
        } file {file_path}. You may manually remove it from your disk.',
        'sameSlugError' => 'Ya existe un episodio con el slug elegido.',
    ],
    'form' => [
        'file_size_error' =>
            '¡El tamaño de tu archivo es demasiado grande! El tamaño máximo es {0}. Aumenta los valores de `memory_limit`, `upload_max_filesize` y `post_max_size` en tu archivo de configuración php y reinicia tu servidor web para subir tu archivo.',
        'audio_file' => 'Archivo de audio',
        'audio_file_hint' => 'Elija un archivo de audio .mp3 o .m4a.',
        'info_section_title' => 'Información de episodio',
        'cover' => 'Portada del episodio',
        'cover_hint' =>
            'Si no establece una portada, la portada del podcast se utilizará en su lugar.',
        'cover_size_hint' => 'Cover must be squared and at least 1400px wide and tall.',
        'title' => 'Título',
        'title_hint' =>
            'Debe contener un nombre de episodio claro y conciso. No especifique los números de episodio o temporada aquí.',
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
            'Estos archivos pueden ser utilizados por otras plataformas para proporcionar una mejor experiencia a su audiencia. Vea {podcastNamespaceLink} para más información.',
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
        'block' => 'Episode should be hidden from public catalogues',
        'block_hint' =>
            'The episode show or hide status: toggling this on prevents the episode from appearing in Apple Podcasts, Google Podcasts, and any third party apps that pull shows from these directories. (Not guaranteed)',
        'submit_create' => 'Crear episodio',
        'submit_edit' => 'Guardar episodio',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Volver al panel del episodio',
        'post' => 'Tu post de anuncio',
        'post_hint' =>
            "Escribe un mensaje para anunciar la publicación de tu episodio. El mensaje será transmitido a todos tus seguidores en el fediverse y aparecerá en la página principal de tu podcast.",
        'message_placeholder' => 'Escribe tu mensaje…',
        'publication_date' => 'Fecha de publicación',
        'publication_method' => [
            'now' => 'Ahora',
            'schedule' => 'Programar',
            'with_podcast' => 'Publish alongside podcast',
        ],
        'scheduled_publication_date' => 'Fecha programada de publicación',
        'scheduled_publication_date_clear' => 'Borrar fecha de publicación',
        'scheduled_publication_date_hint' =>
            'Puede programar la versión de episodio estableciendo una fecha futura de publicación. Este campo debe ser formateado como YYYY-MM-DD HH:mm',
        'submit' => 'Publicar',
        'submit_edit' => 'Editar publicación',
        'cancel_publication' => 'Cancelar publicación',
        'message_warning' => 'No has escrito un mensaje para el anuncio tu publicación!',
        'message_warning_hint' => 'Tener un mensaje aumenta el alcance social, resultando en una mejor visibilidad para tu episodio.',
        'message_warning_submit' => 'Publicar de todos modos',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Al cancelar la publicación del episodio se eliminarán todos los mensajes asociados a él y se eliminarán del feed RSS del podcast.",
        'understand' => 'Lo entiendo, quiero anular la publicación del episodio',
        'submit' => 'Anular publicación',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Eliminar el episodio eliminará todos los archivos multimedia, comentarios, video clips y sonidos asociados a él.",
        'understand' => 'Entiendo, quiero eliminar el episodio',
        'submit' => 'Borrar',
    ],
    'embed' => [
        'title' => 'Reproductor embebido',
        'label' =>
            'Elige un color de tema, copia el reproductor incrustable al portapapeles y pégalo en tu sitio web.',
        'clipboard_iframe' => 'Copiar reproductor incrustable al portapapeles',
        'clipboard_url' => 'Copiar dirección al portapapeles',
        'dark' => 'Oscuro',
        'dark-transparent' => 'Transparente oscuro',
        'light' => 'Claro',
        'light-transparent' => 'Transparente claro',
    ],
];
