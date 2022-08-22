<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Season {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Episode {episodeNumber}',
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
    'unpublish' => 'Retirar publicación',
    'publish_error' => 'O episodio xa está publicado.',
    'publish_edit_error' => 'O episodio xa está publicado.',
    'publish_cancel_error' => 'O episodio xa está publicado.',
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
        } {file_path}. Deberías eliminala manualmente do disco.',
        'sameSlugError' => 'Xa existe un episodio co id de url elexido.',
    ],
    'form' => [
        'file_size_error' =>
            'Your file size is too big! Max size is {0}. Increase the `memory_limit`, `upload_max_filesize` and `post_max_size` values in your php configuration file then restart your web server to upload your file.',
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
        'custom_rss_hint' => 'This will be injected within the ❬item❭ tag.',
        'block' => 'Episode should be hidden from public catalogues',
        'block_hint' =>
            'The episode show or hide status: toggling this on prevents the episode from appearing in Apple Podcasts, Google Podcasts, and any third party apps that pull shows from these directories. (Not guaranteed)',
        'submit_create' => 'Create episode',
        'submit_edit' => 'Save episode',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Back to episode dashboard',
        'post' => 'Your announcement post',
        'post_hint' =>
            "Write a message to announce the publication of your episode. The message will be broadcasted to all your followers in the fediverse and be featured in your podcast's homepage.",
        'message_placeholder' => 'Write your message…',
        'publication_date' => 'Publication date',
        'publication_method' => [
            'now' => 'Now',
            'schedule' => 'Schedule',
            'with_podcast' => 'Publish alongside podcast',
        ],
        'scheduled_publication_date' => 'Scheduled publication date',
        'scheduled_publication_date_clear' => 'Clear publication date',
        'scheduled_publication_date_hint' =>
            'You can schedule the episode release by setting a future publication date. This field must be formatted as YYYY-MM-DD HH:mm',
        'submit' => 'Publish',
        'submit_edit' => 'Edit publication',
        'cancel_publication' => 'Cancel publication',
        'message_warning' => 'You did not write a message for your announcement post!',
        'message_warning_hint' => 'Having a message increases social engagement, resulting in a better visibility for your episode.',
        'message_warning_submit' => 'Publish anyways',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Unpublishing the episode will delete all the comments and posts associated with it and remove it from the podcast's RSS feed.",
        'understand' => 'I understand, I want to unpublish the episode',
        'submit' => 'Unpublish',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Deleting the episode will delete all media files, comments, video clips and soundbites associated with it.",
        'understand' => 'I understand, I want to delete the episode',
        'submit' => 'Delete',
    ],
    'embed' => [
        'title' => 'Embeddable player',
        'label' =>
            'Pick a theme color, copy the embeddable player to clipboard, then paste it on your website.',
        'clipboard_iframe' => 'Copy embeddable player to clipboard',
        'clipboard_url' => 'Copy address to clipboard',
        'dark' => 'Dark',
        'dark-transparent' => 'Dark transparent',
        'light' => 'Light',
        'light-transparent' => 'Light transparent',
    ],
];
