<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'banner' => [
        'disclaimer' => 'Importeren',
        'text' => '{podcastTitle} wordt momenteel geïmporteerd.',
        'cta' => 'Bekijk importstatus',
    ],
    'old_podcast_section_title' => 'De te importeren podcast',
    'old_podcast_legal_disclaimer_title' => 'Wettelijke disclaimer',
    'old_podcast_legal_disclaimer' =>
        'Zorg ervoor dat je de rechten hebt voor deze podcast voordat je deze importeert. Het kopiëren en uitzenden van een podcast zonder de juiste rechten is piraterij en kan vervolgd worden.',
    'imported_feed_url' => 'Feed URL',
    'imported_feed_url_hint' => 'De feed moet in xml of rss formaat zijn.',
    'new_podcast_section_title' => 'De nieuwe podcast',
    'lock_import' =>
        'Deze feed is beschermd. U kunt deze niet importeren. Als u de eigenaar bent, ontgrendel het op het oorsprongsplatform.',
    'submit' => 'Import toevoegen aan wachtrij',
    'queue' => [
        'status' => [
            'label' => 'Status',
            'queued' => 'in wachtrij',
            'queued_hint' => 'Import taak is in afwachting van verwerking.',
            'canceled' => 'geannuleerd',
            'canceled_hint' => 'Importtaak is geannuleerd.',
            'running' => 'actief',
            'running_hint' => 'Import taak wordt verwerkt.',
            'failed' => 'mislukt',
            'failed_hint' => 'Import taak kon niet voltooid worden: script mislukt.',
            'passed' => 'geslaagd',
            'passed_hint' => 'Import taak is succesvol voltooid!',
        ],
        'feed' => 'Feed',
        'duration' => 'Duur van importeren',
        'imported_episodes' => 'Geïmporteerde afleveringen',
        'imported_episodes_hint' => '{newlyImportedCount} onlangs geïmporteerd, {alreadyImportedCount} reeds geïmporteerd.',
        'actions' => [
            'cancel' => 'Annuleer',
            'retry' => 'Opnieuw proberen',
            'delete' => 'Verwijderen',
        ],
    ],
    'syncForm' => [
        'title' => 'Feeds synchroniseren',
        'feed_url' => 'Feed URL',
        'feed_url_hint' => 'De feed-URL die u wilt synchroniseren met de huidige podcast.',
        'submit' => 'Aan wachtrij toevoegen',
    ],
    'messages' => [
        'canceled' => 'Import taak is succesvol geannuleerd!',
        'notRunning' => 'De Import taak kan niet worden geannuleerd omdat deze niet wordt uitgevoerd.',
        'alreadyRunning' => 'Import taak is al actief. U kunt deze annuleren voordat u opnieuw probeert.',
        'retried' => 'Import taak is in de wachtrij gezet, deze zal binnenkort opnieuw worden geprobeerd!',
        'deleted' => 'Import taak is succesvol verwijderd!',
        'importTaskQueued' => 'Een nieuwe taak is in de wachtrij gezet, de import zal binnenkort beginnen!',
        'syncTaskQueued' => 'Een nieuwe taak is in de wachtrij gezet, de import zal binnenkort beginnen!',
    ],
];
