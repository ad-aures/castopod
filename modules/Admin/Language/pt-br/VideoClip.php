<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'list' => [
        'title' => 'Clipes de vídeo',
        'status' => [
            'label' => 'Status',
            'queued' => 'na fila',
            'queued_hint' => 'O clipe está esperando para ser processado.',
            'pending' => 'pendente',
            'pending_hint' => 'O clipe será gerado em breve.',
            'running' => 'executando',
            'running_hint' => 'O clipe está sendo gerado.',
            'failed' => 'falhou',
            'failed_hint' => 'O clipe não pode ser gerado: falha de script.',
            'passed' => 'aprovado',
            'passed_hint' => 'Clipe gerado com sucesso!',
        ],
        'clip' => 'Clipe',
        'duration' => 'Duração da tarefa',
    ],
    'title' => 'Clipe de vídeo: {videoClipLabel}',
    'download_clip' => 'Baixar clipe',
    'create' => 'Novo clipe de vídeo',
    'go_to_page' => 'Ir para a página do clipe',
    'retry' => 'Repetir a geração do clipe',
    'delete' => 'Excluir clipe',
    'logs' => 'Logs de tarefa',
    'messages' => [
        'alreadyExistingError' => 'O clipe de vídeo que você está tentando criar já existe!',
        'addToQueueSuccess' => 'O clipe de vídeo foi adicionado à fila, aguardando ser criado!',
        'deleteSuccess' => 'O clipe de vídeo foi removido com sucesso!',
    ],
    'format' => [
        'landscape' => 'Paisagem',
        'portrait' => 'Retrato',
        'squared' => 'Quadrado',
    ],
    'form' => [
        'title' => 'Novo clipe de vídeo',
        'params_section_title' => 'Parâmetros do clipe de vídeo',
        'clip_title' => 'Título do clipe',
        'format' => [
            'label' => 'Escolha um formato',
            'landscape_hint' => 'Com uma proporção de 16:9, os vídeos em paisagem são ótimos para PeerTube, Youtube e Vimeo.',
            'portrait_hint' => 'Com uma proporção de 9:16, os vídeos em retrato são ótimos para TikTok, Youtube shorts e Instagram stories.',
            'squared_hint' => 'Com uma proporção de 1:1, os vídeos quadrados são ótimos para Mastodon, Facebook, Twitter e LinkedIn.',
        ],
        'theme' => 'Selecione um tema',
        'start_time' => 'Começa em',
        'duration' => 'Duração',
        'trim_start' => 'Início do corte',
        'trim_end' => 'Fim do corte',
        'submit' => 'Criar clipe de vídeo',
    ],
    'requirements' => [
        'title' => 'Requisitos ausentes',
        'missing' => 'Você tem requisitos ausentes. Certifique-se de adicionar todos os itens necessários para poder criar um vídeo para este episódio!',
        'ffmpeg' => 'FFmpeg',
        'gd' => 'Graphics Draw (GD)',
        'freetype' => 'Biblioteca Freetype para GD',
        'transcript' => 'Arquivo de transcrição (.srt)',
    ],
];
