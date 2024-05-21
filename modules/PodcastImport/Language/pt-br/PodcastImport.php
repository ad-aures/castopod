<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'banner' => [
        'disclaimer' => 'Importando',
        'text' => '{podcastTitle} está sendo importado no momento.',
        'cta' => 'Ver status de importação',
    ],
    'old_podcast_section_title' => 'O podcast para importar',
    'old_podcast_legal_disclaimer_title' => 'Aviso legal',
    'old_podcast_legal_disclaimer' =>
        'Certifique-se de possuir os direitos para esse podcast antes de importá-lo. Copiar e transmitir um podcast sem os direitos adequados é pirataria e corre-se o risco de processo legal.',
    'imported_feed_url' => 'URL do feed',
    'imported_feed_url_hint' => 'O feed deve estar no formato xml ou rss.',
    'new_podcast_section_title' => 'O novo podcast',
    'lock_import' =>
        'Este feed está protegido. Você não pode importá-lo. Se é o dono, desbloqueie-o na plataforma de origem.',
    'submit' => 'Adicionar importação à fila',
    'queue' => [
        'status' => [
            'label' => 'Status',
            'queued' => 'na fila',
            'queued_hint' => 'Tarefa de importação está aguardando para ser processada.',
            'canceled' => 'cancelado',
            'canceled_hint' => 'Tarefa de importação foi cancelada.',
            'running' => 'executando',
            'running_hint' => 'Tarefa de importação está sendo processada.',
            'failed' => 'falhou',
            'failed_hint' => 'Tarefa de importação não pôde ser concluída: falha no script.',
            'passed' => 'aprovado',
            'passed_hint' => 'Tarefa de importação foi concluída com sucesso!',
        ],
        'feed' => 'Feed',
        'duration' => 'Duração da importação',
        'imported_episodes' => 'Episódios importados',
        'imported_episodes_hint' => '{newlyImportedCount} recém importado, {alreadyImportedCount} já importado.',
        'actions' => [
            'cancel' => 'Cancelar',
            'retry' => 'Tente novamente',
            'delete' => 'Excluir',
        ],
    ],
    'syncForm' => [
        'title' => 'Sincronizar o feed',
        'feed_url' => 'URL do feed',
        'feed_url_hint' => 'A URL do feed que você deseja sincronizar com o podcast atual.',
        'submit' => 'Adicionar à fila',
    ],
    'messages' => [
        'canceled' => 'Tarefa de importação foi cancelada com sucesso!',
        'notRunning' => 'Não é possível cancelar a tarefa de importação, pois ela não está em execução.',
        'alreadyRunning' => 'Tarefa de Importação já está em execução. Você pode cancelá-la antes de tentar novamente.',
        'retried' => 'Tarefa de importação foi enfileirada, ela será repetida em breve!',
        'deleted' => 'Tarefa de importação foi cancelada com sucesso!',
        'importTaskQueued' => 'Uma nova tarefa foi colocada na fila, a importação será iniciada em breve!',
        'syncTaskQueued' => 'Uma nova tarefa de importação foi colocada na fila, a sincronização começará em breve!',
    ],
];
