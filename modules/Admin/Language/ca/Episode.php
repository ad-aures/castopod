<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'season' => 'Temporada {seasonNumber}',
    'season_abbr' => 'S{seasonNumber}',
    'number' => 'Episodi {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Temporada {seasonNumber} episodi {episodeNumber}',
    'season_episode_abbr' => 'S{seasonNumber}E{episodeNumber}',
    'number_of_comments' => '{numberOfComments, plural,
        one {# comentari}
        other {# comentaris}
    }',
    'all_podcast_episodes' => 'Tots els episodis del podcast',
    'back_to_podcast' => 'Tornar al podcast',
    'edit' => 'Editar',
    'publish' => 'Publicar',
    'publish_edit' => 'Editar la publicació',
    'publish_date_edit' => 'Edita la data de publicació',
    'unpublish' => 'Desfer la publicació',
    'publish_error' => 'L\'episodi ja està publicat.',
    'publish_edit_error' => 'L\'episodi ja està publicat.',
    'publish_cancel_error' => 'L\'episodi ja està publicat.',
    'publish_date_edit_error' => 'L\'episodi encara no s\'ha publicat, no podeu editar-ne la data de publicació.',
    'publish_date_edit_future_error' => 'La data de publicació de l\'episodi només es pot establir en una data passada! Si voleu reprogramar-lo, cancel·leu-lo primer.',
    'publish_date_edit_success' => 'La data de publicació de l\'episodi ha estat actualitzada correctament!',
    'unpublish_error' => 'L\'episodi no està publicat.',
    'delete' => 'Eliminar',
    'go_to_page' => 'Anar a la pàgina ',
    'create' => 'Afegir un episodi',
    'publication_status' => [
        'published' => 'Publicat',
        'with_podcast' => 'Publicat',
        'scheduled' => 'Programat',
        'not_published' => 'No publicat',
    ],
    'with_podcast_hint' => 'Per ser publicat al mateix temps que el podcast',
    'list' => [
        'search' => [
            'placeholder' => 'Cerca d\'un episodi',
            'clear' => 'Netejar la cerca',
            'submit' => 'Cercar',
        ],
        'number_of_episodes' => '{numberOfEpisodes, plural,
            one {# episodi}
            other {# episodis}
        }',
        'episode' => 'Episodi',
        'visibility' => 'Visibilitat',
        'downloads' => 'Downloads',
        'comments' => 'Comentaris',
        'actions' => 'Accions',
    ],
    'messages' => [
        'createSuccess' => 'S\'ha creat l\'episodi correctament.',
        'editSuccess' => 'L\'episodi s\'ha actualitzat.',
        'publishSuccess' => '{publication_status, select,
            published {L\'episodi s\'ha creat correctament.}
            scheduled {S\'ha programat la publicació de l\'episodi.}
            with_podcast {Aquest episodi serà publicat al mateix temps que el podcast.}
            other {Aquest episodi no està publicat.}
        }',
        'publishCancelSuccess' => 'S\'ha cancel·lat la publicació de l\'episodi.',
        'unpublishBeforeDeleteTip' => 'Heu de desfer la publicació de l\'episodi abans d\'esborrar-lo.',
        'scheduleDateError' => 'S\'ha de definir una data de publicació!',
        'deletePublishedEpisodeError' => 'Heu de desfer la publicació de l\'episodi abans d\'esborrar-lo.',
        'deleteSuccess' => 'S\'ha esborrat l\'episodi.',
        'deleteError' => 'No s\'ha pogut esborrar {type, select,
            transcript {la transcripció}
            chapters {els capítols}
            image {la portada}
            audio {l\'àudio}
            other {el material}
        } de l\'episodi.',
        'deleteFileError' => 'No s\'ha pogut esborrar el fitxer {file_path} {type, select,
            transcript {de la transcripció}
            chapters {dels episodis}
            image {de la portada}
            audio {de l\'àudio}
            other {del material}
        }. Podeu esborrar-los manualment del disc.',
        'sameSlugError' => 'Ja existeix un episodi amb aquest àlies.',
    ],
    'form' => [
        'file_size_error' =>
            'El vostre fitxer és massa gran per ser pujat al servidor!  La mida màxima és {0}. Augmenteu els valors de `memory_limit`, `upload_max_filesize` i `post_max_size` al vostre fitxer de configuració php i després reinicieu el vostre servidor web per carregar el vostre fitxer.',
        'audio_file' => 'Fitxer d’àudio',
        'audio_file_hint' => 'Trieu un fitxer d\'àudio .mp3 o .m4a',
        'info_section_title' => 'Informació de l\'episodi',
        'cover' => 'Portada de l\'episodi',
        'cover_hint' =>
            'Si no configureu cap portada, s\'utilitzarà la portada del podcast.',
        'cover_size_hint' => 'La portada ha de ser quadrada i com a mínim de 1400 px d\'amplada i alçada.',
        'title' => 'Títol',
        'title_hint' =>
            'Hauria de contenir un nom de l\'episodi clar i concís. No especifiqueu aquí els números d\'episodi o temporada.',
        'permalink' => 'Enllaç permanent',
        'season_number' => 'Temporada ',
        'episode_number' => 'Episodi',
        'type' => [
            'label' => 'Tipus',
            'full' => 'Complet',
            'full_hint' => 'Contingut complet (l\'episodi)',
            'trailer' => 'Tràiler',
            'trailer_hint' => 'Contingut breu i promocional que presenta una vista prèvia d\'aquest programa',
            'bonus' => 'Bonificació',
            'bonus_hint' => 'Contingut addicional per al programa (per exemple, informació entre bastidors o entrevistes amb el repartiment) o contingut promocional creuat per a un altre programa',
        ],
        'premium_title' => 'Prèmium',
        'premium' => 'L\'episodi ha de ser accessible només per a subscriptors prèmium',
        'parental_advisory' => [
            'label' => 'Avís parental',
            'hint' => 'L\'episodi conté contingut explícit?',
            'undefined' => 'indefinit',
            'clean' => 'Net',
            'explicit' => 'Explícit',
        ],
        'show_notes_section_title' => 'Mostrar les notes',
        'show_notes_section_subtitle' =>
            'Fins a 4000 caràcters, sigueu clar i concís. Les notes del programa ajuden els oients potencials a trobar l\'episodi.',
        'description' => 'Descripció',
        'description_footer' => 'Al peu de la descripció',
        'description_footer_hint' =>
            'Aquest text s\'afegeix al final de la descripció de cada episodi, és un bon lloc per introduir els vostres enllaços socials, per exemple.',
        'additional_files_section_title' => 'Fitxers addicionals',
        'additional_files_section_subtitle' =>
            'Aquests fitxers poden ser utilitzats per altres plataformes per oferir una millor experiència al vostre públic. Consulteu el {podcastNamespaceLink} per obtenir més informació.',
        'location_section_title' => 'Ubicació',
        'location_section_subtitle' => 'De quin lloc tracta aquest episodi?',
        'location_name' => 'Nom i adreça de la ubicació',
        'location_name_hint' => 'Pot ser una ubicació real o fictícia',
        'transcript' => 'Transcripció (subtítols)',
        'transcript_hint' => 'Només es permet fitxers .srt',
        'transcript_download' => 'Baixar la transcripció',
        'transcript_file' => 'Fitxer de la transcripció (.srt)',
        'transcript_remote_url' => 'URL remota per a la transcripció',
        'transcript_file_delete' => 'Eliminar el fitxer de la transcripció',
        'chapters' => 'Capítols',
        'chapters_hint' => 'El fitxer ha de tenir el format de capítols JSON.',
        'chapters_download' => 'Baixar els capítols',
        'chapters_file' => 'Fitxer dels capítols',
        'chapters_remote_url' => 'URL remota del fitxer de capítols',
        'chapters_file_delete' => 'Eliminar el fitxer de capítols',
        'advanced_section_title' => 'Paràmetres avançats',
        'advanced_section_subtitle' =>
            'Si necessiteu etiquetes RSS que Castopod no manega, configureu-les aquí.',
        'custom_rss' => 'Etiquetes RSS personalitzades pel podcast',
        'custom_rss_hint' => 'Això s\'injectarà dins de l\'etiqueta ❬item❭.',
        'block' => 'L\'episodi s\'ha d\'amagar dels catàlegs públics',
        'block_hint' =>
            'L\'estat de visibilitat de l\'episodi: activar aquesta opció evita que l\'episodi aparegui a Apple Podcasts, Google Podcasts i qualsevol aplicació de tercers que extreu programes d\'aquests directoris. (No garantit)',
        'submit_create' => 'Crear un episodi',
        'submit_edit' => 'Desar l\'episodi',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Tornar al panell de control dels episodis',
        'post' => 'La vostra publicació d\'anunci',
        'post_hint' =>
            "Escriviu un missatge per anunciar la publicació del vostre episodi. El missatge s'emetrà a tots els vostres seguidors al Fediverse i apareixerà a la pàgina d'inici del vostre podcast.",
        'message_placeholder' => 'Escriviu un missatge...',
        'publication_date' => 'Data de publicació',
        'publication_method' => [
            'now' => 'Ara',
            'schedule' => 'Programar',
            'with_podcast' => 'Publicar juntament amb el podcast',
        ],
        'scheduled_publication_date' => 'Data de publicació programada',
        'scheduled_publication_date_clear' => 'Netejar la data de publicació',
        'scheduled_publication_date_hint' =>
            'Podeu programar el llançament de l\'episodi fixant una data de publicació futura. Aquest camp ha de tenir el format AAAA-MM-DD HH:mm',
        'submit' => 'Publicar',
        'submit_edit' => 'Editar la publicació',
        'cancel_publication' => 'Cancel·lar la publicació',
        'message_warning' => 'No heu escrit cap missatge per la publicació del vostre anunci!',
        'message_warning_hint' => 'Tenir un missatge augmenta la implicació social, donant lloc a una millor visibilitat del vostre episodi.',
        'message_warning_submit' => 'Publicar de totes maneres',
    ],
    'publish_date_edit_form' => [
        'new_publication_date' => 'Nova data de publicació',
        'new_publication_date_hint' => 'Has de posar una data passada.',
        'submit' => 'Edita la data de publicació',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Si desfeu la publicació de l'episodi, se suprimiran tots els comentaris i publicacions associades amb ell i s'eliminarà del fil RSS del podcast.",
        'understand' => 'Entenc, vull desfer la publicació de l\'episodi',
        'submit' => 'Desfer la publicació',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Si suprimiu l'episodi, se suprimiran tots els fitxers multimèdia, comentaris, videoclips i fragments d'àudio associats amb ell.",
        'understand' => 'Entenc, vull suprimir aquest episodi',
        'submit' => 'Eliminar',
    ],
    'embed' => [
        'title' => 'Reproductor incrustable',
        'label' =>
            'Trieu un color de tema, copieu el reproductor incrustable al porta-retalls i enganxeu-lo al vostre lloc web.',
        'clipboard_iframe' => 'Copiar el reproductor incrustable al porta-retalls',
        'clipboard_url' => 'Copiar l\'adreça al porta-retalls',
        'dark' => 'Fosc',
        'dark-transparent' => 'Fosc i transparent',
        'light' => 'Clar',
        'light-transparent' => 'Clar i transparent',
    ],
];
