<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'warning' =>
        'Este procedimento pode levar muito tempo. Como a versão atual não mostra nenhum progresso durante a execução, você não verá nada atualizado até que seja finalizado. Em caso de erro de tempo limite, aumente o valor de `max_execution_time`.',
    'old_podcast_section_title' => 'O podcast para importar',
    'old_podcast_section_subtitle' =>
        'Certifique-se de possuir os direitos para esse podcast antes de importá-lo. Copiar e transmitir um podcast sem os direitos adequados é uma pirataria e corre o risco de ser processado.',
    'imported_feed_url' => 'URL do feed',
    'imported_feed_url_hint' => 'O feed deve estar no formato xml ou rss.',
    'new_podcast_section_title' => 'O novo podcast',
    'advanced_params_section_title' => 'Parâmetros avançados',
    'advanced_params_section_subtitle' =>
        'Mantenha os valores padrão se você não tiver ideia do que os campos servem.',
    'slug_field' => 'Campo a ser usado para calcular o slug do episódio',
    'description_field' =>
        'Campo de origem usado para descrição do episódio / mostrar notas',
    'force_renumber' => 'Forçar renumeração de episódios',
    'force_renumber_hint' =>
        'Use isto se seu podcast não tem números de episódio, mas deseja configurá-los durante a importação.',
    'season_number' => 'Número da temporada',
    'season_number_hint' =>
        'Use isto se o seu podcast não tem um número de temporada, mas deseja definir um durante a importação. Deixe em branco caso contrário.',
    'max_episodes' => 'Número máximo de episódios para importar',
    'max_episodes_hint' => 'Deixe em branco para importar todos os episódios',
    'lock_import' =>
        'Este feed está protegido. Você não pode importá-lo. Se você é o proprietário, desproteja-o na plataforma de origem.',
    'submit' => 'Importar podcast',
];
