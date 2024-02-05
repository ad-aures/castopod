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
        'Make sure you own the rights for this podcast before importing it. Copying and broadcasting a podcast without the proper rights is piracy and is liable to prosecution.',
    'imported_feed_url' => 'Feed URL',
    'imported_feed_url_hint' => 'The feed must be in xml or rss format.',
    'new_podcast_section_title' => 'De nieuwe podcast',
    'lock_import' =>
        'This feed is protected. You cannot import it. If you are the owner, unlock it on the origin platform.',
    'submit' => 'Import toevoegen aan wachtrij',
    'queue' => [
        'status' => [
            'label' => 'Status',
            'queued' => 'in wachtrij',
            'queued_hint' => 'Import task is awaiting to be processed.',
            'canceled' => 'geannuleerd',
            'canceled_hint' => 'Import task was canceled.',
            'running' => 'actief',
            'running_hint' => 'Import task is being processed.',
            'failed' => 'mislukt',
            'failed_hint' => 'Import task could not complete: script failure.',
            'passed' => 'passed',
            'passed_hint' => 'Import task was completed successfully!',
        ],
        'feed' => 'Feed',
        'duration' => 'Duur van importeren',
        'imported_episodes' => 'Geïmporteerde afleveringen',
        'imported_episodes_hint' => '{newlyImportedCount} newly imported, {alreadyImportedCount} already imported.',
        'actions' => [
            'cancel' => 'Annuleer',
            'retry' => 'Opnieuw proberen',
            'delete' => 'Verwijderen',
        ],
    ],
    'syncForm' => [
        'title' => 'Synchronize feeds',
        'feed_url' => 'Feed URL',
        'feed_url_hint' => 'The feed URL you want to synchronize with the current podcast.',
        'submit' => 'Aan wachtrij toevoegen',
    ],
    'messages' => [
        'canceled' => 'Import task has been successfully canceled!',
        'notRunning' => 'Cannot cancel Import Task as it is not running.',
        'alreadyRunning' => 'Import Task is already running. You may cancel it before retrying.',
        'retried' => 'Import task has been queued, it will be retried shortly!',
        'deleted' => 'Import task has been successfully deleted!',
        'importTaskQueued' => 'An new task has been queued, import will start shortly!',
        'syncTaskQueued' => 'A new import task has been queued, synchronization will start shortly!',
    ],
];
