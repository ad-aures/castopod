<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Configurações gerais',
    'instance' => [
        'title' => 'Instância',
        'site_icon' => 'Ícone do site',
        'site_icon_delete' => 'Excluir ícone do site',
        'site_icon_hint' => 'Ícones de sites são o que você vê nas abas do seu navegador, barra de favoritos e quando você adiciona um site como um atalho em dispositivos móveis.',
        'site_icon_helper' => 'O ícone deve ser quadrado e ter pelo menos 512px de largura e altura.',
        'site_name' => 'Nome do site',
        'site_description' => 'Descrição do site',
        'submit' => 'Salvar',
        'editSuccess' => 'A instância foi atualizada com sucesso!',
        'deleteIconSuccess' => 'O ícone do site foi removido com sucesso!',
    ],
    'images' => [
        'title' => 'Imagens',
        'subtitle' => 'Aqui você pode regenerar todas as imagens baseadas nos originais que foram enviados. Para ser usado se você descobrir que algumas imagens estão faltando. Esta tarefa pode demorar um pouco.',
        'regenerate' => 'Regenerar imagens',
        'regenerationSuccess' => 'Todas as imagens foram regeneradas com sucesso!',
    ],
    'housekeeping' => [
        'title' => 'Manutenção',
        'subtitle' => 'Executa várias tarefas de manutenção. Use este recurso se você encontrar problemas com arquivos de mídia ou integridade de dados. Estas tarefas podem demorar um pouco.',
        'reset_counts' => 'Redefinir contadores',
        'reset_counts_helper' => 'Esta opção irá recalcular e redefinir todas as contagens de dados (número de seguidores, publicações, comentários, …).',
        'rewrite_media' => 'Reescrever metadados de mídia',
        'rewrite_media_helper' => 'Esta opção apagará todos os arquivos de mídia desnecessários e os recriará (imagens, arquivos de áudio, transcrições, capítulos, …)',
        'rename_episodes_files' => 'Renomear os arquivos de áudio de episódios',
        'rename_episodes_files_hint' => 'Esta opção irá renomear todos os episódios de arquivos de áudio para uma sequência aleatória de caracteres. Use isto se o link de seus episódios privados foi vazado, pois isso irá escondê-los efetivamente.',
        'clear_cache' => 'Limpar todo o cache',
        'clear_cache_helper' => 'Esta opção irá liberar o cache do redis ou arquivos graváveis/cache.',
        'run' => 'Executar manutenção',
        'runSuccess' => 'Manutenção foi realizada com sucesso!',
    ],
    'theme' => [
        'title' => 'Tema',
        'accent_section_title' => 'Cor de destaque',
        'accent_section_subtitle' => 'Escolha a cor para determinar a aparência de todas as páginas públicas.',
        'pine' => 'Pinheiro',
        'crimson' => 'Carmesim',
        'amber' => 'Âmbar',
        'lake' => 'Lago',
        'jacaranda' => 'Jacarandá',
        'onyx' => 'Ônix',
        'submit' => 'Salvar',
        'setInstanceThemeSuccess' => 'O tema foi atualizado com sucesso!',
    ],
];
