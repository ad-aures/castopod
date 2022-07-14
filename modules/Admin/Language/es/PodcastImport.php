<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'warning' =>
        'This procedure may take a long time. As the current version does not show any progress while it runs, you will not see anything updated until it is done. In case of timeout error, increase `max_execution_time` value.',
    'old_podcast_section_title' => 'Podcasts para importar',
    'old_podcast_section_subtitle' =>
        'Asegúrese de que tiene los derechos para este podcast antes de importarlo. Copiar y difundir un podcast sin los derechos apropiados es piratería y puede ser procesado.',
    'imported_feed_url' => 'URL del Feed',
    'imported_feed_url_hint' => 'El feed debe estar en formato xml o rss.',
    'new_podcast_section_title' => 'El nuevo Podcast',
    'advanced_params_section_title' => 'Parámetros avanzados',
    'advanced_params_section_subtitle' =>
        'Mantenga los valores por defecto si no tiene idea de para qué sirven los campos.',
    'slug_field' => 'Campo a utilizar para calcular el slug de episodio',
    'description_field' =>
        'Campo de origen usado para la descripción del episodio / mostrar notas',
    'force_renumber' => 'Forzar renumeración de episodios',
    'force_renumber_hint' =>
        'Utilice esto si su podcast no tiene números de episodios pero desea establecerlos durante la importación.',
    'season_number' => 'Número de Temporada',
    'season_number_hint' =>
        'Utilice esto si su podcast no tiene un número de temporada pero desea establecer uno durante la importación. Deje en blanco de lo contrario.',
    'max_episodes' => 'Número máximo de episodios a importar',
    'max_episodes_hint' => 'Dejar en blanco para importar todos los episodios',
    'lock_import' =>
        'Este feed está protegido. No puedes importarlo. Si eres el propietario, debes desprotegerlo en la plataforma de origen.',
    'submit' => 'Importar podcast',
];
