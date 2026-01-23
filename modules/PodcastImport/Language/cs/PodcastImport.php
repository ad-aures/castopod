<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'banner' => [
        'disclaimer' => 'Importuje',
        'text' => '{podcastTitle} je nyní importován.',
        'cta' => 'Zobrazit stav importu',
    ],
    'old_podcast_section_title' => 'Podcast k importu',
    'old_podcast_legal_disclaimer_title' => 'Právní prohlášení',
    'old_podcast_legal_disclaimer' =>
        'Ujistěte se, že vlastníte práva pro tento kanál před jeho importem. Kopírování a vysílání bez řádných práv je pirátství a podléhá stíhání.',
    'imported_feed_url' => 'Adresa kanálu',
    'imported_feed_url_hint' => 'Zdroj musí být ve formátu XML nebo RSS.',
    'new_podcast_section_title' => 'Nový kanál',
    'lock_import' =>
        'Tento kanál je chráněn. Nemůžete jej importovat. Pokud jste vlastník, odemkněte jej na zdrojové platformě.',
    'submit' => 'Přidat import do fronty',
    'queue' => [
        'status' => [
            'label' => 'Stav',
            'queued' => 've frontě',
            'queued_hint' => 'Import čeká na zpracování.',
            'canceled' => 'zrušeno',
            'canceled_hint' => 'Import byl zrušen.',
            'running' => 'běží',
            'running_hint' => 'Probíhá zpracování importu.',
            'failed' => 'selhalo',
            'failed_hint' => 'Import nemohl být dokončen: skript selhal.',
            'passed' => 'prošel',
            'passed_hint' => 'Import úspěšně dokončen!',
        ],
        'feed' => 'Kanál',
        'duration' => 'Doba trvání importu',
        'imported_episodes' => 'Importované epizody',
        'imported_episodes_hint' => '{newlyImportedCount} nově importováno, {alreadyImportedCount} již importováno.',
        'actions' => [
            'cancel' => 'Zrušit',
            'retry' => 'Opakovat',
            'delete' => 'Smazat',
        ],
    ],
    'syncForm' => [
        'title' => 'Synchronizovat kanály',
        'feed_url' => 'Adresa kanálu',
        'feed_url_hint' => 'URL kanálu, který chcete synchronizovat s aktuálním podcastem.',
        'submit' => 'Přidat do fronty',
    ],
    'messages' => [
        'canceled' => 'Import byl úspěšně zrušen!',
        'notRunning' => 'Nelze zrušit import, protože není spuštěn.',
        'alreadyRunning' => 'Import je již spuštěn. Před dalším pokusem jej můžete zrušit.',
        'retried' => 'Import byl zařazen do fronty, brzy bude znova spuštěn!',
        'deleted' => 'Import byl úspěšně smazán!',
        'importTaskQueued' => 'Nový úkol byl ve frontě, import brzy začne!',
        'syncTaskQueued' => 'Nový úkol importu byl ve frontě, synchronizace brzy začne!',
    ],
];
