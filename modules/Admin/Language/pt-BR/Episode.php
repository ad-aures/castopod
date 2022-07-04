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
    'number' => 'Episódio {episodeNumber}',
    'number_abbr' => 'Ep. {episodeNumber}',
    'season_episode' => 'Temporada {seasonNumber} episódio {episodeNumber}',
    'season_episode_abbr' => 'T{seasonNumber}:E{episodeNumber}',
    'number_of_comments' => '{numberOfComments, plural,
        one {# comentário}
        other {# comentários}
    }',
    'all_podcast_episodes' => 'Todos os episódios de podcast',
    'back_to_podcast' => 'Voltar para o podcast',
    'edit' => 'Editar',
    'publish' => 'Publicar',
    'publish_edit' => 'Editar publicação',
    'unpublish' => 'Despublicar',
    'publish_error' => 'O episódio já está publicado.',
    'publish_edit_error' => 'O episódio já está publicado.',
    'publish_cancel_error' => 'O episódio já está publicado.',
    'unpublish_error' => 'O episódio não está publicado.',
    'delete' => 'Excluir',
    'go_to_page' => 'Ir para a página',
    'create' => 'Adicionar um episódio',
    'publication_status' => [
        'published' => 'Publicado',
        'scheduled' => 'Programado',
        'not_published' => 'Não publicado',
    ],
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
        'episode' => 'Episódio',
        'visibility' => 'Visibilidade',
        'comments' => 'Comentários',
        'actions' => 'Ações',
    ],
    'messages' => [
        'createSuccess' => 'Episódio foi criado com sucesso!',
        'editSuccess' => 'Episódio foi atualizado com sucesso!',
        'publishCancelSuccess' => 'Publicação do episódio cancelada!',
        'unpublishBeforeDeleteTip' => 'Você deve despublicar o episódio antes de excluí-lo.',
        'deletePublishedEpisodeError' => 'Por favor, despublique o episódio antes de excluí-lo.',
        'deleteSuccess' => 'Episódio excluído com sucesso!',
        'deleteError' => 'Falha ao excluir o episódio {type, select,
            transcript {transcrição}
            chapters {capítulos}
            image {cupa}
            audio {áudio}
            other {mídia}
        }.',
        'deleteFileError' => 'Failed to delete {type, select,
            transcript {transcript}
            chapters {chapters}
            image {cover}
            audio {audio}
            other {media}
        } file {file_path}. You may manually remove it from your disk.',
        'sameSlugError' => 'Um episódio com o slug escolhido já existe.',
    ],
    'form' => [
        'file_size_error' =>
            'O tamanho do seu arquivo é muito grande! Tamanho máximo é {0}. Aumente os valores `memory_limit`, `upload_max_filesize` e `post_max_size` no seu arquivo de configuração do php, em seguida, reinicie seu servidor web para enviar seu arquivo.',
        'audio_file' => 'Arquivo de áudio',
        'audio_file_hint' => 'Escolha um arquivo de áudio .mp3 ou .m4a.',
        'info_section_title' => 'Informação do episódio',
        'cover' => 'Capa de episódio',
        'cover_hint' =>
            'Se você não definir uma capa, a capa do podcast será usada no lugar.',
        'cover_size_hint' => 'Cover must be squared and at least 1400px wide and tall.',
        'title' => 'Título',
        'title_hint' =>
            'Deve conter um nome de episódio claro e conciso. Não especifique o número de episódio ou de temporada aqui.',
        'permalink' => 'Link permanente',
        'season_number' => 'Temporada',
        'episode_number' => 'Episódio',
        'type' => [
            'label' => 'Tipo',
            'full' => 'Completo',
            'full_hint' => 'Conteúdo completo (o episódio)',
            'trailer' => 'Trailer',
            'trailer_hint' => 'Conteúdo promocional curto que representa uma prévia do podcast',
            'bonus' => 'Bônus',
            'bonus_hint' => 'Conteúdo extra para o podcast (por exemplo, informações nos bastidores ou entrevistas com o elenco) ou conteúdo promocional com outro podcast',
        ],
        'parental_advisory' => [
            'label' => 'Aviso aos pais',
            'hint' => 'O episódio contém conteúdo explícito?',
            'undefined' => 'não definido',
            'clean' => 'Limpo',
            'explicit' => 'Explícito',
        ],
        'show_notes_section_title' => 'Mostrar notas',
        'show_notes_section_subtitle' =>
            'Até 4000 caracteres, seja claro e conciso. As notas do episódio ajudam aos ouvintes em potencial a encontrar o episódio.',
        'description' => 'Descrição',
        'description_footer' => 'Rodapé da descrição',
        'description_footer_hint' =>
            'Este texto é adicionado no final de cada descrição de episódio, é um bom lugar para inserir seus links sociais por exemplo.',
        'additional_files_section_title' => 'Arquivos adicionais',
        'additional_files_section_subtitle' =>
            'Estes arquivos podem ser usados por outras plataformas para fornecer uma melhor experiência ao seu público. Veja o {podcastNamespaceLink} para mais informações.',
        'location_section_title' => 'Localização',
        'location_section_subtitle' => 'Sobre que lugar é este episódio?',
        'location_name' => 'Nome ou endereço da localização',
        'location_name_hint' => 'Esta pode ser uma localização real ou fictícia',
        'transcript' => 'Transcrição (legendas / legendas ocultas)',
        'transcript_hint' => 'Somente .srt são permitidos.',
        'transcript_download' => 'Baixar transcrição',
        'transcript_file' => 'Arquivo de transcrição (.srt)',
        'transcript_remote_url' => 'URL remoto para transcrição',
        'transcript_file_delete' => 'Excluir arquivo de transcrição',
        'chapters' => 'Capítulos',
        'chapters_hint' => 'Arquivo deve estar no formato de Capítulos JSON.',
        'chapters_download' => 'Baixar capítulos',
        'chapters_file' => 'Arquivo de capítulos',
        'chapters_remote_url' => 'URL remoto para o arquivo de capítulos',
        'chapters_file_delete' => 'Excluir arquivo de capítulos',
        'advanced_section_title' => 'Parâmetros avançados',
        'advanced_section_subtitle' =>
            'Se você precisa de tags RSS que Castopod não lida, defina-as aqui.',
        'custom_rss' => 'Tags RSS personalizadas para o episódio',
        'custom_rss_hint' => 'Isso será injetado dentro da tag ❬item❭.',
        'block' => 'O episódio deve ser ocultado de todas as plataformas',
        'block_hint' =>
            'O episódio mostra ou oculta a publicação. Se você quiser que este episódio seja removido do diretório Apple, ative esta opção.',
        'submit_create' => 'Criar episódio',
        'submit_edit' => 'Salvar episódio',
    ],
    'publish_form' => [
        'back_to_episode_dashboard' => 'Voltar ao painel do episódio',
        'post' => 'Sua mensagem de publicação',
        'post_hint' =>
            "Escreva uma mensagem para anunciar a publicação do seu episódio. A mensagem será transmitida a todos os seus seguidores no fediverso e será destacada na página inicial de seu podcast.",
        'message_placeholder' => 'Escreva a sua mensagem…',
        'publication_date' => 'Data de publicação',
        'publication_method' => [
            'now' => 'Agora',
            'schedule' => 'Programar',
        ],
        'scheduled_publication_date' => 'Data de publicação programada',
        'scheduled_publication_date_clear' => 'Limpar data de publicação',
        'scheduled_publication_date_hint' =>
            'Você pode agendar a liberação do episódio definindo uma data de publicação futura. Este campo deve ser formatado como YYYY-MM-DD HH:mm',
        'submit' => 'Publicar',
        'submit_edit' => 'Editar publicação',
        'cancel_publication' => 'Cancelar publicação',
        'message_warning' => 'Você não escreveu uma mensagem para o anúncio do episódio!',
        'message_warning_hint' => 'Ter uma mensagem aumenta o engajamento social, resultando em uma melhor visibilidade do seu episódio.',
        'message_warning_submit' => 'Publicar mesmo assim',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "Despublicar do episódio irá apagar todas as publicações associadas a ele e removê-lo do feed RSS do podcast.",
        'understand' => 'Eu entendo, eu quero despublicar o episódio',
        'submit' => 'Despublicar',
    ],
    'delete_form' => [
        'disclaimer' =>
            "Excluir o episódio irá excluir todos os arquivos de mídia, comentários, clipes de vídeo e clipes de áudio associados a ele.",
        'understand' => 'Eu entendo, eu quero excluir o episódio',
        'submit' => 'Excluir',
    ],
    'embed' => [
        'title' => 'Player incorporável',
        'label' =>
            'Escolha uma cor do tema, copie o player incorporável para a área de transferência, e cole-o em seu site.',
        'clipboard_iframe' => 'Copiar player incorporável para área de transferência',
        'clipboard_url' => 'Copiar endereço para área de transferência',
        'dark' => 'Escuro',
        'dark-transparent' => 'Escuro translúcido',
        'light' => 'Claro',
        'light-transparent' => 'Claro translúcido',
    ],
];
