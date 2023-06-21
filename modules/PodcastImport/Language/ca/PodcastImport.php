<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'warning' =>
        'Aquest procediment pot trigar molt de temps. Com que la versió actual no mostra cap progrés mentre s\'executa, no veureu res actualitzat fins que no s\'hagi fet. En cas d\'error de temps d\'espera, augmenteu el valor `max_execution_time` a la configuració del PHP del servidor.',
    'old_podcast_section_title' => 'El podcast a importar',
    'old_podcast_section_subtitle' =>
        'Assegura\'t de tenir els drets d\'aquest podcast abans d\'importar-lo. Copiar i difondre un podcast sense els drets adequats és pirateria i pot ser processat.',
    'imported_feed_url' => 'Adreça URL del fil',
    'imported_feed_url_hint' => 'El contingut del fil ha d\'estar en format xml o rss.',
    'new_podcast_section_title' => 'El nou podcast',
    'advanced_params_section_title' => 'Paràmetres avançats',
    'advanced_params_section_subtitle' =>
        'Mantingueu els valors predeterminats si no teniu idea de per a què serveixen els camps.',
    'slug_field' => 'Camp que s\'utilitzarà per calcular l\'àlies d\'un episodi',
    'description_field' =>
        'Camp d\'origen utilitzat per a la descripció de l\'episodi / notes del programa',
    'force_renumber' => 'Forçar la renumeració dels episodis',
    'force_renumber_hint' =>
        'Utilitzeu aquesta funcionalitat si el vostre podcast no té números d\'episodi però voleu configurar-los durant la importació.',
    'season_number' => 'Número de temporada',
    'season_number_hint' =>
        'Utilitzeu aquesta opció si el vostre podcast no té un número de temporada però voleu establir-ne un durant la importació. Deixeu en blanc en cas contrari.',
    'max_episodes' => 'Nombre màxim d\'episodis per importar',
    'max_episodes_hint' => 'Deixeu en blanc per importar tots els episodis',
    'lock_import' =>
        'Aquest feed està protegit. No el podeu importar. Si sou el propietari, desprotegiu-lo a la plataforma d\'origen.',
    'submit' => 'Importar el podcast',
];
