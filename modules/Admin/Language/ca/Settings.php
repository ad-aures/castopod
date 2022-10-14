<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Configuració general',
    'instance' => [
        'title' => 'Instància',
        'site_icon' => 'Icona del lloc',
        'site_icon_delete' => 'Esborra la icona del lloc',
        'site_icon_hint' => 'Les icones del lloc són el que veieu a les pestanyes del navegador, a la barra d\'adreces d\'interès i quan afegiu un lloc web com a drecera als dispositius mòbils.',
        'site_icon_helper' => 'La icona ha de ser quadrada i com a mínim 512 píxels d\'ample i d\'alçada.',
        'site_name' => 'Nom del lloc',
        'site_description' => 'Descripció de la web',
        'submit' => 'Desar',
        'editSuccess' => 'La instància s\'ha actualitzat correctament.',
        'deleteIconSuccess' => 'La icona del lloc s\'ha eliminat correctament.',
    ],
    'images' => [
        'title' => 'Imatges',
        'subtitle' => 'Aquí podeu regenerar totes les imatges en funció dels originals que s\'han pujat. S\'utilitzarà si trobeu que falten algunes imatges. Aquesta tasca pot portar una estona.',
        'regenerate' => 'Regenerar les imatges',
        'regenerationSuccess' => 'Totes les imatges s\'han regenerat correctament.',
    ],
    'housekeeping' => [
        'title' => 'Tasques de neteja',
        'subtitle' => 'Realitzar diferents tasques de neteja. Utilitzeu aquesta funció si mai trobeu problemes amb els fitxers multimèdia o la integritat de les dades. Aquestes tasques poden trigar una estona.',
        'reset_counts' => 'Restablir els comptes',
        'reset_counts_helper' => 'Aquesta opció tornarà a calcular i restablir tots els recomptes de dades (nombre de seguidors, publicacions, comentaris, …).',
        'rewrite_media' => 'Reescriure les metadades multimèdia',
        'rewrite_media_helper' => 'Aquesta opció suprimirà tots els fitxers multimèdia superflus i els recrearà (imatges, fitxers d\'àudio, transcripcions, capítols, ...)',
        'rename_episodes_files' => 'Rename episode audio files',
        'rename_episodes_files_hint' => 'This option will rename all episodes audio files to a random string of characters. Use this if one of your private episodes link was leaked as this will effectively hide it.',
        'clear_cache' => 'Esborrar tota la memòria cau',
        'clear_cache_helper' => 'Aquesta opció esborrarà la memòria cau redis o els fitxers de memòria cau.',
        'run' => 'Executar la neteja',
        'runSuccess' => 'S\'ha conclòs correctament la neteja!',
    ],
    'theme' => [
        'title' => 'Tema',
        'accent_section_title' => 'Color d\'èmfasi',
        'accent_section_subtitle' => 'Trieu el color per determinar l\'aspecte de totes les pàgines públiques.',
        'pine' => 'Pi',
        'crimson' => 'Carmesí',
        'amber' => 'Ambre',
        'lake' => 'Llac',
        'jacaranda' => 'Jacaranda',
        'onyx' => 'Onyx',
        'submit' => 'Desar',
        'setInstanceThemeSuccess' => 'El tema s\'ha actualitzat correctament.',
    ],
];
