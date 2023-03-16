<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Tempada {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Episodio {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Tempada {seasonNumber} episodio {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}E{episodeNumber}',
    'number_of_comments' => '{numberOfComments, plural,
        one {# comentario}
        other {# comentarios}
    }',
    'all_podcast_episodes' => 'Tódolos episodios do podcast',
    'back_to_podcast' => 'Volver ao podcast',
    'edit' => 'Editar',
    'publish' => 'Publicar',
    'publish_edit' => 'Editar publicación',
    'publish_date_edit' => 'Editar data de publicación',
    'unpublish' => 'Retirar publicación',
    'publish_error' => 'O episodio xa está publicado.',
    'publish_edit_error' => 'O episodio xa está publicado.',
    'publish_cancel_error' => 'O episodio xa está publicado.',
    'publish_date_edit_error' => 'O episodio aínda non se publicou, non podes editar a súa data de publicación.',
    'publish_date_edit_future_error' => 'A data de publicación do episodio só pode establecerse nun momento do pasado! Se queres reprogramalo, primeiro retira a súa publicación.',
    'publish_date_edit_success' => 'Actualizada correctamente a data de publicación do episodio!',
    'unpublish_error' => 'O episodio non foi publicado.',
    'delete' => 'Eliminar',
    'go_to_page' => 'Ir á páxina',
    'create' => 'Engadir un episodio',
    'publication_status' => [
        'published' => 'Publicado',
        'with_podcast' => 'Publicado',
        'scheduled' => 'Programado',
        'not_published' => 'Sen publicar',
    ],
    'with_podcast_hint' => 'Para ser publicado ao mesmo tempo que o podcast',
    'list' => [
        'search' => [
            'placeholder' => 'Buscar un episodio',
            'clear' => 'Limpar busca',
            'submit' => 'Buscar',
        ],
        'number_of_episodes' => '{numberOfEpisodes, plural,
            one {# episodio}
            other {# episodios}
        }',
        'episode' => 'Episodio',
        'visibility' => 'Visibilidade',
        'comments' => 'Comentarios',
        'actions' => 'Accións',
    ],
    'messages' => [
        'createSuccess' => 'Episodio creado correctamente!',
        'editSuccess' => 'Episodio actualizado correctamente!',
        'publishSuccess' => '{publication_status, select,
            published {Episodio publicado correctamente!}
            scheduled {Programación correcta para o episodio!}
            with_podcast {Este episodio vaise publicar ao mesmo tempo que o podcast.}
            other {Este episodio non foi publicado.}
        }',
        'publishCancelSuccess' => 'Cancelouse correctamente a publicación do episodio!',
        'unpublishBeforeDeleteTip' => 'Tes que retirar a publicación do episodio antes de eliminalo.',
        'scheduleDateError' => 'Debes establecer a data de publicación!',
        'deletePublishedEpisodeError' => 'Retira a publicación do episodio antes de eliminalo.',
        'deleteSuccess' => 'Episodio eliminado correctamente!',
        'deleteError' => 'Fallou a eliminación {type, select,
            transcript {da transcrición}
            chapters {dos capítulos}
            image {da imaxe}
            audio {do audio}
            other {do multimedia}
        } do episodio.',
        'deleteFileError' => 'Fallou a eliminación do ficheiro {type, select,
            transcript {da transcrición}
            chapters {dos capítulos}
            image {da imaxe}
            audio {do audio}
            other {do multimedia}
        } {file_key}. Deberías eliminala manualmente do disco.',
        'sameSlugError' => 'Xa existe un episodio co id de url elexido.',
    ],
    'form' => [
        'file_size_error' =>
            'O ficheiro é demasiado grande! O máximo é {0}. Aumenta os valores de `memory_limit`, `upload_max_filesize` e `post_max_size` no ficheiro de configuración php e reinicia o servidor web.',
        'audio_file' => 'Ficheiro de son',
        'audio_file_hint' => 'Elixe un ficheiro .mp3 ou un .m4a de audio.',
        'info_section_title' => 'Info do episodio',
        'cover' => 'Portada do episodio',
        'cover_hint' =>
            'Se non estableces unha portada usarase a portada do podcast no seu lugar.',
        'cover_size_hint' => 'A portada ten que ser cadrada e como mínimo de 1400px de alto e ancho.',
        'title' => 'Título',
        'title_hint' =>
            'Debe conter un nome de episodio claro e conciso. Non indiques aquí a tempada ou número de episodio.',
        'permalink' => 'Ligazón permanente',
        'season_number' => 'Tempada',
        'episode_number' => 'Episodio',
        'type' => [
            'label' => 'Tipo',
            'full' => 'Completo',
            'full_hint' => 'Contido completo (o episodio)',
            'trailer' => 'Avance',
            'trailer_hint' => 'Peza curta de carácter promocional que representa unha vista previa do programa actual',
            'bonus' => 'Extra',
            'bonus_hint' => 'Contido extra para o programa (por exemplo, info sobre a elaboración ou conversa casual cos participantes) ou contido promocional de outras creadoras',
        ],
        'premium_title' => 'Premium',
        'premium' => 'Episodio dispoñible só para subscricións premium',
        'parental_advisory' => [
            'label' => 'Aviso sobre o contido',
            'hint' => 'Contén o episodio elementos explícitos?',
            'undefined' => 'non definido',
            'clean' => 'Limpo',
            'explicit' => 'Explícito',
        ],
        'show_notes_section_title' => 'Mostrar notas',
        'show_notes_section_subtitle' =>
            'Ata 4000 caracteres, mantén a concisión e claridade. As notas do episodio axudan a que pontenciais oíntes atopen o programa.',
        'description' => 'Descrición',
        'description_footer' => 'Nota ao pé descritiva',
        'description_footer_hint' =>
            'Este texto engádese ao final da descrición de cada episodio, é un bo lugar para engadir por exemplo ligazóns a medios sociais.',
        'additional_files_section_title' => 'Ficheiros adicionais',
        'additional_files_section_subtitle' =>
            'Estos ficheiros poden ser usados por outras plataformas para proporcionar unha mellor experiencia para a túa audiencia. Mira {podcastNamespaceLink} para máis información.',
        'location_section_title' => 'Localización',
        'location_section_subtitle' => 'De qué lugar trata o episodio?',
        'location_name' => 'Nome da localización e enderezo',
        'location_name_hint' => 'Pode ser unha localización real ou ficticia',
        'transcript' => 'Transcrición (subtítulos / texto descritivo)',
        'transcript_hint' => 'Só admite .srt',
        'transcript_download' => 'Descargar transcrición',
        'transcript_file' => 'Fichero da transcrición (.srt)',
        'transcript_remote_url' => 'URL remoto da transcrición',
        'transcript_file_delete' => 'Eliminar ficheiro coa transcrición',
        'chapters' => 'Capítulos',
        'chapters_hint' => 'O ficheiro ten que estar no formato JSON de Capítulos.',
        'chapters_download' => 'Descargar capítulos',
        'chapters_file' => 'Ficheiro de capítulos',
        'chapters_remote_url' => 'URL remoto para ficheiro de capítulos',
        'chapters_file_delete' => 'Eliminar ficheiro de capítulos',
        'advanced_section_title' => 'Parámetros Avanzados',
        'advanced_section_subtitle' =>
            'Se precisas etiquetas RSS que Castopod non xestiona, establéceas aquí.',
        'custom_rss' => 'Etiquetas RSS personalizadas para o episodio',
        'custom_rss_hint' => 'Esto vai ir incluído na etiqueta ❬item❭.',
        'block' => 'O episodio estará oculto para os catálogos públicos',
        'block_hint' =>
            'O estado oculto ou visible: este control evita que o episodio apareza en Apple Podcasts, Google Podcasts, e calquera outra app de terceiros que obteña os programas destos directorios. (Non garantido)',
        'submit_create' => 'Crear episodio',
        'submit_edit' => 'Gardar episodio',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Volver ao taboleiro do episodio',
        'post' => 'Publicación co anuncio',
        'post_hint' =>
            "Escribe unha mensaxe para anunciar a publicación do episodio. Esta mensaxe será enviada a tódalas túas seguidoras no fediverso e aparecerá na páxina de inicio do teu podcast.",
        'message_placeholder' => 'Escribe a mensaxe…',
        'publication_date' => 'Data de publicación',
        'publication_method' => [
            'now' => 'Agora',
            'schedule' => 'Programar',
            'with_podcast' => 'Publicar xunto co podcast',
        ],
        'scheduled_publication_date' => 'Data da publicación programada',
        'scheduled_publication_date_clear' => 'Limpar data de publicación',
        'scheduled_publication_date_hint' =>
            'Podes programar nunha data futura a publicación do episodio. Este campo debe ter formato YYYY-MM-DD HH:mm',
        'submit' => 'Publicar',
        'submit_edit' => 'Editar publicación',
        'cancel_publication' => 'Cancelar publicación',
        'message_warning' => 'Non escribiches unha mensaxe anunciando a publicación!',
        'message_warning_hint' => 'Ao escribir unha mensaxe aumentas o alcance social, resultando en maior visibilidade para o teu episodio.',
        'message_warning_submit' => 'Publicar igualmente',
    ],
    'publish_date_edit_form' => [
        'new_publication_date' => 'Nova data de publicación',
        'new_publication_date_hint' => 'Ten que ser unha data do pasado.',
        'submit' => 'Editar data de publicación',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Retirando o episodio eliminarás tódolos comentarios e publicacións asociadas con el e tamén o eliminarás da fonte RSS do podcast.",
        'understand' => 'Enténdoo e quero retirar o episodio',
        'submit' => 'Retirar episodio',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Eliminando o episodio eliminarás tódolos ficheiros multimedia, comentarios, clips de vídeo e extractos de son asociados a el.",
        'understand' => 'Enténdoo e quero eliminar o episodio',
        'submit' => 'Eliminar',
    ],
    'embed' => [
        'title' => 'Reprodutor para incluír',
        'label' =>
            'Elixe a cor do decorado, copia o código para o reprodutor a incluir e pégao no teu sitio web.',
        'clipboard_iframe' => 'Copia o reprodutor ao portapapeis',
        'clipboard_url' => 'Copiar enderezo ao portapapeis',
        'dark' => 'Escuro',
        'dark-transparent' => 'Escuro transparente',
        'light' => 'Claro',
        'light-transparent' => 'Claro transparente',
    ],
];
