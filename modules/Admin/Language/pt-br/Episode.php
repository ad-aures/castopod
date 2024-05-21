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
    'preview' => 'Pré-visualizar',
    'publish' => 'Publicar',
    'publish_edit' => 'Editar publicação',
    'publish_date_edit' => 'Editar data de publicação',
    'unpublish' => 'Despublicar',
    'publish_error' => 'O episódio já está publicado.',
    'publish_edit_error' => 'O episódio já está publicado.',
    'publish_cancel_error' => 'O episódio já está publicado.',
    'publish_date_edit_error' => 'Episódio ainda não foi publicado, você não pode editar a data de publicação dele.',
    'publish_date_edit_future_error' => 'A data de publicação do episódio só pode ser definida para data passada! Se você deseja reagendá-la, cancele a publicação primeiro.',
    'publish_date_edit_success' => 'A data de publicação do episódio foi atualizada com sucesso!',
    'unpublish_error' => 'O episódio não está publicado.',
    'delete' => 'Excluir',
    'go_to_page' => 'Ir para a página',
    'create' => 'Adicionar um episódio',
    'publication_status' => [
        'published' => 'Publicado',
        'with_podcast' => 'Publicado',
        'scheduled' => 'Programado',
        'not_published' => 'Não publicado',
    ],
    'with_podcast_hint' => 'A ser publicado ao mesmo tempo que o podcast',
    'list' => [
        'search' => [
            'placeholder' => 'Buscar um episódio',
            'clear' => 'Limpar busca',
            'submit' => 'Buscar',
        ],
        'number_of_episodes' => '{numberOfEpisodes, plural,
            one {# episódio}
            other {# episódios}
        }',
        'episode' => 'Episódio',
        'visibility' => 'Visibilidade',
        'downloads' => 'Downloads',
        'comments' => 'Comentários',
        'actions' => 'Ações',
    ],
    'messages' => [
        'createSuccess' => 'Episódio foi criado com sucesso!',
        'editSuccess' => 'Episódio foi atualizado com sucesso!',
        'publishSuccess' => '{publication_status, select,
            published {Episódio publicado com sucesso!}
            scheduled {Publicação de episódios agendada com sucesso!}
            with_podcast {Este episódio será publicado ao mesmo tempo que o podcast.}
            other {Este episódio não foi publicado.}
        }',
        'publishCancelSuccess' => 'Publicação do episódio cancelada!',
        'unpublishBeforeDeleteTip' => 'Você deve despublicar o episódio antes de excluí-lo.',
        'scheduleDateError' => 'Data de agendamento deve ser definida!',
        'deletePublishedEpisodeError' => 'Por favor, despublique o episódio antes de excluí-lo.',
        'deleteSuccess' => 'Episódio excluído com sucesso!',
        'deleteError' => 'Falha ao excluir o episódio {type, select,
            transcript {transcrição}
            chapters {capítulos}
            image {cupa}
            audio {áudio}
            other {mídia}
        }.',
        'deleteFileError' => 'Falha ao excluir o arquivo de {type, select,
            transcript {transcrição}
            chapters {capítulos}
            image {capa}
            audio {áudio}
            other {mídia}
        }arquivo {file_key}. Você pode removê-lo manualmente do seu disco.',
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
        'cover_size_hint' => 'A capa deve ser quadrada e ter pelo menos 1400px de largura e altura.',
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
        'premium_title' => 'Premium',
        'premium' => 'Episódio deve estar acessível apenas para assinantes premium',
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
        'transcript_hint' => 'Only .srt or .vtt are allowed.',
        'transcript_download' => 'Baixar transcrição',
        'transcript_file' => 'Transcript file (.srt or .vtt)',
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
        'block' => 'O episódio deve ser ocultado dos catálogos públicos',
        'block_hint' =>
            'O status do episódio: ativar isso impede que o episódio apareça em Apple Podcasts, Google Podcasts e qualquer aplicativo de terceiros que extraia programas desses diretórios. (Não garantido)',
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
            'with_podcast' => 'Publicar juntamente com o podcast',
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
    'publish_date_edit_form' => [
        'new_publication_date' => 'Nova data de publicação',
        'new_publication_date_hint' => 'Deve ser definido como uma data passada.',
        'submit' => 'Editar data de publicação',
    ],
    'unpublish_form' => [
        'disclaimer' =>
            "O cancelamento da publicação do episódio excluirá todos os comentários e publicações associados a ele e o removerá do feed RSS do podcast.",
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
    'publication_status_banner' => [
        'draft_mode' => 'modo rascunho',
        'text' => '{publication_status, select,
            published {Esse episódio ainda não foi publicado.}
            scheduled {Esse episódio está agendado para publicação em {publication_date}.}
            with_podcast {Esse episódio será publicado ao mesmo tempo que o podcast. .}
            other {Esse episódio ainda não foi publicado.}
        }',
        'preview' => 'Pré-visualizar',
    ],
];
